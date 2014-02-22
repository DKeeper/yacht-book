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
    <div class="col-md-4">
        <?php
        echo $form->hiddenField($model,"[$i]latitude");
        echo $form->hiddenField($model,"[$i]longitude");
        echo $form->hiddenField($model,"[$i]duration_type_id",array('value'=>1));
        ?>
        <div class="row">
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
        <div class="row">
            <div class="input-group">
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => "[{$i}]date_to",
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
                        'placeholder'=>$model->getAttributeLabel('date_to'),
                        'title'=>$model->getAttributeLabel('date_to'),
                    ),
                ));
                ?>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <?php echo $form->error($model,"[{$i}]date_to"); ?>
        </div>
        <div class="row">
            <?php echo $form->textField($model,"[$i]price",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("price"),'title' => $model->getAttributeLabel("price"))); ?>
            <?php echo $form->error($model,"[{$i}]price"); ?>
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
    <div class="col-md-8">
        <div id="map_canvas_<?php echo get_class($model)."_".$i; ?>" style="width:450px; height:200px; display: none;"></div>
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