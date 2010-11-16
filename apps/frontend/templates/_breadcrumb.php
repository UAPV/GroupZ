<ul id="breadcrumb">
  <li><?php echo link_to_if (count ($path), __('My groups'), '@homepage') ?></li>
  <?php $i=0; foreach ($path as $label => $url): $i++;?>
    <li><?php echo link_to_if ($url !== null && $i != count ($path), $label, $url) ?></li>
  <?php endforeach ?>
</ul>

