<?php
/* @var $this FleetsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cc Fleets',
);

$this->menu=array(
	array('label'=>'Create CcFleets', 'url'=>array('create')),
	array('label'=>'Manage CcFleets', 'url'=>array('admin')),
);
?>

<h1>Cc Fleets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
