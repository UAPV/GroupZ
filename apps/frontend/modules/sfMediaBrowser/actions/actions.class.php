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
    sfConfig::set('app_sf_media_browser_root_dir', '/uploads/'.$this->group->getName());
    @mkdir (sfConfig::get('sf_web_dir').'/uploads/'.$this->group->getName());

    $this->getContext()->getRouting()->setDefaultParameters (array ('group_name' => $this->group->getName()));

    parent::preExecute();
  }
}