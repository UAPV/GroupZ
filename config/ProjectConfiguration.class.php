<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // class loader doesn't seems initialized yet... ?!
    require_once dirname(__FILE__).'/../lib/config/gzPluginConfiguration.class.php';
    require_once dirname(__FILE__).'/../lib/event/gzGroupChangeEventHandler.class.php';

    $this->enablePlugins('sfPropel15Plugin');
    $this->enablePlugins('uapvAuthPlugin');
    $this->enablePlugins('sfTaskExtraPlugin');
    $this->enablePlugins('gzDebugEventPlugin');
    $this->enablePlugins('sfMediaBrowserPlugin');
  }
}
