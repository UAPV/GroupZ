<?php

/**
 * Project form base class.
 *
 * @package    groupz
 * @subpackage form
 * @author     Arnaud Didry <arnaud@didry.info>
 */
abstract class BaseFormPropel extends sfFormPropel
{
  public function setup ()
  {
    parent::setup ();

    $formatter = new gzWidgetFormSchemaFormatterGroupz ($this->widgetSchema);
    $formatter->setValidatorSchema ($this->validatorSchema);

    $this->widgetSchema->addFormFormatter ('groupz', $formatter);
    $this->widgetSchema->setFormFormatterName ('groupz');
  }
}
