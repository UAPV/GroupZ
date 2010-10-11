<?php

class myUser extends uapvBasicSecurityUser
{

  public function isGuest ()
  {
    return $this->hasCredential ('guest');
  }

  /**
   * Log guest in
   * @param User $user
   */
  public function signInGuest (User $user)
  {
    $this->setAttribute ('user', $user->toArray());
  }

  public function getId ()
  {
    $user = $this->getAttribute('user');
    return $user['Id'];
  }

  public function signIn ($login)
  {
    parent::signIn ($login);

    $userDb = UserQuery::create ()->findOneByEmail ($this->getProfileVar('mail'));

    if ($userDb === null)
      $userDb = UserPeer::createFromLdap ($this->getProfile ()->getAll ());

    $this->setAttribute('user', $userDb->toArray ());
  }

  public function  __toString()
  {
    $user = $this->getAttribute('user');
    return $user['Firstname'].' '.$user['Lastname'];
  }

  public function getUserObject ()
  {
    return UserQuery::create ()->findPk ($this->getId());
  }
  
}
