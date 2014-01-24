<?php
/* @var $this EnginetypeController */
/* @var $model EngineType */

$this->breadcrumbs=array(
	'Engine Types'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create EngineType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>