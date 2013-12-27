<?php
/* @var $this CcorderoptionsController */
/* @var $model CcOrderOptions */

$this->breadcrumbs=array(
	'Cc Order Options'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create CcOrderOptions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>