<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 10.02.14
 * @time 17:53
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $form CActiveForm */
/* @var $model PriceCurrentYear|PriceNextYear */
/* @var $i integer */

$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
$class = get_class($model)."_".$i;
if($model instanceof PriceCurrentYear){
    $class .= " price_curr_year";
    $options = array(
        'minDate' => 'y',
        'maxDate' => '+1y',
        'yearRange' => 'c:c+1',
    );
} else {
    $class .= " price_next_year";
    $options = array(
        'minDate' => 'y',
        'maxDate' => 'y',
        'yearRange' => 'c:c',
    );
}
?>
<div class="row num_<?php echo $i." ".$class; ?>">
    <div class="col-md-8">
        <?php
        echo $form->hiddenField($model,"[$i]latitude");
        echo $form->hiddenField($model,"[$i]longitude");
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => "[{$i}]date_from",
                        'language' => Yii::app()->language,
                        'options' => array_merge(
                            $options,
                            array(
                                'dateFormat' => 'yy-mm-dd',
                                'changeMonth' => true,
                                'changeYear' => true,
                            )
                        ),
                        'htmlOptions' => array(
                            'class'=>'form-control',
                            'placeholder'=>$model->getAttributeLabel('date_from'),
                            'title'=>$model->getAttributeLabel('date_from'),
                        ),
                    ));
                    ?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <?php echo $form->error($model,"[{$i}]date_from"); ?>
            </div>
            <div class="col-md-3">
                <?php echo $form->textField($model,"[$i]duration",array('size'=>'3','class'=>'form-control','placeholder' => $model->getAttributeLabel("duration"),'title' => $model->getAttributeLabel("duration"))); ?>
                <?php echo $form->error($model,"[$i]duration"); ?>
            </div>
            <div class="col-md-3">
                <?php echo $form->dropDownList($model,"[$i]duration_type_id",$durationTypeList,array('class'=>'form-control')); ?>
                <?php echo $form->error($model,"[$i]duration_type_id"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->textField($model,"[$i]price",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("price"),'title' => $model->getAttributeLabel("price"))); ?>
                <?php echo $form->error($model,"[{$i}]price"); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->textField($model,"[$i]deposit",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("deposit"),'title' => $model->getAttributeLabel("deposit"))); ?>
                <?php echo $form->error($model,"[$i]deposit"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->textField($model,"[$i]deposit_insurance_price",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("deposit_insurance_price"),'title' => $model->getAttributeLabel("deposit_insurance_price"))); ?>
                <?php echo $form->error($model,"[{$i}]deposit_insurance_price"); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->textField($model,"[$i]deposit_insurance_deposit",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("deposit_insurance_deposit"),'title' => $model->getAttributeLabel("deposit_insurance_deposit"))); ?>
                <?php echo $form->error($model,"[$i]deposit_insurance_deposit"); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <?php echo $form->textField($model,"[$i]last_minute",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("last_minute"),'title' => $model->getAttributeLabel("last_minute"))); ?>
                    <span class="input-group-addon">%</span>
                </div>
            </div>
            <div class="col-md-6">
                <?php echo $form->textField($model,"[$i]week_before",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("week_before"),'title' => $model->getAttributeLabel("week_before"))); ?>
                <?php echo $form->error($model,"[$i]week_before"); ?>
            </div>
        </div>
        <?php
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default",
                "type" => "button",
                "data-type" => "delRows",
                "onclick"=>"delRowMap(this);return false;",
            ),
            "<span class='glyphicon glyphicon-minus'></span>"
        );
        ?>
    </div>
    <div class="col-md-4">
        <div id="map_canvas_<?php echo get_class($model)."_".$i; ?>" style="width:255px; height:200px; display: none;"></div>
    </div>
</div>
<script>
    <?php
    if(Yii::app()->request->isAjaxRequest){
        foreach(Yii::app()->clientScript->scripts as $pos){
            foreach($pos as $script){
                echo $script;
            }
        }
        ?>
    $(".fleets_form input").tooltip();
    initialize({id:'<?php echo get_class($model)."_".$i; ?>'},'map_canvas_<?php echo get_class($model)."_".$i; ?>',{},false,"<?php echo get_class($model)."_".$i; ?>");
        <?php
    } else {
        ?>
    $(function(){
        initialize({id:'<?php echo get_class($model)."_".$i; ?>'},'map_canvas_<?php echo get_class($model)."_".$i; ?>',{},false,"<?php echo get_class($model)."_".$i; ?>");
    });
        <?php
    }
    ?>
</script>