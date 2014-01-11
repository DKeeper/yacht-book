<?php
/* @var $this DurationtypeController */
/* @var $model DurationType */

$this->breadcrumbs=array(
	'Duration Types'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create DurationType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>