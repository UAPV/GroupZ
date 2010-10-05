<?php

/**
 * user actions.
 *
 * @package    groupz
 * @subpackage user
 * @author     Arnaud Didry <arnaud@didry.info>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends gzActions
{
 /**
  * Autocomplete user name
  *
  * @param sfRequest $request A request object
  */
  public function executeAutocomplete (sfWebRequest $request)
  {
    $term = $request->getParameter('term');
    $this->forward404Unless($term);

    // rechercher dans nom du ldap + nom des guest + email des guest
    $ldap = new uapvLdap (); // TODO make this customisable
    $ldapResults = $ldap->search ('mail=*'.$term.'*', 40);
    //$dbResults = $ldap->search('(|(mail='.$term.')())');

    $data = array ();
    foreach ($ldapResults as $user)
    {
      $userData = array (
        'fullname' => array_key_exists('displayname', $user) ? $user['displayname'] : '',
        'email' => array_key_exists('mail', $user) ? $user['mail'] : '',
        'guest' => false
      );

      if ($userDb = UserQuery::create()->findOneByMail($user['mail']))
        $userData['id'] = $userDb->getId ();

      $data [] = $userData;
    }

    return $this->returnJSON($data);
  }

 /**
  * Add a guest user via AJAX and return its ID 
  *
  * @param sfRequest $request A request object
  */
  public function executeAdd (sfWebRequest $request)
  {
    $email = $request->getParameter('email');
    $this->forward404Unless($email);

    try // to validate provided email
    {
      $validator = new sfValidatorEmail();
      $validator->clean ($email);
    }
    catch (Exception $e)
    {
      return $this->returnJSON(array (
        'error' => _('Invalid email')
      ));
    }

    // Does the user already exists in the DB
    $user = UserQuery::create ()->findOneByMail($email);
    if ($user === null)
    {
      // Does the user exist in the LDAP
      $ldap = new uapvLdap ();
      $ldapUser = $ldap->searchOne ('mail='.$email);
      if ($ldapUser !== null)
        $user = UserPeer::createFromLdap ($ldapUser);

      if ($user === null)
      {
        $user = new User ();
        $user->setIsGuest (true);
        $user->setMail ($email);
        $user->setAddedBy($this->getUser()->getId());
        $user->save();
      }
    }

    return $this->returnJSON(array (
      'id' => $user->getId (),
      'fullname' => $user->getFullname (),
      'email' => $user->getMail (),
      'guest' => $user->isGuest ()
    ));
  }
}
