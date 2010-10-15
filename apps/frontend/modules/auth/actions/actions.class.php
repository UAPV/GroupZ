<?php

/**
 * group actions.
 * This actions are in a separate controller to distinguish the authentication process
 *
 * @package    groupz
 * @subpackage group
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class authActions extends gzActions
{
  public function executeLogin (sfWebRequest $request)
  {
    if ($request->isMethod ('post'))
    {
      $user = UserQuery::create ()->findByEmailAndPassword (
        $request->getParameter ('email'),
        $request->getParameter ('password'));

      $this->loadI18nHelper ();
      if ($user === null)
      {
        $this->getUser()->setFlashError (__('Invalid email or password'));
      }
      else
      {
        $this->getUser ()->signInDbUser ($user);
        $this->redirect ('@homepage');
      }
    }

  }

}
