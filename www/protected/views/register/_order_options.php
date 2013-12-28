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
$orderOptionList = OrderOptions::model()->getModelList();
?>
<div class="row order_options num_<?php echo $i;?>">
    <?php echo $form->labelEx($model,"[$i]order_option_id"); ?>
    <?php echo $form->dropDownList($model,"[$i]order_option_id",$orderOptionList,array("prompt"=>Yii::t("view","Select options"))); ?>
    <?php echo $form->error($model,"[$i]order_option_id"); ?>
    <?php echo $form->labelEx($model,"[$i]obligatory"); ?>
    <?php echo $form->checkBox($model,"[$i]obligatory"); ?>
    <?php echo $form->error($model,"[$i]obligatory"); ?>
    <?php echo $form->labelEx($model,"[$i]included"); ?>
    <?php echo $form->checkBox($model,"[$i]included"); ?>
    <?php echo $form->error($model,"[$i]included"); ?>
    <?php echo $form->labelEx($model,"[$i]price"); ?>
    <?php echo $form->textField($model,"[$i]price"); ?>
    <?php echo $form->error($model,"[$i]price"); ?>
    <?php
    echo CHtml::image("/i/def/minus.png","",array(
        'onclick'=>'delRow(this)',
        'style'=>'cursor:pointer;',
    ));
    ?>
</div>