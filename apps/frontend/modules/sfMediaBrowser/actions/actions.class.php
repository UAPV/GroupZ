<?php

require_once sfConfig::get('sf_plugins_dir').'/sfMediaBrowserPlugin/modules/sfMediaBrowser/lib/BasesfMediaBrowserActions.class.php';

/**
 *
 *
 * @package     sfMediaBrowser
 * @author      Vincent Agnano <vincent.agnano@particul.es>
 */
class sfMediaBrowserActions extends BasesfMediaBrowserActions
{
  public function preExecute()
  {


    // Configured root dir
    $this->root_dir = sfconfig::get('app_sf_media_browser_root_dir');

    // Calculated root path
    $this->root_path = realpath(sfConfig::get('sf_web_dir').'/'.$this->root_dir);

    $this->requested_dir = urldecode($this->getRequestParameter('dir'));

    $this->requested_dir = $this->checkPath($this->root_path.'/'.$this->requested_dir)
                         ? preg_replace('`(/)+`', '/', $this->requested_dir)
                         : '/';

    $this->getContext()->getRouting()->setDefaultParameters (array ('group_name' => $this->getRequestParameter('group_name')));
  }
}