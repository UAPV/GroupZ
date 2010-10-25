<?php

/**
 * sfValidatorGroupName v
 *
 * @package    GroupZ
 * @subpackage validator
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class sfValidatorGroupName extends sfValidatorString
{
  /**
   * @see sfValidatorString
   */
  protected function doClean($value)
  {
    $value = parent::doClean ($value);

    $blacklists = sfConfig::get ('gz_blacklist', array());
    foreach ($blacklists as $type => $blacklist)
    {
      $method = 'validateWith'.ucfirst ($type);
      $this->$method ($value, (array) $blacklist);
    }
  }

  protected function validateWithLocation ($value, array $locations)
  {
    foreach ($locations as $uri)
    {
      $blacklist = file ($uri);
      if (in_array ($value, $blacklist))
        throw new sfValidatorError ($this, 'invalid', array ('value' => $value));
    }

    return $value;
  }

  protected function validateWithRegex ($value, array $regexes)
  {
    foreach ($regexes as $regex)
      if (preg_match ($regex, $value) > 0)
        throw new sfValidatorError ($this, 'invalid', array ('value' => $value));
  
    return $value;
  }

  protected function validateWithClass ($value, array $classes)
  {
    foreach ($classes as $class)
    {
      if ($class instanceof sfValidatorBase)
      {
        $validator = new $class ();
        $validator->clean ($value);
      }
    }

    return $value;
  }
}
