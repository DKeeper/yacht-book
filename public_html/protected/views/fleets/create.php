<?php
/* @var $this FleetsController */
/* @var $model CcFleets */

$this->breadcrumbs=array(
	'Cc Fleets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CcFleets', 'url'=>array('index')),
	array('label'=>'Manage CcFleets', 'url'=>array('admin')),
);
?>

<h1>Create CcFleets</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>