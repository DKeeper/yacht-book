<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.01.14
 * @time 10:10
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
/* @var $model CcFleets */
/* @var $priceCurrYear PriceCurrentYear[] */
/* @var $priceNextYear PriceNextYear[] */
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
foreach($durationTypeList as $i => $element){
    if($element == Yii::t('view','Charter')){
        unset($durationTypeList[$i]);
    }
}
?>
<div class="row">
<?php
    echo CHtml::label(Yii::t("model","This year"),'',array('class'=>'add_price_curr_year'));
    foreach($priceCurrYear as $i=>$price){
        $this->renderPartial("_fleets_price_period",array(
            "i"=>$i,
            "form"=>$form,
            "model"=>$price,
        ));
    }
    echo CHtml::tag(
        "button",
        array(
            "class"=>"btn btn-default",
            'onclick'=>'addPriceCurrYear(this);return false;'
        ),
        "<span class='glyphicon glyphicon-plus'></span>"
    );
?>
</div>
<div class="row">
    <?php
    echo CHtml::label(Yii::t("model","Next year"),'',array('class'=>'add_price_next_year'));
    foreach($priceNextYear as $i=>$price){
        $this->renderPartial("_fleets_price_period",array(
            "i"=>$i,
            "form"=>$form,
            "model"=>$price,
        ));
    }
    echo CHtml::tag(
        "button",
        array(
            "class"=>"btn btn-default",
            'onclick'=>'addPriceNextYear(this);return false;'
        ),
        "<span class='glyphicon glyphicon-plus'></span>"
    );
    ?>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"deposit",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("deposit"),'title' => $profile->getAttributeLabel("deposit"))); ?>
        <?php echo $form->error($profile,'deposit'); ?>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"deposit_insurance_price",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'deposit_insurance_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("deposit_insurance_price"),'title' => $profile->getAttributeLabel("deposit_insurance_price"))); ?>
        <?php echo $form->error($profile,'deposit_insurance_price'); ?>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"deposit_insurance_deposit",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'deposit_insurance_deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("deposit_insurance_deposit"),'title' => $profile->getAttributeLabel("deposit_insurance_deposit"))); ?>
        <?php echo $form->error($profile,'deposit_insurance_deposit'); ?>
    </div>
