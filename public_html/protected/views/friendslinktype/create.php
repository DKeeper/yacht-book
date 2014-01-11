<?php
/* @var $this FriendslinktypeController */
/* @var $model FriendsLinkType */

$this->breadcrumbs=array(
	'Friends Link Types'=>array('index'),
	'Create',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create FriendsLinkType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>