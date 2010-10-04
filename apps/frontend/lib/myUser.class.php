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
    return $user['id'];
  }

  public function signIn ($login)
  {
    parent::signIn ($login);

    $userDb = UserQuery::create ()->findOneByMail ($this->getProfileVar('mail'));

    if ($userDb === null)
      $user = UserPeer::createFromLdap ($this->getProfile ());
  }

}