</div>
<?php echo CHtml::label(Yii::t("model","Last minute"),""); ?>
<div class="row last_minute">
    <div class='col-md-3'>
        <div class="input-group">
            <?php echo $form->textField($profile,"last_minute_value",array('class'=>'form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
        <?php
        echo $form->error($profile,"last_minute_value");
        ?>
    </div>
    <div class='col-md-7'>
        <div class="btn-group" data-toggle="buttons" style="display: inline;">
            <?php
            $name = "CcProfile[last_minute_duration]";
            echo CHtml::label(CHtml::checkBox($name,-1==$profile->last_minute_duration?true:false,array('id'=>'TD')).Yii::t('view','TD'),'',array('title'=>Yii::t('view','To date'),'class'=>'btn btn-default last_minute_duration'.(-1==$profile->last_minute_duration?' active':'')));
            ?>
        </div>
        <div style="display: inline;">
            <?php
            if($profile->last_minute_duration!=-1){
                $style = "display:none;";
            } else {
                $style = "";
            }
            ?>
            <div class="col-md-6">
                <?php
                $this->widget('datepicker.EDatePicker', array(
                    'model' => $profile,
                    'attribute' => "last_minute_date_from",
                    'language' => Yii::app()->language,
                    'options' => array(
                        'dateFormat' => 'dd.mm.yy',
                        'minDate' => 'y',
                        'maxDate' => '+2y',
                        'yearRange' => 'c:c+2',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'onClose'=>'js: function( selectedDate ) {
                                $( "#CcProfile_last_minute_date_to" ).datepicker( "option", "minDate", selectedDate );
                            }'
                    ),
                    'htmlOptions' => array('class'=>'form-control','placeholder'=>Yii::t("model","Date from")),
                    'groupStyle'=>$style,
                ));
                ?>
            </div>
            <div>
                <?php
                $this->widget('datepicker.EDatePicker', array(
                    'model' => $profile,
                    'attribute' => "last_minute_date_to",
                    'language' => Yii::app()->language,
                    'options' => array(
                        'dateFormat' => 'dd.mm.yy',
                        'minDate' => 'y',
                        'maxDate' => '+2y',
                        'yearRange' => 'c:c+2',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showOn' => 'button',
                        'onClose'=>'js: function( selectedDate ) {
                                $( "#CcProfile_last_minute_date_from" ).datepicker( "option", "maxDate", selectedDate );
                            }'
                    ),
                    'htmlOptions' => array('class'=>'form-control','placeholder'=>Yii::t("model","Date to")),
                    'groupStyle'=>$style,
                ));
                ?>
            </div>
        </div>
        <div style="display: inline;">
            <div class="col-md-6">
                <?php
                $htmlOptions = array('class'=>'form-control before_duration_value','style'=>'width:auto;');
                if($profile->last_minute_duration==-1){
                    $htmlOptions['style'] .= "display:none;";
                }
                echo $form->textField($profile,"last_minute_duration",$htmlOptions); ?>
            </div>
        </div>
        <?php
        echo $form->error($profile,"last_minute_duration");
        ?>
    </div>
    <div class='col-md-2' style="margin-left: -20%;">
        <?php
        $htmlOptions = array('class'=>'form-control');
        if($profile->last_minute_duration==-1){
            $htmlOptions['style'] = "display:none;";
        }
        echo $form->dropDownList($profile,"last_minute_duration_type_id",$durationTypeList,$htmlOptions);
        echo $form->error($profile,"last_minute_duration_type_id");
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"last_cleaning_incl",array("class"=>"control-label","label"=>"&nbsp;")); ?>
        <div class="input-group">
            <span class="input-group-addon"><?php echo $form->checkBox($profile,'last_cleaning_incl'); ?></span>
            <?php echo CHtml::textField('checkbox_last_cleaning_incl',$profile->getAttributeLabel("last_cleaning_incl"),array('class'=>'form-control','disabled'=>true)); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"last_cleaning_obl",array("class"=>"control-label","label"=>"&nbsp;")); ?>
        <div class="input-group">
            <span class="input-group-addon"><?php echo $form->checkBox($profile,'last_cleaning_obl'); ?></span>
            <?php echo CHtml::textField('checkbox_last_cleaning_obl',$profile->getAttributeLabel("last_cleaning_obl"),array('class'=>'form-control','disabled'=>true)); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"last_cleaning_price",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'last_cleaning_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("last_cleaning_price"),'title' => $profile->getAttributeLabel("last_cleaning_price"))); ?>
        <?php echo $form->error($profile,'last_cleaning_price'); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail",array("class"=>"control-label","label"=>"&nbsp;")); ?>
        <div class="input-group">
            <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail'); ?></span>
            <?php echo CHtml::textField('checkbox_race_sail',$profile->getAttributeLabel("race_sail"),array('class'=>'form-control','disabled'=>true)); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail_material_id",array("class"=>"control-label")); ?>
        <?php
        echo CHtml::activeHiddenField($profile,'race_sail_material_id');
        $this->widget('autocombobox.JuiAutoComboBox', array(
            'model'=>SailMaterial::model(),   // модель
            'attribute'=>'name',  // атрибут модели
            'parentModel' => $profile,
            'parentAttribute' => 'race_sail_material_id',
            // "источник" данных для выборки
            'source' =>'js:function(request, response) {
                    $.getJSON("'.$this->createUrl('ajax/autocomplete').'", {
                    term: request.term.split(/,s*/).pop(),
                    modelClass: "SailMaterial",
                    parent_include: false,
                    create_include: false,
                    sql: false
                }, response);}',
            'htmlOptions'=>array(
                'id'=> get_class(SailMaterial::model())."name_2",
            )
        ));
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail_price_incl",array("class"=>"control-label","label"=>"&nbsp;")); ?>
        <div class="input-group">
            <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail_price_incl'); ?></span>
            <?php echo CHtml::textField('checkbox_race_sail_price_incl',$profile->getAttributeLabel("race_sail_price_incl"),array('class'=>'form-control','disabled'=>true)); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail_price_obl",array("class"=>"control-label","label"=>"&nbsp;")); ?>
        <div class="input-group">
            <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail_price_obl'); ?></span>
            <?php echo CHtml::textField('checkbox_race_sail_price_obl',$profile->getAttributeLabel("race_sail_price_obl"),array('class'=>'form-control','disabled'=>true)); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail_price",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'race_sail_price',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_sail_price"),'title' => $profile->getAttributeLabel("race_sail_price"))); ?>
        <?php echo $form->error($profile,'race_sail_price'); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail_deposit_obl",array("class"=>"control-label","label"=>"&nbsp;")); ?>
        <div class="input-group">
            <span class="input-group-addon"><?php echo $form->checkBox($profile,'race_sail_deposit_obl'); ?></span>
            <?php echo CHtml::textField('checkbox_race_sail_deposit_obl',$profile->getAttributeLabel("race_sail_deposit_obl"),array('class'=>'form-control','disabled'=>true)); ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_sail_deposit",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'race_sail_deposit',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_sail_deposit"),'title' => $profile->getAttributeLabel("race_sail_deposit"))); ?>
        <?php echo $form->error($profile,'race_sail_deposit'); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"race_preparation",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'race_preparation',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("race_preparation"),'title' => $profile->getAttributeLabel("race_preparation"))); ?>
        <?php echo $form->error($profile,'race_preparation'); ?>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"hull_cleaning",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'hull_cleaning',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("hull_cleaning"),'title' => $profile->getAttributeLabel("hull_cleaning"))); ?>
        <?php echo $form->error($profile,'hull_cleaning'); ?>
    </div>
    <div class="col-md-4">
        <?php echo $form->labelEx($profile,"crew_license",array("class"=>"control-label")); ?>
        <?php echo $form->textField($profile,'crew_license',array('class'=>'form-control','placeholder' => $profile->getAttributeLabel("crew_license"),'title' => $profile->getAttributeLabel("crew_license"))); ?>
        <?php echo $form->error($profile,'crew_license'); ?>
    </div>
