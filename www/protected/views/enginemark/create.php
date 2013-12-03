<?php
/* @var $this EnginemarkController */
/* @var $model EngineMark */

$this->breadcrumbs=array(
	'Engine Marks'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create EngineMark</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>