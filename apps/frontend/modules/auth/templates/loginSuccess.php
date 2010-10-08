<?php decorate_with('login'); ?>

<?php use_helper ('Cas') ?>
<?php echo detect_cas_session () ?>
<?php echo link_to_cas_login( _('Click here if you already have an account at the university')) // TODO make the message more explicit ?>

<form action="" method="post">
  <p id="username">
    <label><?php echo _('Username') ?></label>
    <input type="text" name="username" class="username" value="" placeholder="<?php echo _('username') ?>"/>
  </p>
  <p id="password">
    <label><?php echo _('Password') ?></label>
    <input type="password" name="password" class="password" placeholder="<?php echo _('password') ?>"/>
  </p>
  <p id="submit-login">
    <input type="submit" class="awesome large blue" value="<?php echo _('Log me in') ?>" />
  </p>
</form>
<script type="text/javascript">
$(document).ready (function () {
  $("input[name='username']").get(0).focus ();
});
</script>