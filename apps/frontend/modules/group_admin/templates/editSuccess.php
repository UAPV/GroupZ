<?php include_partial ('global/breadcrumb', array (
  'path' => array ('@group_show?name='.$form->getObject()->getName() => $form->getObject()->getTitle (), 'null' => _('Edit'))))
?>

<h2>Edit Group</h2>

<?php include_partial('form', array('form' => $form)) ?>