</div>
<div class="row">
    <?php echo $form->labelEx($profile,'IRC_scan'); ?>
    <?php echo $form->textField($profile,'IRC_scan',array('class'=>'form-control','readonly'=>true)); ?>
    <?php
    $this->widget('fileuploader.EFineUploader',
        array(
            'config'=>array(
                'autoUpload'=>true,
                'request'=>array(
                    'endpoint'=>'/ajax/upload',// OR $this->createUrl('files/upload'),
                    'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                ),
                'retry'=>array(
                    'enableAuto'=>false,
                    'preventRetryResponseProperty'=>true
                ),
                'chunking'=>array(
                    'enable'=>true,
                    'partSize'=>100
                ),//bytes
                'callbacks'=>array(
                    'onComplete'=>"js:function(id, name, response){
                            if(response.success){
                                $('#SyProfile_IRC_scan').val(response.link);
                            }
                        }",
                    'onError'=>"js:function(id, name, errorReason){
                            $('#SyProfile_IRC_scan').val();
                            alert(errorReason);
                        }",
                ),
                'validation'=>array(
                    'allowedExtensions'=>array('jpg','jpeg','png','gif','pdf'),
                    'sizeLimit'=>10*1024*1024,//maximum file size in bytes
                    'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'UploadSyProfileIRCScan',
                'style'=>'margin-top:5px;'
            ),
        )
    );
    ?>
    <?php echo $form->error($profile,'IRC_scan'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($profile,'ORC_scan'); ?>
    <?php echo $form->textField($profile,'ORC_scan',array('class'=>'form-control','readonly'=>true)); ?>
    <?php
    $this->widget('fileuploader.EFineUploader',
        array(
            'config'=>array(
                'autoUpload'=>true,
                'request'=>array(
                    'endpoint'=>'/ajax/upload',// OR $this->createUrl('files/upload'),
                    'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                ),
                'retry'=>array(
                    'enableAuto'=>false,
                    'preventRetryResponseProperty'=>true
                ),
                'chunking'=>array(
                    'enable'=>true,
                    'partSize'=>100
                ),//bytes
                'callbacks'=>array(
                    'onComplete'=>"js:function(id, name, response){
                            if(response.success){
                                $('#SyProfile_ORC_scan').val(response.link);
                            }
                        }",
                    'onError'=>"js:function(id, name, errorReason){
                            $('#SyProfile_ORC_scan').val();
                            alert(errorReason);
                        }",
                ),
                'validation'=>array(
                    'allowedExtensions'=>array('jpg','jpeg','png','gif','pdf'),
                    'sizeLimit'=>10*1024*1024,//maximum file size in bytes
                    'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'UploadSyProfileORCScan',
                'style'=>'margin-top:5px;'
            ),
        )
    );
    ?>
    <?php echo $form->error($profile,'ORC_scan'); ?>
</div>
<div class="row">
    <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Prev"); ?></button></div>
</div>
<div style="display:none;" id="fleet_map_wrapper"><div id=fleet_map></div></div>
<script>
    confirmMessage = '<?php echo Yii::t("view","You are sure you want to delete?"); ?>';
    $(function(){
        var check = <?php echo -1==$profile->last_minute_duration?-1:isset($profile->last_minute_duration)?$profile->last_minute_duration:0; ?>;
        $(".last_minute_duration").tooltip();
        $(".last_minute_duration").on("click",function(event){
            var $_ = $(this).parent().parent();
            if(check!=-1){
                check = -1;
                $_.find(".before_duration_value").fadeOut(function(){
                    $(this).val(-1);
                    $_.find(".input-group").fadeIn();
                });
                $_.parents("div.last_minute").find("select").val(1).fadeOut();
            } else {
                check = 0;
                $_.find(".input-group").fadeOut(function(){
                    $_.find(".before_duration_value").val('').fadeIn();
                });
                $_.parents("div.last_minute").find("select").fadeIn();
            }
        });
    });
    function addPriceCurrYear(o){
        $('#cc-fleets-form').data('settings')['submitting'] = true;
        $.fn.yiiactiveform.validate(
                '#cc-fleets-form',
                function(messages){
                    var hasError = false;
                    $.each($('#cc-fleets-form').data('settings')['attributes'], function () {
                        hasError = $.fn.yiiactiveform.updateInput(this, messages, $('#cc-fleets-form')) || hasError;
                    });
                    $.fn.yiiactiveform.updateSummary($('#cc-fleets-form'), messages);
                    if(!hasError){
                        var n = $(".price_curr_year").last().attr("class");
                        if(typeof n === "undefined"){
                            n = 0;
                        } else {
                            n = n.split(" ");
                            n = n[2].split("_");
                            n = +n[1]+1;
                        }
                        $(o).after("<img class=aL src=/i/indicator.gif />");
                        $.ajax({
                            url:'/ajax/getmodelbynum',
                            data:{
                                i:n,
                                model:"PriceCurrentYear",
                                view:"/fleets/_fleets_price_period"
                            },
                            success:function(answer){
                                var o =  $(".price_curr_year");
                                if(o.length != 0){
                                    o.last().after(answer);
                                } else {
                                    $(".add_price_curr_year").after(answer);
                                }
                                o = $(".price_curr_year");
                                o.parent().find(".aL").remove();
                                o.find("div:hidden").addClass("errorMessage");
                                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
                                // Установка мин. даты
                                if(n!=0){
                                    var minDate = $($(".price_curr_year").last().prev().find(".hasDatepicker")[1]).datepicker("getDate");
                                    var nextDay = minDate.getTime()+1000*60*60*24;
                                    minDate.setTime(nextDay);
                                    var dateObj = $($(".price_curr_year").last().find(".hasDatepicker")[0]);
                                    dateObj.datepicker("option","minDate",minDate);
                                    dateObj.datepicker("setDate",minDate);
                                    dateObj.trigger("change");
                                }
                            },
                            type:'POST',
                            dataType:'html',
                            async:true
                        });
                    }
                }
        );
        $('#cc-fleets-form').data('settings')['submitting'] = false;
    }
    function addPriceNextYear(o){
        $('#cc-fleets-form').data('settings')['submitting'] = true;
        $.fn.yiiactiveform.validate(
                '#cc-fleets-form',
                function(messages){
                    var hasError = false;
                    $.each($('#cc-fleets-form').data('settings')['attributes'], function () {
                        hasError = $.fn.yiiactiveform.updateInput(this, messages, $('#cc-fleets-form')) || hasError;
                    });
                    $.fn.yiiactiveform.updateSummary($('#cc-fleets-form'), messages);
                    if(!hasError){
                        var n = $(".price_next_year").last().attr("class");
                        if(typeof n === "undefined"){
                            n = 0;
                        } else {
                            n = n.split(" ");
                            n = n[2].split("_");
                            n = +n[1]+1;
                        }
                        $(o).after("<img class=aL src=/i/indicator.gif />");
                        $.ajax({
                            url:'/ajax/getmodelbynum',
                            data:{
                                i:n,
                                model:"PriceNextYear",
                                view:"/fleets/_fleets_price_period"
                            },
                            success:function(answer){
                                var o =  $(".price_next_year");
                                if(o.length != 0){
                                    o.last().after(answer);
                                } else {
                                    $(".add_price_next_year").after(answer);
                                }
                                o = $(".price_next_year");
                                o.parent().find(".aL").remove();
                                o.find("div:hidden").addClass("errorMessage");
                                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
                                // Установка мин. даты
                                if(n!=0){
                                    var minDate = $($(".price_next_year").last().prev().find(".hasDatepicker")[1]).datepicker("getDate");
                                    var nextDay = minDate.getTime()+1000*60*60*24;
                                    minDate.setTime(nextDay);
                                    var dateObj = $($(".price_next_year").last().find(".hasDatepicker")[0]);
                                    dateObj.datepicker("option","minDate",minDate);
                                    dateObj.datepicker("setDate",minDate);
                                }
                            },
                            type:'POST',
                            dataType:'html',
                            async:true
                        });
                    }
                }
        );
        $('#cc-fleets-form').data('settings')['submitting'] = false;
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=true&language=<?php echo Yii::app()->language; ?>"></script>