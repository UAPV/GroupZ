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

    $this->validatorSchema ['users'] = new sfValidatorPropelChoice (array (
      'model' => 'User',
      'multiple' => true,
      'required' => false
    ));
  }

  public function updateUsersColumn ($users)
  {
    $group = $this->getObject ();     /* @var $group Group */

    $members = $group->getGroupMembers();
    $membersIds = array ();
    foreach ($members as $member)
      $membersIds [] = $member->getUserId ();

    // Add new users
    foreach (array_diff ($users, $membersIds) as $userId)
    {
      // TODO prevent someone from self adding to the group
      $user = UserQuery::create()->findPk ($userId);
      $group->addUser ($user);
    }

    // Check deleted users
    $deletedUserIds = array_diff ($membersIds, $users);
    if (count ($deletedUserIds))
    {
      $deleteQuery = GroupMemberQuery::create ()
        ->filterByGroup ($group)
        ->where ('GroupMember.UserId IN ?', $deletedUserIds)
        ->delete();
    }
  }
}
