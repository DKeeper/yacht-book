<?php
/* @var $this YachtshipyardController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Yacht Shipyards',
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Yacht Shipyards</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
