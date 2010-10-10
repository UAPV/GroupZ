
<div class="group_index">

<?php if(! $sf_user->isGuest()): ?>

  <h2 id="""><?php echo _('My groups') ?>
    <a href="<?php echo url_for('group_admin/new') ?>" class="button large"><?php echo _('New group') ?></a>
  </h2>
    
  <ul class="group_list" id="my_groups">
    <?php include_partial('list', array('Groups' => $Groups)) ?>
  </ul>

<?php endif ?>

<?php if(count ($FollowedGroups)): ?>

  <h2><?php echo _('Groups which I am part of') ?></h2>
  <ul class="group_list" id="followed_groups">
    <?php include_partial('list', array('Groups' => $FollowedGroups)) ?>
  </ul>

<?php endif ?>

</div>