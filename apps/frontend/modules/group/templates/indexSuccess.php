
<a href="<?php echo url_for('group/new') ?>"><?php echo _('New group') ?></a>

<h2><?php echo _('My groups') ?></h2>
<ul id="group_list">
  <?php include_partial('list', array('Groups' => $Groups)) ?>
</ul>


<?php if(false /* TODO count($GroupsFollowed) */): ?>

  <h2><?php echo _('Groups which I am part of') ?></h2>
  <ul id="group_followed">
    <?php include_partial('list', array('Groups' => $GroupsFollowed)) ?>
  </ul>

<?php endif ?>