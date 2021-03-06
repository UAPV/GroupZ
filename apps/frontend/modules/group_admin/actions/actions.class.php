<?php

/**
 * group actions.
 *
 * @package    groupz
 * @subpackage group_admin
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class group_adminActions extends gzActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new GroupForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new GroupForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $group = $this->getGroup ();
    $this->checkOwner ($group);

    $this->form = new GroupForm($group);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $group = $this->getGroup ();
    $this->checkOwner ($group);

    $this->form = new GroupForm($group);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    // TODO Ask confirmation twice !

    $group = $this->getGroup ();
    $this->checkOwner ($group);
    $group->delete();

    $this->redirect('@homepage');
  }

  public function executeValidateName (sfWebRequest $request)
  {
    $name = $request->getParameter ('name');

    $validator = new gzValidatorGroupName ();
    try
    {
      $validator->clean ($name);  
    }
    catch (Exception  $e)
    {
      $this->loadI18nHelper();
      return $this->returnJSON (array ('valid' => false, 'message' => __($e)));
    }

    return $this->returnJSON (array ('valid' => true));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $Group = $form->save();

      $this->loadI18nHelper();
      $flashMessage = __('Group saved').'. ';
      $emailErrors = array ();

      $invitations = $form->getInvitations ();
      foreach ($invitations as $invitation)
      {
        try
        {
          $this->sendEmail ($invitation->getUser(), 'email_invitation', array ('invitation' => $invitation));
        }
        catch (Exception $e)
        {
          // Stop exception in order to be able to send the other invitations left
          // TODO log this !

          $emailErrors [] = $invitation->getUser ()->getEmail ();
        }
      }

      if (count ($invitations) > 0)
        $flashMessage .= format_number_choice('[1]One invitation were sent|(1,+Inf]%count% invitations were sent.',
          array ('%count%' => count ($invitations)), count ($invitations));

      if (count ($emailErrors) > 0)
        $this->getUser ()->setFlashError (__('Couldn\'t send invitations to %emails%', implode(', ', $emailErrors)));

      $this->getUser ()->setFlashNotice ($flashMessage);
      $this->redirect('@group_admin_edit?name='.$Group->getName());
    }
  }

  /**
   * @return Group
   */
  protected function getGroup ()
  {
    return $this->getRoute()->getObject();
  }

  /**
   * Checks if the connected user is the owner of the group
   *
   * @param  $group
   * @return void
   */
  protected function checkOwner ($group)
  {
    if ($this->getUser ()->getId () != $group->getCreatedBy ())
      $this->forwardToSecureAction();
  }
}
