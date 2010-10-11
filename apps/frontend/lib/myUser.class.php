<?php

class myUser extends uapvBasicSecurityUser
{

  public function isGuest ()
  {
    return $this->hasCredential ('guest');
  }

  public function isTrusted ()
  {
    return $this->hasCredential ('trusted');
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

  public function  __toString()
  {
    $user = $this->getAttribute('user');
    return $user['Firstname'].' '.$user['Lastname'];
  }

  /**
   * @return User
   */
  public function getUserObject ()
  {
    return UserQuery::create ()->findPk ($this->getId());
  }

  public function configure ()
  {
    $userDb = UserQuery::create ()->findOneByEmail ($this->getProfileVar('mail'));

    if ($userDb === null)
      $userDb = UserPeer::createFromLdap ($this->getProfile ()->getAll ());

    $this->setAttribute ('user', $userDb->toArray ());

    // configure credentials
    if ($userDb->isGuest ())
      $this->addCredential('guest');
    else
      $this->addCredential('trusted');
  }
}
