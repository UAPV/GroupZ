<?php



/**
 * Skeleton subclass for representing a row from the 'gz_invitation' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.5.4 on:
 *
 * Thu Sep 23 21:16:36 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class Invitation extends BaseInvitation {

  public function __toString()
  {
    return $this->getHash();
  }

} // Invitation
