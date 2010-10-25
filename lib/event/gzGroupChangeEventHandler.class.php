<?php


/**
 * Abstract class to describe group change handlers
 *
 * Naming convention : http://msdn.microsoft.com/en-us/library/h0eyck3s(VS.71).aspx
 */
abstract class gzGroupChangeEventHandler
{

  /**
   * Connect the group change events to a dispatcher
   *
   * @param sfEventDispatcher $dispatcher
   * @return void
   */
  public function setDispatcher (sfEventDispatcher $dispatcher)
  {
    $dispatcher->connect ('gz.group.created',      array($this, 'handleGroupCreatedEvent'));
    $dispatcher->connect ('gz.group.deleted',      array($this, 'handleGroupDeletedEvent'));
    $dispatcher->connect ('gz.group.expired',      array($this, 'handleGroupExpiredEvent'));

    $dispatcher->connect ('gz.member.joined',      array($this, 'handleGroupMemberJoinedEvent'));
    $dispatcher->connect ('gz.member.leaved',      array($this, 'handleGroupMemberLeavedEvent'));
    $dispatcher->connect ('gz.member.invited',     array($this, 'handleGroupMemberInvitedEvent'));
    $dispatcher->connect ('gz.member.postulated',  array($this, 'handleGroupMemberPostulatedEvent'));
  }

  abstract public function handleGroupCreatedEvent (sfEvent $event);
  abstract public function handleGroupDeletedEvent (sfEvent $event);
           public function handleGroupExpiredEvent (sfEvent $event) {}

  abstract public function handleGroupMemberJoinedEvent     (sfEvent $event);
  abstract public function handleGroupMemberLeavedEvent     (sfEvent $event);
           public function handleGroupMemberInvitedEvent    (sfEvent $event) {}
           public function handleGroupMemberPostulatedEvent (sfEvent $event) {}

}
