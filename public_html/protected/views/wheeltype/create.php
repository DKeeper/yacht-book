<?php
/* @var $this WheeltypeController */
/* @var $model WheelType */

$this->breadcrumbs=array(
	'Wheel Types'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create WheelType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>