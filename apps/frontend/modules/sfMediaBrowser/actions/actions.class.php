<?php

require_once sfConfig::get('sf_plugins_dir').'/sfMediaBrowserPlugin/modules/sfMediaBrowser/lib/BasesfMediaBrowserActions.class.php';

/**
 *
 * @package     sfMediaBrowser
 * @author      Arnaud Didry <arnaud@didry.info>
 */
class sfMediaBrowserActions extends BasesfMediaBrowserActions
{
  public function preExecute()
  {
    $this->group = GroupQuery::create()->findOneByName ($this->getRequestParameter('group_name'));
    $this->forward404Unless ($this->group);

    // TODO check membership

    // Override root dir
    $rootDir = 'uploads/'.$this->group->getName();
    sfConfig::set('app_sf_media_browser_root_dir', $rootDir);
    @mkdir (sfConfig::get('sf_web_dir').'/'.$rootDir);

    $this->getContext()->getRouting()->setDefaultParameters (array ('group_name' => $this->group->getName()));

    parent::preExecute();
  }
}