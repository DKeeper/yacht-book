<?php
/* @var $this SailfurlingController */
/* @var $model SailFurling */

$this->breadcrumbs=array(
	'Sail Furlings'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create SailFurling</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>