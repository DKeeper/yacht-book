<?php
/* @var $this OrderoptionsController */
/* @var $model OrderOptions */

$this->breadcrumbs=array(
	'Order Options'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create OrderOptions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>