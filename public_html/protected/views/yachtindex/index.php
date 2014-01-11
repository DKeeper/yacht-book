<?php
/* @var $this YachtindexController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Yacht Indexes',
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Yacht Indexes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
