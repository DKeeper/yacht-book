<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.12.13
 * @time 16:10
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileCC CCProfile */
/* @var $form CActiveForm */
/* @var $paymentsPeriods CcPaymentsPeriod[] */
$durationTypeList = DurationType::model()->getModelList();
?>
    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkin_day'); ?>
        <?php echo $form->textField($profileCC,'checkin_day'); ?>
        <?php echo $form->error($profileCC,'checkin_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkin_hour'); ?>
        <?php echo $form->textField($profileCC,'checkin_hour'); ?>
        <?php echo $form->error($profileCC,'checkin_hour'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkout_day'); ?>
        <?php echo $form->textField($profileCC,'checkout_day'); ?>
        <?php echo $form->error($profileCC,'checkout_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkout_hour'); ?>
        <?php echo $form->textField($profileCC,'checkout_hour'); ?>
        <?php echo $form->error($profileCC,'checkout_hour'); ?>
    </div>

    <?php
        echo CHtml::label(Yii::t("view","Payment period - [%][before][type]"),"");
        foreach($paymentsPeriods as $i=>$period){
            ?>
            <div class="row">
            <?php
                echo $form->textField($period,"[$i]value",array('size'=>'3'));
                echo $form->textField($period,"[$i]before_duration",array('size'=>'3'));
                echo $form->dropDownList($period,"[$i]duration_type_id",$durationTypeList);
            ?>
            </div>
            <?php
        }
    ?>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'payment_other'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'payment_other',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'payment_other'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'cancel_other'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'cancel_other',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'cancel_other'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'repeater_discount'); ?>
        <?php echo $form->textField($profileCC,'repeater_discount'); ?>
        <?php echo $form->error($profileCC,'repeater_discount'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'max_discount'); ?>
        <?php echo $form->textField($profileCC,'max_discount'); ?>
        <?php echo $form->error($profileCC,'max_discount'); ?>
    </div>