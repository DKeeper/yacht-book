<?php
/* @var $this YachtindexController */
/* @var $model YachtIndex */

$this->breadcrumbs=array(
	'Yacht Indexes'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create YachtIndex</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>