<?php
/* @var $this CcorderoptionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cc Order Options',
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Cc Order Options</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
