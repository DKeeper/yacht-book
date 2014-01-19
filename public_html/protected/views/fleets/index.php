<?php
/* @var $this FleetsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cc Fleets',
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Cc Fleets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
