<div id="edit_account">

  <h2><?php echo __('My account') ?> <span class="email">: <?php echo $form->getObject ()->getEmail () ?></span> </h2>

  <?php slot ('breadcrumb', array ('' => null)); ?>

  <?php include_partial('form', array('form' => $form)) ?>

</div>