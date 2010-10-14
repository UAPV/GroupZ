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


  public function configure ()
  {
    $userDb = UserQuery::create ()->findOneByEmail ($this->getProfileVar('mail'));

    if ($userDb === null)
      $userDb = UserPeer::createFromLdap ($this->getProfile ()->getAll ());

    $this->setUserObject($userDb);

    // configure credentials
    if ($userDb->isGuest ())
      $this->addCredential('guest');
    else
      $this->addCredential('trusted');
  }

  /**
   * @return User
   */
  public function getUserObject ()
  {
    return UserQuery::create ()->findPk ($this->getId());
  }


  public function setUserObject (User $user)
  {
    $this->setAttribute ('user', $user->toArray ());
  }

  /**
   * Sets a flash notice that will be passed to the very next action.
   *
   * @param  $message
   * @param bool $persist true if the flash have to persist for the following request (true by default)
   * @return void
   */
  public function setFlashNotice ($message, $persist = true)
  {
    $this->setFlash ('notice', $message);
  }

  /**
   * Sets a flash error that will be passed to the very next action.
   *
   * @param  $message
   * @param bool $persist true if the flash have to persist for the following request (true by default)
   * @return void
   */
  public function setFlashError ($message, $persist = true)
  {
    $this->setFlash ('error', $message);
  }
}
