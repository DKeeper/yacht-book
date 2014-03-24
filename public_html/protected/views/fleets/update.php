<?php
/* @var $this FleetsController */
/* @var $model CcFleets */
/* @var $profile SyProfile */
/* @var $yachtFoto array */
/* @var $priceCurrYear PriceCurrentYear[] */
/* @var $priceNextYear PriceNextYear[] */
/* @var $save_mode integer */

$this->breadcrumbs=array(
    Yii::t("view","Company fleets")=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','View'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Update CcFleets <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile,'save_mode'=>$save_mode,'yachtFoto'=>$yachtFoto,'priceCurrYear'=>$priceCurrYear,'priceNextYear'=>$priceNextYear)); ?>