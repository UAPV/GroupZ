<?php decorate_with('login'); ?>


<div class="login_block">
  <p class="auth_method_title"><?php echo __('Connect with your %organization% account', array ('%organization%' => 'organization')) ?></p>

  <?php echo image_tag ('auth_logo.png', array('class'=>'auth_logo')) ?>

  <?php use_helper ('Cas') ?>
  <?php echo detect_cas_session () ?>

  <p style="text-align: center">
    <?php echo link_to_cas_login( _('Connect'), array ('class' => 'button large')) ?>
  </p>
</div>

<p class="auth_method_separator">
  <?php echo _('or') ?>
</p>

<div class="login_block">
  <p class="auth_method_title"><?php echo _('Connect with a guest account') ?></p>

  <form action="" method="post">
    <p id="username">
      <label><?php echo _('Email') ?></label>
      <input type="text" name="email" class="username" value="" placeholder="<?php echo _('email') ?>" tabindex="1"/>
    </p>
    <p id="password">
      <label><?php echo _('Password') ?></label>
      <input type="password" name="password" class="password" placeholder="<?php echo _('password') ?>"/>
    </p>
    <p id="submit-login">
      <input type="submit" class="large" value="<?php echo _('Log me in') ?>" />
    </p>
  </form>
</div>
