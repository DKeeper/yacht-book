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
    <?php echo $form->labelEx($model,"[$i]order_option_id"); ?>
    <?php
    echo $form->dropDownList(
        $model,
        "[$i]order_option_id",
        $orderOptionList,
        array(
            "prompt"=>Yii::t("view","Select options"),
            "onchange"=>"createOptions(this)",
        )
    );
//    $this->widget('autocombobox.JuiAutoComboBox', array(
//        'model'=>YachtShipyard::model(),   // модель
//        'attribute'=>'name',  // атрибут модели
//        // "источник" данных для выборки
//        'source' =>'js:function(request, response) {
//                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
//                    term: request.term.split(/,s*/).pop(),
//                    modelClass: "OrderOptions",
//                    sql: false
//                }, response);
//            }',
//        // параметры, подробнее можно посмотреть на сайте
//        // http://jqueryui.com/demos/autocomplete/
//        'options'=>array(
//            'minLength'=>0,
//            'delay'=>0,
//            'showAnim'=>'fold',
//            'click'=>'js: function(event, ui) {
//                    $(this).val("");
//                    return false;
//                }',
//            'select' =>'js: function(event, ui) {
//                    if(!ui.item.id){
//                        createAddForm("#c","order_options");
//                        $(".custom_create").click();
//                    } else {
//                        this.value = ui.item.value;
//                        // записываем полученный id в скрытое поле
//                        $("#SyProfile_shipyard_id").val(ui.item.id);
//                    }
//                    return false;
//                }',
//
//        ),
//        'htmlOptions' => array(
//            'maxlength'=>50,
//        ),
//    ));
    ?>
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
    <?php echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList); ?>
    <?php echo $form->error($model,"[$i]duration_type_id"); ?>
    <?php
    echo CHtml::image("/i/def/minus.png","",array(
        'onclick'=>'delRow(this)',
        'style'=>'cursor:pointer;',
    ));
    ?>
</div>
<?php
//if(isset($ajax) && $ajax){
//    $scripts = Yii::app()->clientScript->scripts[4];
//    foreach($scripts as $script){
//        echo "<script>".$script."</script>";
//    }
//}
?>