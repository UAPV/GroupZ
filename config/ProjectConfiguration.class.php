<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    require_once '../lib/config/gzPluginConfiguration.class.php'; // class loader doesn't seems initialized yet... ?!

    $this->enablePlugins('sfPropel15Plugin');
    $this->enablePlugins('uapvAuthPlugin');
    $this->enablePlugins('sfTaskExtraPlugin');
    $this->enablePlugins('gzDebugEventPlugin');
  }
}
