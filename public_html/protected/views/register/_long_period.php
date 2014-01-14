<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 25.12.13
 * @time 17:12
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcLongPeriod */
/* @var $form CActiveForm */
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
?>
<div class="row long_period num_<?php echo $i;?>">
    <?php
    echo $form->textField($model,"[$i]value",array('size'=>'3'));
    echo $form->textField($model,"[$i]before_duration",array('size'=>'3'));
    echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList);
    echo CHtml::image("/i/def/minus.png","",array(
        'onclick'=>'delRow(this)',
        'style'=>'cursor:pointer;',
    ));
    echo $form->error($model,"[$i]value");
    echo $form->error($model,"[$i]before_duration");
    echo $form->error($model,"[$i]duration_type_id");
    ?>
</div>