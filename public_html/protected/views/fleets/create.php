<?php
/* @var $this FleetsController */
/* @var $model CcFleets */
/* @var $profile SyProfile */
/* @var $yachtFoto array */
/* @var $priceCurrYear PriceCurrentYear[] */
/* @var $priceNextYear PriceNextYear[] */

$this->breadcrumbs=array(
    Yii::t("view","Company fleets")=>array('index'),
	Yii::t('view','Create'),
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1>Create <?php echo Yii::t("view","Fleet"); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile,'yachtFoto'=>$yachtFoto,'priceCurrYear'=>$priceCurrYear,'priceNextYear'=>$priceNextYear)); ?>