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
    $this->form = new GroupForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = new GroupForm($this->getRoute()->getObject());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->getRoute()->getObject()->delete();

    $this->redirect('@homepage');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Group = $form->save();

      $this->redirect('@group_admin_edit?name='.$Group->getName());
    }
  }
}
