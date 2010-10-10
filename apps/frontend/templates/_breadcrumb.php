<?php $path = array_merge (array (_('My groups') => '@homepage')  , $path->getRawValue()); ?>

<ul id="breadcrumb">
  <?php foreach ($path as $label => $url): ?>
    <li><?php echo link_to_if (end ($path) != $url, htmlentities ($label), $url) ?></li>
  <?php endforeach ?>
</ul>

