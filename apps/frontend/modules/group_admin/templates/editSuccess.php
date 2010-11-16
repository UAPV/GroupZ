
<?php slot ('breadcrumb',array ($form->getObject()->getTitle () => '@group_show?name='.$form->getObject()->getName(), __('Edit') => null )); ?>

<h1>Edit Group</h1>

<?php include_partial('form', array('form' => $form)) ?>
