<?php

/**
 * gzDebugEventPlugin configuration.
 *
 * @package     gzDebugEventPlugin
 * @subpackage  config
 * @author      Arnaud Didry <arnaud@didry.info>
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
