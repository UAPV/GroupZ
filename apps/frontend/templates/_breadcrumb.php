<?php $path = array_merge (array ('@homepage' => _('My groups')), $path->getRawValue()); ?>

<ul id="breadcrumb">
  <?php foreach ($path as $url => $label): ?>
    <li><?php echo link_to_if (end ($path) != $label, htmlentities ($label), $url) ?></li>
  <?php endforeach ?>
</ul>

