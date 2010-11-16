<?php slot ('email_subject', __('You have been invited to join a group')) ?>

<p><?php echo __('Hello') ?>,</p>

<p><?php echo __('%user% would like you to join his group "%group_title%"', array (
    '%user%' => $invitation->getGroup()->getOwner (),
    '%group_title%' => $invitation->getGroup()
)) ?></p>

<p><b><?php echo __('Group description') ?></b> :</p>

<p style="background: #FBF8EB; border: 1px solid #EFEBDD; padding: 20px;">
  <?php echo nl2br ($invitation->getGroup ()->getDescription ()) ?>
</p>

<?php $acceptURL = url_for ('@invitation_accept?invitation='.$invitation->getHash(), true); ?>
<?php $declineURL = url_for ('@invitation_decline?invitation='.$invitation->getHash(), true); ?>

<p style="color: #4C801E;">
  <?php echo __('To <b>accept</b> his request open the following link') ?> : <a href="<?php echo $acceptURL ?>"><?php echo $acceptURL ?></a>
</p>

<p style="color: #B32508;">
  <?php echo __('Otherwise, open the following link to <b>decline</b>') ?> : <a href="<?php echo $declineURL ?>"><?php echo $declineURL ?></a>
</p>
