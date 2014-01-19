<?php
/* @var $this FleetsController */
/* @var $model CcFleets */

$this->breadcrumbs=array(
	'Cc Fleets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CcFleets', 'url'=>array('index')),
	array('label'=>'Create CcFleets', 'url'=>array('create')),
	array('label'=>'Update CcFleets', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CcFleets', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CcFleets', 'url'=>array('admin')),
);
?>

<h1>View CcFleets #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cc_id',
		'profile_id',
		'isActive',
		'isTrash',
	),
)); ?>
