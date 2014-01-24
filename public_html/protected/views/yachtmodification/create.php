<?php
/* @var $this YachtmodificationController */
/* @var $model YachtModification */

$this->breadcrumbs=array(
	'Yacht Modifications'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create YachtModification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>