<?php

/**
 * invitation actions.
 *
 * @package    groupz
 * @subpackage invitation
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class invitationActions extends gzActions
{
  public function executeAccept (sfWebRequest $request)
  {
    $invitation = $this->getInvitation ($request);
    $user = $invitation->getUser();
    $group = $invitation->getGroup();

    $group->addUser ($user);
    $invitation->delete();

    $this->getUser()->setFlashNotice (__('You have been added to the group. Welcome !'), false);

    if ($user->isGuest () && $user->getPassword() === null)
    {
      $this->getUser ()->addCredentials ('guest');
      $this->getUser ()->setUserObject ($user);
      $this->redirect ('@user_edit?id='.$user->getId());
    }
    else
      $this->redirect ('@group_show?name'.$group->getName());
  }

  public function executeDecline (sfWebRequest $request)
  {
    $invitation = $this->getInvitation ($request);

    $this->sendEmail ($invitation->getGroup()->getOwner(), 'email_decline', array ('invitation' => $invitation));

    // debug $invitation->delete ();

    $this->getUser()->setFlashNotice (__('You have been removed from the group.'), false);
  }

  /**
   * Get requested invitation
   *
   * @param sfWebRequest $request
   * @return Invitation
   */
  protected function getInvitation (sfWebRequest $request)
  {
    $invitation = InvitationQuery::create ()
      ->joinWith ('Invitation.User')
      ->joinWith ('Invitation.Group')
      ->findOneByHash ($request->getParameter ('invitation'));
    
    $this->forward404Unless ($invitation !== null);
    
    return $invitation;
  }

  /**
   * Get requested group
   *
   * @param sfWebRequest $request
   * @return Group
   */
  protected function getGroup (sfWebRequest $request)
  {
    $group = GroupQuery::create ()->findOneByName ($request->getParameter ('group_name'));
    $this->forward404Unless ($group !== null);
    return $group;
  }

  /**
   * Get requested user
   *
   * @param sfWebRequest $request
   * @return User
   */
  protected function getRequestedUser (sfWebRequest $request)
  {
    $user = UserQuery::create ()->findPk ($request->getParameter ('user'));
    $this->forward404Unless ($user !== null);
    return $user;
  }

  /**
   * Resend invitations to all users that don't have replied yet.
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeResendGroup (sfWebRequest $request)
  {
    $group = $this->getGroup($request);
    if ($group->getCreatedBy() != $this->getUser()->getId())
      $this->forwardToSecureAction();

    $invitations = InvitationQuery::create ()
      ->filterByGroup($group)
      ->find();

    $this->resendInvitations($invitations);

    return $this->returnJSON (array (
      'status' => 'success',
      'response' => __('Invitations sent') // TODO load helper ?
    ));
  }

  /**
   * Resend invitation to _one_ user
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeResendUser (sfWebRequest $request)
  {
    $group = $this->getGroup($request);
    if ($group->getCreatedBy() != $this->getUser()->getId())
      $this->forwardToSecureAction();

    $requestedUser = $this->getRequestedUser($request);
    $invitations = InvitationQuery::create ()
      ->filterByGroup($group)
      ->filterByUser($requestedUser)
      ->find();

    $this->resendInvitations($invitations);

    return $this->returnJSON (array (
      'status' => 'success',
      'response' => __('Invitation sent') // TODO load helper ?
    ));
  }

  /**
   * @param  array $invitations
   * @return void
   */
  protected function resendInvitations ($invitations)
  {
    foreach ($invitations as $invitation)
    {
      $this->sendEmail($invitation->getUser(), 'group_admin/email_invitation', array ('invitation' => $invitation));
    }
  }

}
