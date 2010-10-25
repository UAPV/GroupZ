<?php

/**
 * Basic group change event handler to
 */
class gzDebugGroupChangeEventHandler extends gzGroupChangeEventHandler
{

  public function handleGroupCreatedEvent (sfEvent $event)
  {
    $group = $event->getSubject();
    $this->log (<<<YAML
  event: created_group
  group: "{$group->getName()}",
  owner: "{$group->getOwner()->getEmail()}"
YAML
    );
  }

  public function handleGroupDeletedEvent (sfEvent $event)
  {
    $group = $event->getSubject();
    $this->log (<<<YAML
  event: deleted_group
  group: "{$group->getName()}"
YAML
    );
  }

  public function handleGroupMemberJoinedEvent  (sfEvent $event)
  {
    $groupMember = $event->getSubject();
    $this->log (<<<YAML
  event: group_member_joined
  group: "{$groupMember->getGroup ()->getName ()}"
  user: "{$groupMember->getUser ()->getEmail ()}"
YAML
    );
  }

  public function handleGroupMemberLeavedEvent (sfEvent $event)
  {
    $groupMember = $event->getSubject();
    $this->log (<<<YAML
  event: group_member_leaved
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
