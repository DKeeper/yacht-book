<?php
/* @var $this FleetsController */
/* @var $model CcFleets */
$ccList = CcProfile::model()->getModelList("company_name",' - ',array('order'=>'company_name'));
$fleetList = SyProfile::model()->getModelList("name",' - ',array('order'=>'name'));

$this->breadcrumbs=array(
	'Cc Fleets'=>array('index'),
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
	$('#cc-fleets-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cc Fleets</h1>

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
	'id'=>'cc-fleets-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array(
            'name' => 'cc_id',
            'value' => 'CcProfile::model()->findByAttributes(array("cc_id"=>$data->cc_id))->company_name',
            'filter'=>$ccList,
        ),
        array(
            'name' => 'profile_id',
            'value' => '$data->profile->name',
        ),
        array(
            'name' => 'isActive',
            'value' => '$data->isActive?Yii::t("view","Yes"):Yii::t("view","No")',
        ),
        array(
            'name' => 'isTrash',
            'value' => '$data->isTrash?Yii::t("view","Yes"):Yii::t("view","No")',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
