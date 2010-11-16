
<?php slot ('breadcrumb', array ($Group->getTitle () => null)); ?>

<div class="group_show">
  <h1 class="group_title">
    <?php echo $Group->getTitle() ?>
    <?php if (!$Group->getIsPublic()): ?>
      <?php echo image_tag('private') ?>
    <?php endif ?>
  </h1>
  <p class="group_mail"><a href="mailto:<?php echo $Group->getEmail() ?>" title="<?php echo __('Send an email to the group') ?>"><?php echo $Group->getEmail() ?></a></p>
  <!--<p class="group_description"><?php echo $Group->getDescription() ?></p>-->
  <?php if($sf_user->getId() !== $Group->getCreatedBy()): ?>
    <p class="group_owner"><?php echo __('Created by').' '.$Group->getOwner() ?></p>
  <?php endif ?>
  <p class="group_expire_date"><?php echo $Group->getExpiresAt() ?></p>
</div>
<a href="<?php echo url_for('@group_admin_edit?name='.$Group->getName()) ?>">Edit</a>
