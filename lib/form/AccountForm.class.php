<?php

/**
 * User form.
 *
 * @package    groupz
 * @subpackage form
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class AccountForm extends UserForm
{
  public function configure()
  {
    parent::configure ();

    unset ($this['is_guest']);
    unset ($this['added_by']);
    unset ($this['created_by']);
    unset ($this['created_at']);
    unset ($this['invitation_list']);
    unset ($this['group_member_list']);
    unset ($this['email']);
    unset ($this['salt']);

    $this->widgetSchema['password'] = new sfWidgetFormInputPassword ();
    $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword ();

    $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
    $this->mergePostValidator(new sfValidatorSchemaCompare('password',
                              sfValidatorSchemaCompare::EQUAL, 'password_confirmation',
                              array(),
                              array('invalid' => 'The two passwords must be the same.')));

  }
}
