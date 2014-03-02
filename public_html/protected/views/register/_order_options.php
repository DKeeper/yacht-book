<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 28.12.13
 * @time 13:21
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcOrderOptions */
/* @var $form CActiveForm */
/* @var $ajax boolean */
$orderOptionList = array(Yii::t("view","Create"));
$orderOptionList += OrderOptions::model()->getModelList();
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
?>
<div class="row order_options num_<?php echo $i;?>">
    <div class="row">
    <div class="col-md-4">
    <?php
    echo $form->dropDownList(
        $model,
        "[$i]order_option_id",
        $orderOptionList,
        array(
            "prompt"=>Yii::t("view","Select options"),
            "onchange"=>"createOptions(this)",
            "class"=>"form-control order_options_select",
        )
    );
    ?>
    <?php echo $form->error($model,"[$i]order_option_id"); ?>
    </div>
    <div class="col-md-4">
    <?php echo $form->textField($model,"[$i]price",array("class"=>"form-control","placeholder"=>$model->getAttributeLabel("price"))); ?>
    <?php echo $form->error($model,"[$i]price"); ?>
    </div>
    <div class="col-md-4">
    <?php echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList,array("class"=>"form-control")); ?>
    <?php echo $form->error($model,"[$i]duration_type_id"); ?>
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
        <div class="checkbox">
            <?php
            echo CHtml::openTag("label");
            echo $form->checkBox($model,"[$i]obligatory",array('uncheckValue'=>null));
            echo $model->getAttributeLabel("obligatory");
            echo CHtml::closeTag("label");
            echo $form->error($model,"[$i]obligatory");
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="checkbox">
            <?php
            echo CHtml::openTag("label");
            echo $form->checkBox($model,"[$i]included");
            echo $model->getAttributeLabel("included");
            echo CHtml::closeTag("label");
            echo $form->error($model,"[$i]included");
            ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default",
                'onclick'=>'delRow($(this).parent());return false;'
            ),
            Yii::t("view","Delete")."
            <span class='glyphicon glyphicon-minus'></span>
            "
        );
        ?>
    </div>
    </div>
</div>
<script>
    $(function(){
        $("#CcOrderOptions_<?php echo $i; ?>_included").on("click",function(event){
            if($(this).is(":checked")){
                $("#CcOrderOptions_<?php echo $i; ?>_price").val(0);
            }
        });
    });
</script>