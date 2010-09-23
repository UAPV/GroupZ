<?php

/**
 * group actions.
 *
 * @package    groupz
 * @subpackage group
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class groupActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Groups = $this->getRoute()->getObjects();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Group = $this->getRoute()->getObject();
  }

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

    $this->redirect('group/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $Group = $form->save();

      $this->redirect('group/edit?id='.$Group->getId());
    }
  }
}
