<?php

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
    $dispatcher->connect ('gz_group.new',         array($this, 'handleGroupNewEvent'));
    $dispatcher->connect ('gz_group.delete',      array($this, 'handleGroupDeleteEvent'));
    $dispatcher->connect ('gz_group.expire',      array($this, 'handleGroupExpireEvent'));

    $dispatcher->connect ('gz_member.join',       array($this, 'handleGroupMemberJoinEvent'));
    $dispatcher->connect ('gz_member.leave',      array($this, 'handleGroupMemberLeaveEvent'));
    $dispatcher->connect ('gz_member.postulate',  array($this, 'handleGroupMemberPostulateEvent'));
  }

  abstract public function handleGroupNewEvent (sfEvent $event);
  abstract public function handleGroupDeleteEvent (sfEvent $event);
           public function handleGroupExpireEvent (sfEvent $event) {}

  abstract public function handleGroupMemberJoinEvent  (sfEvent $event);
  abstract public function handleGroupMemberLeaveEvent (sfEvent $event);
           public function handleGroupMemberInviteEvent (sfEvent $event) {}
           public function handleGroupMemberPostulateEvent (sfEvent $event) {}

}