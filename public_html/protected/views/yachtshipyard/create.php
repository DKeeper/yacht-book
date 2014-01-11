<?php
/* @var $this YachtshipyardController */
/* @var $model YachtShipyard */

$this->breadcrumbs=array(
	'Yacht Shipyards'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create YachtShipyard</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>