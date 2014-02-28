<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 25.12.13
 * @time 21:06
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $i integer */
/* @var $model CcEarlyPeriod */
/* @var $form CActiveForm */
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
?>
<div class="row early_period num_<?php echo $i;?>">
    <?php
    echo "<div class='col-md-3'>";
    ?>
    <div class="input-group">
        <?php echo $form->textField($model,"[$i]value",array('class'=>'form-control')); ?>
        <span class="input-group-addon">%</span>
    </div>
    <?php
    echo $form->error($model,"[$i]value",array("class"=>"eraly_em"));
    ?>
    </div><div class='col-md-4'>
    <div class="btn-group" data-toggle="buttons" style="display: inline;">
        <?php
        $name = "CcEarlyPeriod[$i][before_duration]";
        echo CHtml::label(CHtml::checkBox($name,-1==$model->before_duration?true:false,array('id'=>'TD')).Yii::t('view','TD'),'',array('title'=>Yii::t('view','To date'),'class'=>'btn btn-default early_before_duration'.(-1==$model->before_duration?' active':'')));
        ?>
    </div>
    <div style="display: inline;">
        <?php
        if($model->before_duration!=-1){
            $style = "display:none;";
        } else {
            $style = "";
        }
        ?>
    <?php
    $htmlOptions = array('class'=>'form-control');
    $this->widget('datepicker.EDatePicker', array(
        'model' => $model,
        'attribute' => "[$i]date_value",
        'language' => Yii::app()->language,
        'options' => array(
            'dateFormat' => 'dd.mm.yy',
            'minDate' => 'y',
            'maxDate' => '+2y',
            'yearRange' => 'c:c+2',
            'changeMonth' => true,
            'changeYear' => true,
        ),
        'htmlOptions' => $htmlOptions,
        'groupStyle'=>$style,
    ));
    ?>
    </div>
    <div style="display: inline;">
      <?php
        $htmlOptions = array('size'=>'3','class'=>'form-control before_duration_value','style'=>'width:auto;');
        if($model->before_duration==-1){
            $htmlOptions['style'] .= "display:none;";
        }
        echo $form->textField($model,"[$i]before_duration",$htmlOptions); ?>
    </div>
    <?php
    echo $form->error($model,"[$i]before_duration",array("class"=>"eraly_em"));
    echo "</div><div class='col-md-2'>";
    $htmlOptions = array('class'=>'form-control');
    if($model->before_duration==-1){
        $htmlOptions['style'] = "display:none;";
    }
    echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList,$htmlOptions);
    echo $form->error($model,"[$i]duration_type_id",array("class"=>"eraly_em"));
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
<script>
    $(function(){
        checker[<?php echo $i; ?>] = <?php echo -1==$model->before_duration?-1:isset($model->before_duration)?$model->before_duration:0; ?>;
        $(".early_before_duration").tooltip();
        $("div.num_<?php echo $i; ?>").find(".early_before_duration").on("click",function(event){
            var $_ = $(this).parent().parent();
            var id = $(this).parents("div.row").attr("class").split(" ");
            id = id[2].split("_");
            id = +id[1];
            if(checker[id]!=-1){
                checker[id] = -1;
                $_.find(".before_duration_value").fadeOut(function(){
                    $(this).val(-1);
                    $_.find(".input-group").fadeIn();
                });
                $_.parents("div.early_period").find("select").val(1).fadeOut();
            } else {
                checker[id] = 0;
                $_.find(".input-group").fadeOut(function(){
                    $_.find(".before_duration_value").val('').fadeIn();
                });
                $_.parents("div.early_period").find("select").fadeIn();
            }
        });
        <?php
        if(Yii::app()->request->isAjaxRequest){
            foreach(Yii::app()->clientScript->scripts as $positions){
                foreach($positions as $script){
                    echo $script;
                }
            }
        }
        ?>
    });
</script>