<?php

class myUser extends uapvBasicSecurityUser
{

  /**
   * Tells if it's a guest user
   *
   * @return boolean
   */
  public function isGuest ()
  {
    return $this->hasCredential ('guest');
  }

  /**
   * Tells if it's a trusted user. Someone from the LDAP.
   *
   * @return boolean
   */
  public function isTrusted ()
  {
    return $this->hasCredential ('trusted');
  }

  /**
   * Log a user thanks to its database info
   *
   * @param User $user
   * @return void
   */
  public function signInDbUser (User $user)
  {
    $this->setUserObject ($user);

    // configure credentials
    if ($user->isGuest ())
      $this->addCredential('guest');
    else
      $this->addCredential('trusted');
  }

  /**
   * Returns the user ID in the database
   *
   * @return integer
   */
  public function getId ()
  {
    $user = $this->getAttribute('user');
    return $user['Id'];
  }

  /**
   * Returns a text representation of the user (fullname)
   * 
   * @return string
   */
  public function  __toString()
  {
    $user = $this->getAttribute('user');
    return $user['Firstname'].' '.$user['Lastname'];
  }

  /**
   * Configure the User after a CAS login
   *
   * @return void
   */
  public function configure ()
  {
    $userDb = UserQuery::create ()->findOneByEmail ($this->getProfileVar('mail'));

    if ($userDb === null)
      $userDb = UserPeer::createFromLdap ($this->getProfile ()->getAll ());

    $this->signInDbUser ($userDb);
  }

  /**
   * Returns the user object from the database
   *
   * @return User
   */
  public function getUserObject ()
  {
    return UserQuery::create ()->findPk ($this->getId());
  }

  /**
   * Set the current user from a DB object
   *
   * @return User
   */
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
