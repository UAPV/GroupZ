<div class="group_show">
  <h2 class="group_title">
    <?php echo $Group->getTitle() ?>
    <?php if (!$Group->getIsPublic()): ?>
      <?php echo image_tag('private') ?>
    <?php endif ?>
  </h2>
  <p class="group_mail"><a href="mailto:<?php echo $Group->getEmail() ?>" title="<?php echo _('Send an email to the group') ?>"><?php echo $Group->getEmail() ?></a></p>
  <!--<p class="group_description"><?php echo $Group->getDescription() ?></p>-->
  <?php if($sf_user->getId() !== $Group->getCreatedBy()): ?>
    <p class="group_owner"><?php echo _('Created by').' '.$Group->getOwner() ?></p>
  <?php endif ?>
  <p class="group_expire_date"><?php echo $Group->getExpiresAt() ?></p>
</div>
<a href="<?php echo url_for('group/edit?id='.$Group->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('group/index') ?>">List</a>
