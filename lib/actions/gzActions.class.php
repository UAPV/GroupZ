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
   * @param User   $user      User data
   * @param string $partial   Partial to render
   * @param array  $vars      Vars to pass to the template
   *
   * @return void
   */
  public function sendEmail (User $user, $partial, $vars = array())
  {
    $vars = array_merge (array ('recipient' => $user), $vars);

    $body = $this->getPartial ($partial, $vars).$this->getPartial ('global/email_signature');

    $message = $this->getMailer ()->compose (
      'groupz@univ-avignon.fr', // TODO
      $user->getEmail(),
      '[Groupz] '.html_entity_decode (get_slot ('email_subject'), ENT_QUOTES),
      $body
    )
    ->setContentType ("text/html")
    ->addPart (html_entity_decode (@strip_tags ($body), ENT_QUOTES), 'text/plain');

    $this->getMailer()->send ($message);
  }

  /**
   * Load the i18n helper in order to be able to use it in the controller
   *
   * @return void
   */
  public function loadI18nHelper ()
  {
    $this->getContext()->getConfiguration()->loadHelpers('I18N');
  }
}