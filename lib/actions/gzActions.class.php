<?php

/**
 *
 */
class gzActions extends sfActions
{
  /**
   * Return in JSON when requested via AJAX or as plain text when requested directly in debug mode
   *
   */
  public function returnJSON($data)
  {
    $json = json_encode($data);

    if (sfContext::getInstance()->getConfiguration()->isDebug () && !$this->getRequest()->isXmlHttpRequest()) {
      $this->getContext()->getConfiguration()->loadHelpers('Partial');
      $json = get_partial('global/json', array('data' => $data));
    } else {
      $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    }

    return $this->renderText($json);
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
}