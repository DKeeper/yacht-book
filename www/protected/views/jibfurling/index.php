<?php
/* @var $this JibfurlingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jib Furlings',
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Jib Furlings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
