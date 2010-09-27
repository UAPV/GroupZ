    <?php foreach ($Groups as $Group): ?>
    <li class="group">
      <p class="group_title">
        <?php if(true /* TODO $sf_user->getId() === $Group->getOwnerId() */): ?>
          <?php echo link_to($Group->getTitle(), 'group/edit?id='.$Group->getId()) ?>
        <?php else: ?>
          <?php echo link_to($Group->getTitle(), 'group/show?id='.$Group->getId()) ?>
        <?php endif ?>
        <?php if (!$Group->getIsPublic()): ?>
          <?php echo image_tag('private') ?>
        <?php endif ?>
      </p>
      <p class="group_name"><?php echo $Group->getName() ?></td>
      <p class="group_description">><?php echo $Group->getDescription() ?></p>
      <?php if(true /* TODO $sf_user->getId() !== $Group->getOwnerId() */): ?>
        <p class="group_owner">><?php echo _('Created by').' '.$Group->getOwner() ?></p>
      <?php endif ?>
      <p class="group_expire_date">><?php echo $Group->getExpiresAt() ?></p>
    </li>
    <?php endforeach; ?>