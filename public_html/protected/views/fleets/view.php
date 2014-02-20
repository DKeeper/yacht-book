<?php
/* @var $this FleetsController */
/* @var $model CcFleets */

$this->breadcrumbs=array(
	'Cc Fleets'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Update'), 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>Yii::t('view','Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
?>

<h1><?php echo !empty($model->profile->name)?$model->profile->name:Yii::t("view","No name"); ?></h1>

<?php
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        Yii::t("model","Details")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_detail',
                array('profile'=>$model->profile,'yachtFoto'=>$model->yachtPhotos(array('condition'=>'type = :tid','params'=>array(':tid'=>7),'limit'=>1))),
                true
            ),
            'id'=>'tab1'
        ),
        Yii::t("model","Photo")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_photo',
                array('profile'=>$model->profile,'yachtFoto'=>$model->yachtPhotos),
                true
            ),
            'id'=>'tab2'
        ),
        Yii::t("model","Price")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_price',
                array('profile'=>$model->profile,'priceCurrYear'=>$model->priceCurrentYears,'priceNextYear'=>$model->priceNextYears),
                true
            ),
            'id'=>'tab3'
        ),
        Yii::t("model","Orders")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_orders',
                array('profile'=>$model->profile),
                true
            ),
            'id'=>'tab4'
        ),
    ),
    // additional javascript options for the tabs plugin
    'htmlOptions'=>array(
        'id'=>'fleets_tabs',
    ),
));
?>
