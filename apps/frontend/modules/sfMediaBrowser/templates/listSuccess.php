<?php sfMediaBrowserUtils::loadAssets('list') ?>
<?php use_helper('I18N') ?>
<?php $upload_form->getWidgetSchema()->setFormFormatterName('list') ?>
<?php $dir_form->getWidgetSchema()->setFormFormatterName('list') ?>

<?php slot ('breadcrumb', array ($group->getTitle () => '@group_show?name='.$group->getName(), __('Media') => null)); ?>

<?php if($sf_user->hasFlash('error')): ?>
  <div class="flash_error">
  <?php if($sf_user->getFlash('error') == 'directory.delete'): ?>
    <?php echo __('The directory could not be deleted.') ?>
  <?php elseif($sf_user->getFlash('error') == 'file.create'): ?>
    <?php echo __('The file could not be uploaded.') ?>
  <?php elseif($sf_user->getFlash('error') == 'directory.create'): ?>
    <?php echo __('The directory could not be created.') ?>
  <?php endif ?>
  </div>
<?php elseif($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice">
  <?php if($sf_user->getFlash('notice') == 'directory.create'): ?>
    <?php echo __('The directory was successfully created.') ?>
  <?php elseif($sf_user->getFlash('notice') == 'directory.delete'): ?>
    <?php echo __('The directory was successfully deleted.') ?>
  <?php elseif($sf_user->getFlash('notice') == 'file.create'): ?>
    <?php echo __('The file was successfully uploaded.') ?>
  <?php elseif($sf_user->getFlash('notice') == 'file.delete'): ?>
    <?php echo __('The file was successfully deleted.') ?>
  <?php endif ?>
  </div>
<?php endif ?>

<?php $sf_user->getAttributeHolder()->remove ('error', null, 'symfony/user/sfUser/flash') // unset flash to prevent its display in the layout ?>
<?php $sf_user->getAttributeHolder()->remove ('notice', null, 'symfony/user/sfUser/flash') // unset flash to prevent its display in the layout ?>

<h2><?php echo sprintf(__('Current directory : %s'), $display_dir) ?></h2>

<div id="sf_media_browser_user_message"></div>

<div id="sf_media_browser_forms">
  <fieldset id="upload">
    <legend><?php echo __('Upload a file') ?></legend>
    <form action="<?php echo url_for('sf_media_browser_file_create') ?>" method="post" enctype="multipart/form-data">
      <?php echo $upload_form ?>
      <input type="submit" class="submit" value="<?php echo __('Save') ?>" />
    </form>
  </fieldset>

  <fieldset id="mkdir">
    <legend><?php echo __('Create a new directory') ?></legend>
    <form action="<?php echo url_for('sf_media_browser_dir_create') ?>" method="post">
      <?php echo $dir_form ?>
      <input type="submit" class="submit" value="<?php echo __('Create') ?>" />
    </form>
  </fieldset>
  <div class="clear"></div>
</div>


<ul id="sf_media_browser_list">

  <?php if($parent_dir): ?>
  <li class="up">
    <div class="icon">
      <?php echo link_to(image_tag('/sfMediaBrowserPlugin/images/icons/up.png'), $current_route, array_merge($sf_data->getRaw('current_params'), array('dir' => $parent_dir))) ?>
    </div>
  </li>
  <?php endif ?>

<?php foreach($dirs as $dir): ?>
  <li class="folder">
    <div class="icon">
      <?php echo link_to(image_tag('/sfMediaBrowserPlugin/images/icons/folder.png'), $current_route, array_merge($sf_data->getRaw('current_params'), array('dir' => $relative_dir.'/'.$dir)), array('title' => $dir)) ?>
    </div>
    <label class="name"><?php echo $dir ?></label>
    <div class="action"><?php echo link_to('delete', 'sf_media_browser_dir_delete', array('sf_method' => 'delete', 'directory' => urlencode($relative_dir.'/'.$dir)), array('class' => 'delete', 'title' => sprintf(__('Delete folder "%s"'), $dir))) ?></div>
  </li>
<?php endforeach ?>

<?php foreach($files as $file): ?>
  <li class="file">
    <?php include_component('sfMediaBrowser', 'icon', array('file_url' => $relative_url.'/'.$file, 'relative_dir' => $relative_dir)) ?>
  </li>
<?php endforeach ?>
</ul>

<script type="text/javascript">
var delete_msg = "<?php echo __('Are you sure you want to delete this item ?') ?>";
var move_file_url = "<?php echo url_for('sf_media_browser_move') ?>";
var rename_file_url = "<?php echo url_for('sf_media_browser_rename') ?>";
</script>

<div class="clear"></div>