<?php
/* @var $this SailmaterialController */
/* @var $model SailMaterial */

$this->breadcrumbs=array(
	'Sail Materials'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create SailMaterial</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>