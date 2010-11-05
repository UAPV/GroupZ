<?php

/**
 * Group form.
 *
 * @package    groupz
 * @subpackage form
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class GroupForm extends BaseGroupForm
{
  protected $invitations = array ();

  public function configure()
  {
    unset($this['ml_name']);
    unset($this['expires_notice']);
    unset($this['expires_at']);
    unset($this['deleted']);
    unset($this['created_by']);
    unset($this['created_at']);
    unset($this['updated_at']);
    unset($this['group_member_list']);
    unset($this['invitation_list']);

    $this->widgetSchema['users'] = new sfWidgetFormChoice (array('multiple' => true, 'choices' => array() ));

    $this->validatorSchema ['users'] = new sfValidatorPropelChoice (array (
      'model' => 'User',
      'multiple' => true,
      'required' => false
    ));

    $this->validatorSchema ['name'] = new sfValidatorGroupName ();

    $this->validatorSchema->getPostValidator()->setMessage ('invalid', 'A group with the same name already exist.');

    $this->setDefault ('users', $this->getSavedMemberIds ());

    if (! $this->getObject()->isNew ())
      unset($this['name']);
  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveMembersList ($this->getValue ('users'));
  }

  public function saveMembersList ($users)
  {
    $group = $this->getObject (); /* @var $group Group */

    // TODO uniq($users)

    $membersIds = $this->getSavedMemberIds ();

    if (! is_array($users))
      $users = array();

    // Add new users
    foreach (array_diff ($users, $membersIds) as $userId)
    {
      // TODO prevent someone from self adding to the group
      $user = UserQuery::create()->findPk ($userId);
      $this->invitations [] = $group->inviteUser ($user);
    }

    // Check deleted users
    $deletedUserIds = array_diff ($membersIds, $users);
    if (count ($deletedUserIds))
    {
      foreach (GroupMemberQuery::create ()
        ->filterByGroup ($group)
        ->where ('GroupMember.UserId IN ?', $deletedUserIds)
        ->find() as $member)
        $member->delete (); // Implicitly call the gz_member.leave event

      foreach (InvitationQuery::create ()
        ->filterByGroup ($group)
        ->where ('Invitation.UserId IN ?', $deletedUserIds)
        ->find() as $member)
        $member->delete (); // Implicitly call the gz_member.leave event
    }
  }

  /**
   * Return selected users or default ones (from DB).
   * (Too lazy to make a proper widget. for now)
   *
   * @return array
   */
  public function getMembers ()
  {
    $userIds = (array) $this['users']->getValue ();

    // Users should already be in the instance pool, so we retrieve them
    // one by one with findPk
    $users = array ();
    foreach ($userIds as $uid)
      $users[] = UserQuery::create ()->findPk($uid);

    return $users;
  }

  /**
   * Get group members (+ invited) IDs stored in DB.  
   * (Too lazy to make a proper widget. for now)
   *
   * @return array
   */
  public function getSavedMemberIds ()
  {
    $group = $this->getObject (); /* @var $group Group */

    $members = $group->getAllMembers();
    $membersIds = array ();
    foreach ($members as $member)
      $membersIds [] = $member->getId ();
    return $membersIds;
  }

  /**
   * Alias of $this->getObject ()
   *
   * @return Group
   */
  public function getGroup ()
  {
    return $this->getObject();
  }

  /**
   * Return new invitations to send
   *
   * @return array
   */
  public function getInvitations ()
  {
    return $this->invitations;
  }
}
