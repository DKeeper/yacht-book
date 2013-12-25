<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 25.12.13
 * @time 15:08
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $period CcCancelPeriod */
/* @var $form CActiveForm */
$durationTypeList = DurationType::model()->getModelList();
?>
<div class="row cancel_period num_<?php echo $i;?>">
    <?php
    echo $form->textField($period,"[$i]value",array('size'=>'3'));
    echo $form->textField($period,"[$i]before_duration",array('size'=>'3'));
    echo $form->dropDownList($period,"[$i]duration_type_id",$durationTypeList);
    if($i==0){
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addCancelPeriod()',
            'style'=>'cursor:pointer;',
        ));
    } else {
        echo CHtml::image("/i/def/minus.png","",array(
            'onclick'=>'delPeriod(this)',
            'style'=>'cursor:pointer;',
        ));
    }
    echo $form->error($period,"[$i]value");
    echo $form->error($period,"[$i]before_duration");
    echo $form->error($period,"[$i]duration_type_id");
    ?>
</div>