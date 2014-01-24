<?php
/* @var $this OrderstatusController */
/* @var $model OrderStatus */

$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create OrderStatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>