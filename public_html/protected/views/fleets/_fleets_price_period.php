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
foreach($durationTypeList as $i => $element){
    if($element == Yii::t('view','Charter')){
        unset($durationTypeList[$i]);
    }
}
$class = get_class($model)."_".$i;
$idPrefix = $class;
if($model instanceof PriceCurrentYear){
    $class .= " price_curr_year";
    $options = array(
        'minDate' => '01.01.'.date('Y',time()),
        'maxDate' => '31.12.'.date('Y',time()),
        'showOn' => 'button',
    );
} else {
    $class .= " price_next_year";
    $options = array(
        'minDate' => '01.01.'.(intval(date('Y',time()))+1),
        'maxDate' => '31.12.'.(intval(date('Y',time()))+1),
        'showOn' => 'button',
    );
}
if($model->isNewRecord){
    list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess($this->loadUser());
    $model->latitude = $profileCC->latitude;
    $model->longitude = $profileCC->longitude;
}
?>
<div class="row num_<?php echo $i." ".$class; ?>">
    <div class="col-md-3">
        <?php
        echo $form->hiddenField($model,"[$i]latitude");
        echo $form->hiddenField($model,"[$i]longitude");
        echo $form->hiddenField($model,"[$i]duration_type_id",array('value'=>1));
        $this->widget('datepicker.EDatePicker', array(
            'model' => $model,
            'attribute' => "[{$i}]date_from",
            'language' => Yii::app()->language,
            'options' => array_merge(
                $options,
                array(
                    'dateFormat' => 'dd.mm.yy',
                    'changeMonth' => true,
                    'changeYear' => false,
                )
            ),
            'htmlOptions' => array(
                'class'=>'form-control',
                'placeholder'=>$model->getAttributeLabel('date_from'),
                'title'=>$model->getAttributeLabel('date_from'),
            ),
        ));
        echo $form->error($model,"[{$i}]date_from");
        ?>
    </div>
    <div class="col-md-3">
        <?php
        $this->widget('datepicker.EDatePicker', array(
            'model' => $model,
            'attribute' => "[{$i}]date_to",
            'language' => Yii::app()->language,
            'options' => array_merge(
                $options,
                array(
                    'dateFormat' => 'dd.mm.yy',
                    'changeMonth' => true,
                    'changeYear' => false,
                )
            ),
            'htmlOptions' => array(
                'class'=>'form-control',
                'placeholder'=>$model->getAttributeLabel('date_to'),
                'title'=>$model->getAttributeLabel('date_to'),
            ),
        ));
        ?>
        <?php echo $form->error($model,"[{$i}]date_to"); ?>
    </div>
    <div class="col-md-3">
        <?php echo $form->textField($model,"[$i]price",array('class'=>'form-control','placeholder' => $model->getAttributeLabel("price"),'title' => $model->getAttributeLabel("price"))); ?>
        <?php echo $form->error($model,"[{$i}]price"); ?>
    </div>
    <div class="col-md-3">
        <?php
        $label = CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default",
                "type" => "button",
            ),
            "<span class='glyphicon glyphicon-globe'></span>"
        );
        $this->widget('fancyapps.EFancyApps', array(
            'mode'=>'inline',
            'config'=>array(
                'maxWidth'	=> 300,
                'maxHeight'	=> 300,
                'width'		=> 300,
                'height'    => 300,
                'afterShow'=>"function(){
                    var id = '".get_class($model)."_".$i."';
                    initialize({id:id},'fleet_map',{},false,id);
                }",
            ),
            'options' => array(
                'url' => '#fleet_map_wrapper',
                'label'=> $label,
            ),
            'htmlOptions'=>array(
                'id' => get_class($model)."_".$i,
                'class'=> "show_fleet_map",
                "data-type" => "viewMap",
            )
        ));
        ?>
        <?php
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default",
                "type" => "button",
                "data-type" => "delRows",
                "onclick"=>"delRowMap(this,true);return false;",
            ),
            "<span class='glyphicon glyphicon-minus'></span>"
        );
        ?>
    </div>
</div>
<?php
if(Yii::app()->request->isAjaxRequest){
?>
<script>
    $(function(){
    <?php
    foreach(Yii::app()->clientScript->scripts as $pos){
        foreach($pos as $script){
            echo $script;
            }
        }
    ?>
    });
</script>
<?php
}
?>