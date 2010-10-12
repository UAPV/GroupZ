<?php

/**
 * invitation actions.
 *
 * @package    groupz
 * @subpackage invitation
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class invitationActions extends sfActions
{
  public function executeAccept (sfWebRequest $request)
  {
    $invitation = $this->getInvitation ($request);
    $user = $invitation->getUser();

    $invitation->getGroup()->addUser ($user);

    if ($user->isGuest () && $user->getPassword() === null)
    {
      $this->getUser ()->addCredentials ('guest');
      $this->getUser ()->setUserObject ($user);
      $this->redirect ('@user_edit?id='?$user->getId());
    }
    else
      $this->redirect ('@group_show?name'.$invitation->getGroup()->getName());
  }

  public function executeDecline (sfWebRequest $request)
  {
    $invitation = $this->getInvitation ($request);
    $invitation->delete ();
  }

  /**
   * @param sfWebRequest $request
   * @return Invitation
   */
  protected function getInvitation (sfWebRequest $request)
  {
    $invitation = InvitationQuery::create ()
      ->joinWith ('Invitation.User')
      ->joinWith ('Invitation.Group')
      ->findOneByHash ($this->getParamater ('invitation'));
    
    $this->forward404Unless ($invitation !== null);
    
    return $invitation;
  }
}
