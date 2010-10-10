
<?php slot ('breadcrumb',array ($form->getObject()->getTitle () => '@group_show?name='.$form->getObject()->getName(), _('Edit') => null )); ?>

<h2>Edit Group</h2>

<?php include_partial('form', array('form' => $form)) ?>
