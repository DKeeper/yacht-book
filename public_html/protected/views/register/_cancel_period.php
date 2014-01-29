<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 25.12.13
 * @time 15:08
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcCancelPeriod */
/* @var $form CActiveForm */
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
?>
<div class="row cancel_period num_<?php echo $i;?>">
    <?php
    echo "<div class='col-md-3'>";
    ?>
    <div class="input-group">
        <?php echo $form->textField($model,"[$i]value",array('class'=>'form-control')); ?>
        <span class="input-group-addon">%</span>
    </div>
    <?php
    echo $form->error($model,"[$i]value");
    echo "</div><div class='col-md-3'>";
    echo $form->textField($model,"[$i]before_duration",array('size'=>'3','class'=>'form-control'));
    echo $form->error($model,"[$i]before_duration");
    echo "</div><div class='col-md-3'>";
    echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList,array('class'=>'form-control'));
    echo $form->error($model,"[$i]duration_type_id");
    echo "</div><div class='col-md-3'>";
    echo CHtml::tag(
        "button",
        array(
            "class"=>"btn btn-default",
            "type" => "button",
            "data-type" => "delRows",
            "onclick"=>"delRow(this);return false;",
        ),
        "<span class='glyphicon glyphicon-minus'></span>"
    );
    echo "</div>";
    ?>
</div>