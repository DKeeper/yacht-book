<?php
/* @var $this YachttypeController */
/* @var $model YachtType */

$this->breadcrumbs=array(
	'Yacht Types'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create YachtType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>