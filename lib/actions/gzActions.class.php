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

  /**
   * Send an email using a partial as html template
   *
   * @param string $email     User email
   * @param string $partial   Partial to render
   * @param array  $vars      Vars to pass to the template (Current action vars by default)
   *
   * @return void
   */
  public function sendEmail ($email, $partial, $vars = null)
  {
    $body = $this->getPartial ($partial, $vars);

    $message = $this->getMailer ()->compose (
      'groupz@univ-avignon.fr', // TODO
      $email,
      '[Groupz] '.get_slot ('email_subject'),
      $body.$this->getPartial ('global/email_signature')
    )->setContentType ("text/html");

    $this->getMailer()->send ($message);
  }
}