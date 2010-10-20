<?php

/**
 * Sample GroupZ plugin
 *
 * @subpackage  config
 * @author      Arnaud Didry <arnaud@didry.info>
 */
class gzDebugEventPluginConfiguration extends gzPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->connectGroupChangeEvents(new gzDebugGroupChangeEventHandler ());
  }
}
