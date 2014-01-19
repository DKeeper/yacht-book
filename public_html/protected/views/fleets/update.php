<?php
/* @var $this FleetsController */
/* @var $model CcFleets */

$this->breadcrumbs=array(
	'Cc Fleets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CcFleets', 'url'=>array('index')),
	array('label'=>'Create CcFleets', 'url'=>array('create')),
	array('label'=>'View CcFleets', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CcFleets', 'url'=>array('admin')),
);
?>

<h1>Update CcFleets <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>