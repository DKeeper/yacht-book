<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 27.12.13
 * @time 15:46
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcTransitLog */
/* @var $form CActiveForm */
$countryList = Strana::model()->getModelList('nazvanie_1',' - ',array('order'=>'nazvanie_1'));
?>
<div class="row transit_log num_<?php echo $i;?>">
    <div class="row">
    <div class="col-md-12">
    <?php
    echo $form->labelEx($model,"[$i]country_id");
    echo $form->dropDownList($model,"[$i]country_id",$countryList,array("class"=>"form-control","prompt"=>Yii::t("view","Select country")));
    echo $form->error($model,"[$i]country_id");
    ?>
    </div>
    </div>
    <div class="row">
        <div class="col-md-3">
    <?php
    echo $form->textField($model,"[$i]price",array("class"=>"form-control","placeholder"=>$model->getAttributeLabel("price")));
    echo $form->error($model,"[$i]price");
    ?>
        </div>
        <div class="col-md-3">
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
        <div class="col-md-3">
            <div class="checkbox">
    <?php
    echo CHtml::openTag("label");
    echo $form->checkBox($model,"[$i]included",array('uncheckValue'=>null));
    echo $model->getAttributeLabel("included");
    echo CHtml::closeTag("label");
    echo $form->error($model,"[$i]included");
    ?>
            </div>
        </div>
        <div class="col-md-3">
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