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
  public function executeAutocomplete(sfWebRequest $request)
  {
    $term = $request->getParameter('term');
    $this->forward404Unless($term);

    // TODO

    // rechercher dans nom du ldap + nom des guest + email des guest

    $data = array (
      array (
        'id' => 1,
        'fullname' => 'Foo Bar',
        'email' => 'foo@bar.com',
        'guest' => true
      ),
      array (
        'id' => 2,
        'fullname' => 'Arnaud Didry',
        'email' => 'Arnaud.Didry@univ-avignon.fr',
        'guest' => false
      ),
    );

    return $this->returnJSON($data);
  }
}
