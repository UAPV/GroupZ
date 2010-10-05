<?php

/**
 * group actions.
 * This actions are in a separate controller to distinguish the authentication process
 *
 * @package    groupz
 * @subpackage group
 * @author     Arnaud Didry <arnaud@didry.info>
 */
class groupActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->Groups = $this->getUser()->getUserObject()->getCreatedGroups();
    $this->FollowedGroups = $this->getUser()->getUserObject()->getFollowedGroups();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->Group = $this->getRoute()->getObject();
  }
}
