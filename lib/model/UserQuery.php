<?php



/**
 * Skeleton subclass for performing query and update operations on the 'gz_user' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.5.4 on:
 *
 * Thu Sep 23 21:16:36 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class UserQuery extends BaseUserQuery {

  /**
   * @param bool $withInvitations
   * @return UserQuery
   */
  public function filterByGroupAndInvitations (Group $group)
  {
    return $this
      ->setDistinct ()
      ->joinInvitation  (null, Criteria::LEFT_JOIN)
      ->joinGroupMember (null, Criteria::LEFT_JOIN)
      ->where ('Invitation.GroupId = ?', $group->getId ())
      ->orWhere ('GroupMember.GroupId = ?', $group->getId ());
  }

  /**
   * @return UserQuery
   */
  public function orderByName ()
  {
    return $this->orderByLastname()
                ->orderByFirstname();
  }

  public function findByEmailAndPassword ($email, $password)
  {
    return $this
      ->filterByEmail (strtolower ($email))
      ->where ('User.Password = SHA1(CONCAT(User.Salt, ?))', $password)
      ->findOne ();
  }

} // UserQuery
