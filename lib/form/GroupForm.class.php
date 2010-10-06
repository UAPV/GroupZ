<?php

/**
 * Group form.
 *
 * @package    groupz
 * @subpackage form
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class GroupForm extends BaseGroupForm
{
  public function configure()
  {
    $this->widgetSchema->setFormFormatterName('list');

    unset($this['ml_name']);
    unset($this['expires_notice']);
    unset($this['expires_at']);
    unset($this['deleted']);
    unset($this['created_by']);
    unset($this['created_at']);
    unset($this['updated_at']);
    unset($this['group_member_list']);
  }
}
