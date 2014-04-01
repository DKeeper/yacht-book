<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 20.02.14
 * @time 9:40
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $priceCurrYear PriceCurrentYear */
/* @var $priceNextYear PriceNextYear */
/** @var $fleet CcFleets */
$fleet = $profile->ccFleets[0];
/** @var $ccProfile CcProfile */
$ccProfile = CcProfile::model()->findByAttributes(array('cc_id'=>$fleet->cc_id));
/** @var $transitLogs CcTransitLog[] */
$transitLogs = $ccProfile->ccTransitLogs(array('condition'=>'obligatory = 1'));
/** @var $includedOptions CcOrderOptions[] */
$includedOptions = $ccProfile->ccOrderOptions(array('condition'=>'obligatory = 1'));
/** @var $otherOptions CcOrderOptions[] */
$otherOptions = $ccProfile->ccOrderOptions(array('condition'=>'obligatory = 0'));
$t = 0;
?>
<div class="row">
    Заглушка - календарь
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <h3><?php echo Yii::t("view","OBLIGATORY"); ?></h3>
        </div>
        <?php
        if(!empty($transitLogs)){
            echo $this->renderRow(CcTransitLog::model(),'name',array(
                'label' => CHtml::tag("strong",array(),Yii::t("model","transit log")),
                'value' => '',
            ));
            foreach($transitLogs as $transitLog){
                echo $this->renderRow($transitLog,'price',array(
                    'label' => $transitLog->country['nazvanie_'.Yii::app()->params['geoFieldName'][Yii::app()->language]],
                    'value' => $transitLog->included?Yii::t("view","incl."):$transitLog->price,
                ));
            }
        }
        if(!empty($includedOptions)){
            echo $this->renderRow(CcOrderOptions::model(),'name',array(
                'label' => CHtml::tag("strong",array(),Yii::t("model","order options")),
                'value' => '',
            ));
            foreach($includedOptions as $option){
                echo $this->renderRow($option,'price',array(
                    'label' => $option->orderOption->name,
                    'value' => $option->included?Yii::t("view","incl."):$option->price,
                ));
            }
        }
        ?>
        <?php echo $this->renderRow($profile,'last_cleaning_incl',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->last_cleaning_price,
        ));
        ?>
        <div class="row">
            <h3><?php echo Yii::t("view","EXTRAS"); ?></h3>
        </div>
        <?php
        if(!empty($otherOptions)){
            echo $this->renderRow(CcOrderOptions::model(),'name',array(
                'label' => CHtml::tag("strong",array(),Yii::t("model","order options")),
                'value' => '',
            ));
            foreach($otherOptions as $option){
                echo $this->renderRow($option,'price',array(
                    'label' => $option->orderOption->name,
                    'value' => $option->included?Yii::t("view","incl."):$option->price,
                ));
            }
        }
        ?>
        <?php echo $this->renderRow($profile,'spinnaker',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->spinnaker_price,
        ));
        ?>
        <?php echo $this->renderRow($profile,'gennaker',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->gennaker_price,
        ));
        ?>
    </div>
    <div class="col-md-6">
        <div class="row">
            <h3><?php echo Yii::t("view","DEPOSIT"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'spinnaker',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->spinnaker_deposiit,
        ));
        ?>
        <?php echo $this->renderRow($profile,'gennaker',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->gennaker_deposit,
        ));
        ?>
        <?php echo $this->renderRow($profile,'race_sail',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->race_sail_deposit,
        ));
        ?>
    </div>
</div>