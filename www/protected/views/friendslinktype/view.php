<?php
/* @var $this FriendslinktypeController */
/* @var $model FriendsLinkType */

$this->breadcrumbs=array(
	'Friends Link Types'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Update'), 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>Yii::t('view','Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>View FriendsLinkType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
