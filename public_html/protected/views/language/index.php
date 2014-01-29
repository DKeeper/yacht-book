<?php
/* @var $this LanguageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Languages',
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Languages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
