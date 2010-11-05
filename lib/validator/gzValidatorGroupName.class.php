<?php

/**
 * gzValidatorGroupName
 *
 * @package    GroupZ
 * @subpackage validator
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class gzValidatorGroupName extends sfValidatorString
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', 'A group named "%value%" already exists or is forbidden.');
  }

  /**
   * @see sfValidatorString
   */
  protected function doClean($value)
  {
    $value = parent::doClean ($value);

    if (GroupQuery::create ()->findOneByName($value) !== null)
      throw new sfValidatorError ($this, 'invalid', array ('value' => $value));

    $blacklists = sfConfig::get ('gz_blacklist', array());
    foreach ($blacklists as $type => $blacklist)
    {
      $method = 'validateWith'.ucfirst ($type);
      $this->$method ($value, (array) $blacklist);
    }

    return $value;
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
        $value = $validator->clean ($value);
      }
    }

    return $value;
  }
}
