<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php  /* @var $form sfFormSymfony */  ?>

<form action="<?php echo url_for('group/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>


  <?php echo $form->renderHiddenFields(false) ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <script type="text/javascript">
    $(document).ready(function() {

      function cleanGroupName (name) {
        return name.replace (/[^a-z0-9]/ig,'-').toLowerCase ();
      }

      $('#group_title').keyup (function () {
        if(!$('#group_name').data ('overriden'))
        {
          $('#group_name').val (cleanGroupName ($(this).val ()));
        }
      });

      $('#group_name').keyup (function (event) {
        $(this).val (cleanGroupName ($(this).val()));
        $(this).data ('overriden', true);
      });
      
    });
  </script>

  <ul class="fields on-2 columns new_group">
    <li class="column" id="title">
      <?php echo $form['title']->renderLabel() ?>
      <?php echo $form['title']->render() ?>
      <?php echo $form['title']->renderError() ?>
    </li>
    <li class="column" id="name">
      <?php echo $form['name']->renderLabel() ?>
      <?php echo $form['name']->render() ?>
      <span>
        @groupes.univ-avignon.fr <?php // TODO changeme ?>
      </span>
      <?php echo $form['name']->renderError() ?>
    </li>
    <li id="description">
      <?php echo $form['description']->renderLabel() ?>
      <?php echo $form['description']->render() ?>
      <?php echo $form['description']->renderError() ?>
    </li>
    <li id="is_public">
      <?php echo $form['is_public']->render() ?>
      <?php echo $form['is_public']->renderLabel() ?>
    </li>
  </ul>

  <div class="on-2 columns">
    <div class="column">
      <label><?php echo _('Internal members') ?></label>
    </div>
    <div class="column">
      <label><?php echo _('External members') ?></label>
    </div>
  </div>

  <div class="form_actions">
    <input type="submit" value="<?php echo _('Save') ?>" />&nbsp;&nbsp;
    <?php if (!$form->getObject()->isNew()): ?>
      <?php echo link_to(_('Delete'), 'group/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => _('Are you sure?'))) ?>&nbsp;&nbsp;
    <?php endif; ?>
    <a href="<?php echo url_for('group/index') ?>"><?php echo _('Back to list') ?></a>
  </div>

</form>
