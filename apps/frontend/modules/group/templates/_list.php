<?php foreach ($Groups as $Group): ?>
  <li class="group">
    <p class="group_title">
      <?php echo link_to($Group->getTitle(), '@group_show?name='.$Group->getName(), array ('title' => __('Display details'))) ?>
      <?php if (!$Group->getIsPublic()): ?>
        <?php echo image_tag ('icons/keys.png', array ('title' => __('This group is restrited'))) ?>
      <?php endif ?>
    </p>
    <p class="group_mail"><a href="mailto:<?php echo $Group->getEmail() ?>" title="<?php echo __('Send an email to the group') ?>"><?php echo $Group->getEmail() ?></a></p>
    <!--<p class="group_description"><?php echo $Group->getDescription() ?></p>-->
    <?php if($sf_user->getId() !== $Group->getCreatedBy()): ?>
      <p class="group_owner"><?php echo __('Created by').' '.$Group->getOwner() ?></p>
    <?php endif ?>
    <p class="group_expire_date"><?php echo $Group->getExpiresAt() ?></p>
  </li>
<?php endforeach; ?>