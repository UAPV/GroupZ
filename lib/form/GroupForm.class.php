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
  public function configure()
  {
    $this->widgetSchema->setFormFormatterName('list');

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

    $membersIds = $this->getSavedMemberIds ();

    if (! is_array($users))
      $users = array();

    // Add new users
    foreach (array_diff ($users, $membersIds) as $userId)
    {
      // TODO prevent someone from self adding to the group
      $user = UserQuery::create()->findPk ($userId);
      $group->inviteUser ($user);
    }

    // Check deleted users
    $deletedUserIds = array_diff ($membersIds, $users);
    if (count ($deletedUserIds))
    {
      GroupMemberQuery::create ()
        ->filterByGroup ($group)
        ->where ('GroupMember.UserId IN ?', $deletedUserIds)
        ->delete();

      InvitationQuery::create ()
        ->filterByGroup ($group)
        ->where ('Invitation.UserId IN ?', $deletedUserIds)
        ->delete();
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
    $userIds = $this['users']->getValue ();

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
   * @return Group
   */
  public function getGroup ()
  {
    return $this->getObject();
  }
}
