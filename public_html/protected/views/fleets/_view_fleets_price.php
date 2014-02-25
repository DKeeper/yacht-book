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
?>
<div class="row">
    Заглушка - календарь
</div>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <h3><?php echo Yii::t("view","OBLIGATORY"); ?></h3>
        </div>
        <?php echo $this->renderRow($profile,'last_cleaning_incl',array(
            'measure'=>CcProfile::model()->findByAttributes(array('cc_id'=>$profile->ccFleets[0]->cc_id))->currency->name,
            'outtype'=>'checkbox',
            'value'=>$profile->last_cleaning_price,
        ));
        ?>
        <div class="row">
            <h3><?php echo Yii::t("view","EXTRAS"); ?></h3>
        </div>
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