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
class UserPeer extends BaseUserPeer {

  /**
   *
   * TODO make this customisable
   *
   * @param array $user
   * @return User
   */
  public static function createFromLdap (array $userData)
  {
    $user = new User ();
    $user->setEmail ($userData ['mail']);
    $user->setIsGuest(false);
    $user->setFirstname ($userData ['givenname']);
    $user->setLastname ($userData ['sn']);
    // TODO
    //$user->setOrg ($userData ['']);
    //$user->setTel ($userData ['']);
    $user->save ();

    return $user;
  }

} // UserPeer
