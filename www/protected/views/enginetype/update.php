<?php
/* @var $this EnginetypeController */
/* @var $model EngineType */

$this->breadcrumbs=array(
	'Engine Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','View'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Update EngineType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>