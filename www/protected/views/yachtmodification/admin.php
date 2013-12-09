<?php
/* @var $this YachtmodificationController */
/* @var $model YachtModification */
$yachtModelList = YachtModel::model()->getModelList(array('shipyard'=>'name'));

$this->breadcrumbs=array(
	'Yacht Modifications'=>array('index'),
	'Manage',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#yacht-modification-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Yacht Modifications</h1>

<p>
    <?php
    echo Yii::t('view',"You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.");
    ?>
</p>

<?php echo CHtml::link(Yii::t('view','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'yacht-modification-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array(
            'name'=>'model_id',
            'value'=>'$data->model->name." (".$data->model->shipyard->name.")"',
            'filter'=>$yachtModelList,
        ),
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
