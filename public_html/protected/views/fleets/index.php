<?php
/* @var $this FleetsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t("view","Company fleets"),
);

$this->menu=array(
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t("view","Company fleets"); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<script>
    $(function(){
        $("div.view").on("click",function(){
            var id = $(this).data("fleet");
            location.href = "/fleets/"+id;
        });
    });
</script>
