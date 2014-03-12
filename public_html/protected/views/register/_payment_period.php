<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.12.13
 * @time 17:55
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcPaymentsPeriod */
/* @var $form CActiveForm */
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
foreach($durationTypeList as $i => $element){
    if($element == Yii::t('view','Charter')){
        unset($durationTypeList[$i]);
    }
}
?>
<div class="row payment_period num_<?php echo $i;?>">
    <?php
    echo "<div class='col-md-3'>";
    ?>
    <div class="input-group">
    <?php echo $form->textField($model,"[$i]value",array('class'=>'form-control')); ?>
    <span class="input-group-addon">%</span>
    </div>
    <?php
    echo $form->error($model,"[$i]value");
    echo "</div><div class='col-md-4'>";
    ?>
    <div class="input-group">
        <span class="input-group-addon" style="padding: 0; width: auto;">
            <div class="btn-group" data-toggle="buttons">
                <?php
                $name = "CcPaymentsPeriod[$i][before_duration]";
                echo CHtml::label(CHtml::radioButton($name,-2==$model->before_duration?true:false,array('id'=>'AC','value'=>-2)).Yii::t('view','AC'),'',array('title'=>Yii::t('view','After confirmation'),'class'=>'btn btn-default payment_before_duration'.(-2==$model->before_duration?' active':'')));
                echo CHtml::label(CHtml::radioButton($name,-1==$model->before_duration?true:false,array('id'=>'OS','value'=>-1)).Yii::t('view','OS'),'',array('title'=>Yii::t('view','On spot'),'class'=>'btn btn-default payment_before_duration'.(-1==$model->before_duration?' active':'')));
                echo CHtml::label(CHtml::radioButton($name,0<$model->before_duration?true:false,array('id'=>'BC','value'=>0)).Yii::t('view','BC'),'',array('title'=>Yii::t('view','Before charter'),'class'=>'btn btn-default payment_before_duration'.(0<$model->before_duration?' active':'')));
                ?>
            </div>
        </span>
        <?php
            $htmlOptions = array(
                'disabled'=>0>$model->before_duration?true:false,
                'size'=>'3',
                'class'=>'form-control payment_period_value'
            );
            if($model->before_duration<=0){
                $htmlOptions['value']="";
            }
            echo $form->textField($model,"[$i]before_duration",$htmlOptions);
        ?>
    </div>
    <?php
    echo $form->error($model,"[$i]before_duration");
    if($model->before_duration<0){
        $style = "display:none;";
    } else {
        $style = "";
    }
    echo "</div><div class='col-md-3'>";
    echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList,array('class'=>'form-control','style'=>$style));
    echo $form->error($model,"[$i]duration_type_id");
    echo "</div><div class='col-md-2'>";
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
<script>
    $(function(){
        $(".payment_before_duration").tooltip();
        $(".payment_before_duration").on("click",function(){
            if(+$(this).find("input").val()<0){
                $(this).parents("div.input-group").find(".payment_period_value").prop("disabled",true).val("");
                $(this).parents("div.payment_period").find("select").val(1).fadeOut();
            } else {
                $(this).parents("div.input-group").find(".payment_period_value").prop("disabled",false);
                $(this).parents("div.payment_period").find("select").fadeIn();
            }
        });
    });
</script>