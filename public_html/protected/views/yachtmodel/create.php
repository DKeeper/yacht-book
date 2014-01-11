<?php
/* @var $this YachtmodelController */
/* @var $model YachtModel */

$this->breadcrumbs=array(
	'Yacht Models'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create YachtModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>