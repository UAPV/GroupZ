<?php

/**
 * Basic group change event handler to
 */
class gzDebugGroupChangeEventHandler extends gzGroupChangeEventHandler
{

  public function handleGroupCreateEvent (sfEvent $event)
  {
    $group = $event->getSubject();
    $this->log (<<<YAML
  event: new_group
  group: "{$group->getName()}",
  owner: "{$group->getOwner()->getEmail()}"
YAML
    );
  }

  public function handleGroupDeleteEvent (sfEvent $event)
  {
    $group = $event->getSubject();
    $this->log (<<<YAML
  event: delete_group
  group: "{$group->getName()}"
YAML
    );
  }

  public function handleGroupMemberJoinEvent  (sfEvent $event)
  {
    $groupMember = $event->getSubject();
    $this->log (<<<YAML
  event: group_member_join
  group: "{$groupMember->getGroup ()->getName ()}"
  user: "{$groupMember->getUser ()->getEmail ()}"
YAML
    );
  }

  public function handleGroupMemberLeaveEvent (sfEvent $event)
  {
    $groupMember = $event->getSubject();
    $this->log (<<<YAML
  event: group_member_leave
  group: "{$groupMember->getGroup ()->getName ()}"
  user: "{$groupMember->getUser ()->getEmail ()}"
YAML
    );
  }

  protected function log ($message)
  {
    file_put_contents (sfConfig::get ('sf_log_dir').'/gz_events.log', time().":\n$message\n", FILE_APPEND);
  }
}