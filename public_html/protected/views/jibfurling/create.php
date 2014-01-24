<?php
/* @var $this JibfurlingController */
/* @var $model JibFurling */

$this->breadcrumbs=array(
	'Jib Furlings'=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create JibFurling</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>