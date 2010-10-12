<?php

/**
 * group actions.
 *
 * @package    groupz
 * @subpackage group_admin
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class group_adminActions extends sfActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new GroupForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new GroupForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $group = $this->getGroup ();
    $this->checkOwner ($group);

    $this->form = new GroupForm($group);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $group = $this->getGroup ();
    $this->checkOwner ($group);

    $this->form = new GroupForm($group);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $group = $this->getGroup ();
    $this->checkOwner ($group);
    $group->delete();

    $this->redirect('@homepage');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $Group = $form->save();

      $this->redirect('@group_admin_edit?name='.$Group->getName());
    }
  }

  /**
   * @return Group
   */
  protected function getGroup ()
  {
    return $this->getRoute()->getObject();
  }

  /**
   * Forwards the current request to the secure action.
   *
   * @throws sfStopException
   */
  protected function forwardToSecureAction()
  {
    $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
  }

  /**
   * Checks if the connected user is the owner of the group
   *
   * @param  $group
   * @return void
   */
  protected function checkOwner ($group)
  {
    if ($this->getUser ()->getId () != $group->getCreatedBy ())
      $this->forwardToSecureAction();
  }
}
