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
    <?php
    echo $form->labelEx($model,"[$i]country_id");
    echo $form->dropDownList($model,"[$i]country_id",$countryList,array("prompt"=>Yii::t("view","Select country")));
    echo $form->error($model,"[$i]country_id");
    echo $form->labelEx($model,"[$i]obligatory");
    echo $form->checkBox($model,"[$i]obligatory");
    echo $form->error($model,"[$i]obligatory");
    echo $form->labelEx($model,"[$i]included");
    echo $form->checkBox($model,"[$i]included");
    echo $form->error($model,"[$i]included");
    echo $form->labelEx($model,"[$i]price");
    echo $form->textField($model,"[$i]price");
    echo $form->error($model,"[$i]price");
    echo CHtml::image("/i/def/minus.png","",array(
        'onclick'=>'delRow(this)',
        'style'=>'cursor:pointer;',
    ));
    ?>
</div>