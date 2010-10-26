<?php

/**
 * gzApplicationConfiguration represents a configuration for a symfony application.
 *
 * @package    GroupZ
 * @subpackage config
 * @author     Arnaud Didry <arnaud@didry.info>
 * @version    SVN: $Id: sfApplicationConfiguration.class.php 29526 2010-05-19 13:06:40Z fabien $
 */
class gzApplicationConfiguration extends sfApplicationConfiguration
{
  /**
   * Various initializations.
   */
  public function initConfiguration()
  {
    parent::initConfiguration();
    $this->getConfigCache()->checkConfig('config/groupz.yml');
  }
}
