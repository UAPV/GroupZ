<?php

/**
 * gzDebugEventPlugin configuration.
 *
 * @package     gzDebugEventPlugin
 * @subpackage  config
 * @author      Arnaud Didry <arnaud@didry.info>
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class gzPluginConfiguration extends sfPluginConfiguration
{
  /**
   * Connect the eventDispatcher to the group change handler
   *
   * @param  gzGroupChangeEventHandler $handler
   * @return void
   */
  protected function connectGroupChangeEvents ($handler)
  {
    $handler->setDispatcher ($this->dispatcher);
  }
}