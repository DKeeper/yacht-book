<?php
/* @var $this MediatypeController */
/* @var $model MediaType */

$this->breadcrumbs=array(
	'Media Types'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create MediaType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>