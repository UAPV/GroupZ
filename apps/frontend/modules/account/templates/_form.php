<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<?php echo $form->renderFormTag (url_for ('@account_update')) ?>

  <?php echo $form->renderHiddenFields(false) ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
      <?php echo $form->renderGlobalErrors() ?>
    </div>
  <?php endif; ?>

  <fieldset>
    <legend><?php echo __('Name') ?></legend>
    <ul class="fields on-2 columns">
      <li class="column">
        <?php echo $form['firstname']->renderLabel() ?>
        <?php echo $form['firstname']->render() ?>
        <?php echo $form['firstname']->renderError() ?>
      </li>
      <li class="column">
        <?php echo $form['lastname']->renderLabel() ?>
        <?php echo $form['lastname']->render() ?>
        <?php echo $form['lastname']->renderError() ?>
      </li>
    </ul>
  </fieldset>
  <fieldset>
    <legend><?php echo __('Contact') ?></legend>
    <ul class="fields on-2 columns">
      <li class="column">
        <?php echo $form['org']->renderLabel() ?>
        <?php echo $form['org']->render() ?>
        <?php echo $form['org']->renderError() ?>
      </li>
      <li class="column">
        <?php echo $form['tel']->renderLabel() ?>
        <?php echo $form['tel']->render() ?>
        <?php echo $form['tel']->renderError() ?>
      </li>
    </ul>
  </fieldset>
  <fieldset>
    <legend><?php echo __('Authentication') ?></legend>
    <ul class="fields on-2 columns">
      <li class="column">
        <?php echo $form['password']->renderLabel() ?>
        <?php echo $form['password']->render() ?>
        <?php echo $form['password']->renderError() ?>
      </li>
      <li class="column">
        <?php echo $form['password_confirmation']->renderLabel() ?>
        <?php echo $form['password_confirmation']->render() ?>
        <?php echo $form['password_confirmation']->renderError() ?>
      </li>
    </ul>
  </fieldset>

  <div class="form_actions">
    <input type="submit" value="Save" />
    &nbsp;|&nbsp;&nbsp;<?php echo link_to (__('Go back to the group list'), '@homepage') ?>
  </div>

</form>
