<?php

class myUser extends uapvBasicSecurityUser
{

  public function isGuest ()
  {
    return $this->hasCredential('guest');
  }

}
