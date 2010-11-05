<?php

/**
 */
class gzWidgetFormSchemaFormatterGroupz extends sfWidgetFormSchemaFormatterTable
{
  /* @var $validatorSchema sfValidatorSchema */
  protected $validatorSchema = null;

  public function generateLabelName($name)
  {
    $label = parent::generateLabelName($name);

    if ($this->checkRequired($name))
    {
      $label .= ' <span class="required">*</span>';
    }

    return $label;
  }

  protected function checkRequired ($name)
  {
    if ($this->validatorSchema === null)
      return false;
    return ($this->validatorSchema->offsetExists ($name) && $this->validatorSchema[$name]->getOption('required'));
  }

  public function setValidatorSchema ($vs)
  {
    $this->validatorSchema = $vs;
  }
}