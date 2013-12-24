<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.12.13
 * @time 17:55
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $period CcPaymentsPeriod */
/* @var $form CActiveForm */
$durationTypeList = DurationType::model()->getModelList();
?>
<div class="row payment_period num_<?php echo $i;?>">
    <?php
    echo $form->textField($period,"[$i]value",array('size'=>'3'));
    echo $form->textField($period,"[$i]before_duration",array('size'=>'3'));
    echo $form->dropDownList($period,"[$i]duration_type_id",$durationTypeList);
    if($i==0){
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addPaymentPeriod()',
            'style'=>'cursor:pointer;',
        ));
    } else {
        echo CHtml::image("/i/def/minus.png","",array(
            'onclick'=>'delPaymentPeriod(this)',
            'style'=>'cursor:pointer;',
        ));
    }
    echo $form->error($period,"[$i]value");
    echo $form->error($period,"[$i]before_duration");
    echo $form->error($period,"[$i]duration_type_id");
    ?>
</div>