<?php

/**
 * account actions.
 *
 * @package    groupz
 * @subpackage account
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class accountActions extends gzActions
{
  /**
   * Display the account form
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeEdit(sfWebRequest $request)
  {
    $User = $this->getUser()->getUserObject ();
    $this->form = new AccountForm($User);
  }

  /**
   * Save the account form
   *
   * @param sfWebRequest $request
   * @return void
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::PUT));
    $User = $this->getUser()->getUserObject ();
    $this->form = new AccountForm($User);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * Validate and save request
   *
   * @param sfWebRequest $request
   * @param sfForm $form
   * @return void
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $User = $form->save();

      $this->loadI18nHelper ();
      $this->getUser()->setFlashNotice (__('Account saved'));

      $this->redirect('@account_edit');
    }
  }
}
