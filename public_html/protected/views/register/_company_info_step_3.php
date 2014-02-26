<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.12.13
 * @time 16:10
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileCC CCProfile */
/* @var $form CActiveForm */
/* @var $paymentsPeriods CcPaymentsPeriod[] */
/* @var $cancelPeriods CcCancelPeriod[] */
/* @var $longPeriods CcLongPeriod[] */
/* @var $earlyPeriods CcEarlyPeriod[] */
$durationTypeList = DurationType::model()->getModelList(array(),'',array('order'=>'id'));
?>
    <div class="row">
        <div class="col-md-6">
        <?php echo $form->labelEx($profileCC,'checkin_day'); ?>
            <div class="btn-group" data-toggle="buttons">
                <?php
                $name = "CcProfile[checkin_day]";
                echo CHtml::label(CHtml::radioButton($name,!isset($profileCC->checkin_day),array('value'=>'')),'',array('class'=>'btn btn-default checkin_day_radio'.(!isset($profileCC->checkin_day)?' active':'')));
                for($i=0;$i<7;$i++){
                    echo CHtml::label(CHtml::radioButton($name,($i==$profileCC->checkin_day&&isset($profileCC->checkin_day))?true:false,array('value'=>$i)),'',array('class'=>'btn btn-default checkin_day_radio'.(($i==$profileCC->checkin_day&&isset($profileCC->checkin_day))?' active':'')));
                }
                ?>
            </div>
        <?php echo $form->error($profileCC,'checkin_day'); ?>
        </div><div class="col-md-6">
        <?php echo $form->labelEx($profileCC,'checkin_hour'); ?>
        <?php
        $this->widget('timepicker.EDateTimePicker', array(
            'model'=>$profileCC,
            'attribute'=>'checkin_hour',
            'config'=>array(
                'timeFormat' => 'H:i',
                'step' => 60,
                'minTime' => '8:00',
                'maxTime' => '20:00',
            ),
            'htmlOptions'=>array(
                'class'=>'form-control'
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'checkin_hour'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
        <?php echo $form->labelEx($profileCC,'checkout_day'); ?>
            <div class="btn-group" data-toggle="buttons">
                <?php
                $name = "CcProfile[checkout_day]";
                echo CHtml::label(CHtml::radioButton($name,!isset($profileCC->checkout_day),array('value'=>'')),'',array('class'=>'btn btn-default checkout_day_radio'.(!isset($profileCC->checkout_day)?' active':'')));
                for($i=0;$i<7;$i++){
                    echo CHtml::label(CHtml::radioButton($name,($i==$profileCC->checkout_day&&isset($profileCC->checkout_day))?true:false,array('value'=>$i)),'',array('class'=>'btn btn-default checkout_day_radio'.(($i==$profileCC->checkout_day&&isset($profileCC->checkout_day))?' active':'')));
                }
                ?>
            </div>
        <?php echo $form->error($profileCC,'checkout_day'); ?>
        </div><div class="col-md-6">
        <?php echo $form->labelEx($profileCC,'checkout_hour'); ?>
        <?php
        $this->widget('timepicker.EDateTimePicker', array(
            'model'=>$profileCC,
            'attribute'=>'checkout_hour',
            'config'=>array(
                'timeFormat' => 'H:i',
                'step' => 60,
                'minTime' => '8:00',
                'maxTime' => '20:00',
            ),
            'htmlOptions'=>array(
                'class'=>'form-control'
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'checkout_hour'); ?>
        </div>
    </div>

    <?php
        echo CHtml::label(Yii::t("view","Payment period"),"");
        foreach($paymentsPeriods as $i=>$period){
            $this->renderPartial("/register/_payment_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
        echo CHtml::label(Yii::t("view","[%][before][type]"),"",array("style"=>"display:inline-block;",'class'=>'add_payment'));
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default btn-xs",
                'onclick'=>'addPaymentPeriod(this);return false;'
            ),
            "<span class='glyphicon glyphicon-plus'></span>"
        );
    ?>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'payment_other'); ?>
        <?php
        echo $form->textArea($profileCC,'payment_other',array('class'=>'form-control','style'=>'max-width:100%;'));
//        $this->widget('ckeditor.CKEditor', array(
//            'model'=>$profileCC,
//            'attribute'=>'payment_other',
//            'config'=> array(
//                'height' => 100,
//                'toolbar' => array(),
//            ),
//        ));
        ?>
        <?php echo $form->error($profileCC,'payment_other'); ?>
    </div>

    <?php
        echo CHtml::label(Yii::t("view","Cancel period"),"");
        foreach($cancelPeriods as $i=>$period){
            $this->renderPartial("/register/_cancel_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
        echo CHtml::label(Yii::t("view","[%][before][type]"),"",array("style"=>"display:inline-block;","class"=>"add_cancel"));
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default btn-xs",
                'onclick'=>'addCancelPeriod(this);return false;'
            ),
            "<span class='glyphicon glyphicon-plus'></span>"
        );
    ?>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'cancel_other'); ?>
        <?php
        echo $form->textArea($profileCC,'cancel_other',array('class'=>'form-control','style'=>'max-width:100%;'));
//        $this->widget('ckeditor.CKEditor', array(
//            'model'=>$profileCC,
//            'attribute'=>'cancel_other',
//            'config'=> array(
//                'height' => 100,
//                'toolbar' => array(),
//            ),
//        ));
        ?>
        <?php echo $form->error($profileCC,'cancel_other'); ?>
    </div>

    <h3><?php echo Yii::t("view","Discount"); ?></h3>
    <?php
        echo CHtml::label(Yii::t("view","Long period"),"");
        foreach($longPeriods as $i=>$period){
            $this->renderPartial("/register/_long_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
        echo CHtml::label(Yii::t("view","[%][value][type]"),"",array("style"=>"display:inline-block;","class"=>"add_long"));
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default btn-xs",
                'onclick'=>'addLongPeriod(this);return false;'
            ),
            "<span class='glyphicon glyphicon-plus'></span>"
        );
    ?>
    <?php
        echo CHtml::label(Yii::t("view","Early booking"),"");
        foreach($earlyPeriods as $i=>$period){
            $this->renderPartial("/register/_early_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
        echo CHtml::label(Yii::t("view","[%][before][type]"),"",array("style"=>"display:inline-block;","class"=>"add_early"));
        echo CHtml::tag(
            "button",
            array(
                "class"=>"btn btn-default btn-xs",
                'onclick'=>'addEarlyPeriod(this);return false;'
            ),
            "<span class='glyphicon glyphicon-plus'></span>"
        );
    ?>
    <div class="row last_minute">
        <?php echo CHtml::label(Yii::t("model","Last minute"),""); ?>
        <div class='col-md-3'>
            <div class="input-group">
                <?php echo $form->textField($profileCC,"last_minute_value",array('class'=>'form-control')); ?>
                <span class="input-group-addon">%</span>
            </div>
            <?php
            echo $form->error($profileCC,"last_minute_value");
            ?>
        </div>
        <div class='col-md-7'>
            <div class="btn-group" data-toggle="buttons" style="display: inline;">
                <?php
                $name = "CcEarlyPeriod[$i][before_duration]";
                echo CHtml::label(CHtml::checkBox($name,-1==$profileCC->last_minute_duration?true:false,array('id'=>'TD')).Yii::t('view','TD'),'',array('title'=>Yii::t('view','To date'),'class'=>'btn btn-default last_minute_duration'.(-1==$profileCC->last_minute_duration?' active':'')));
                ?>
            </div>
            <div style="display: inline;">
                <?php
                if($profileCC->last_minute_duration!=-1){
                    $style = "display:none;";
                } else {
                    $style = "";
                }
                ?>
                <div class="col-md-6">
                <div class="input-group" style="<?php echo $style; ?>">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $profileCC,
                        'attribute' => "last_minute_date_from",
                        'language' => Yii::app()->language,
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => 'y',
                            'maxDate' => '+2y',
                            'yearRange' => 'c:c+2',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'onClose'=>'js: function( selectedDate ) {
                                $( "#CcProfile_last_minute_date_to" ).datepicker( "option", "minDate", selectedDate );
                            }'
                        ),
                        'htmlOptions' => array('class'=>'form-control','placeholder'=>Yii::t("model","Date from")),
                    ));
                    ?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
                <div>
                <div class="input-group" style="<?php echo $style; ?>">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $profileCC,
                        'attribute' => "last_minute_date_to",
                        'language' => Yii::app()->language,
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => 'y',
                            'maxDate' => '+2y',
                            'yearRange' => 'c:c+2',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'onClose'=>'js: function( selectedDate ) {
                                $( "#CcProfile_last_minute_date_from" ).datepicker( "option", "maxDate", selectedDate );
                            }'
                        ),
                        'htmlOptions' => array('class'=>'form-control','placeholder'=>Yii::t("model","Date to")),
                    ));
                    ?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
            </div>
            <div style="display: inline;">
                <?php
                $htmlOptions = array('class'=>'form-control before_duration_value','style'=>'width:auto;');
                if($profileCC->last_minute_duration==-1){
                    $htmlOptions['style'] .= "display:none;";
                }
                echo $form->textField($profileCC,"last_minute_duration",$htmlOptions); ?>
            </div>
            <?php
            echo $form->error($profileCC,"last_minute_duration");
            ?>
        </div>
        <div class='col-md-2'>
            <?php
            $htmlOptions = array('class'=>'form-control');
            if($profileCC->last_minute_duration==-1){
                $htmlOptions['style'] = "display:none;";
            }
            echo $form->dropDownList($profileCC,"last_minute_duration_type_id",$durationTypeList,$htmlOptions);
            echo $form->error($profileCC,"last_minute_duration_type_id");
            ?>
        </div>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileCC,'repeater_discount'); ?>
        <div class="input-group">
            <?php echo $form->textField($profileCC,'repeater_discount',array('class'=>'form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
        <?php echo $form->error($profileCC,'repeater_discount'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'max_discount'); ?>
        <div class="input-group">
            <?php echo $form->textField($profileCC,'max_discount',array('class'=>'form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
        <?php echo $form->error($profileCC,'max_discount'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'discount_other'); ?>
        <?php
        echo $form->textArea($profileCC,'discount_other',array('class'=>'form-control','style'=>'max-width:100%;'));
//        $this->widget('ckeditor.CKEditor', array(
//            'model'=>$profileCC,
//            'attribute'=>'discount_other',
//            'config'=> array(
//                'height' => 100,
//                'toolbar' => array(),
//            ),
//        ));
        ?>
        <?php echo $form->error($profileCC,'discount_other'); ?>
    </div>
<?php if($this->id=="profile"){?>
    <div class="row">
        <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Prev"); ?></button></div>
        <div class="pull-right"><button title="<?php echo Yii::t("view","To go fill in all fields"); ?>" type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Next"); ?></button></div>
    </div>
<?php } ?>
<script>
    $(function(){
        if(appLng=='en'){
            appLng = '';
        }
        var s = $.datepicker.regional[appLng];
        var o = ['<?php echo Yii::t("view","Any"); ?>'];
        $.each(s.dayNamesMin,function(i){
            o.push(this);
        });
        $.each(o,function(i){
            $($(".checkin_day_radio")[i]).append(this);
            $($(".checkout_day_radio")[i]).append(this);
        });
        var check = <?php echo -1==$profileCC->last_minute_duration?-1:isset($profileCC->last_minute_duration)?$profileCC->last_minute_duration:0; ?>;
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
    function addPaymentPeriod(o){
        var n = $(".payment_period").last().attr("class");
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
                model:"CcPaymentsPeriod",
                view:"/register/_payment_period"
            },
            success:function(answer){
                var o =  $(".payment_period");
                $(".aL").remove();
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_payment").before(answer);
                }
                o = $(".payment_period");
                o.parent().find(".aL").remove();
                o.find("div:hidden").addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addCancelPeriod(o){
        var n = $(".cancel_period").last().attr("class");
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
                model:"CcCancelPeriod",
                view:"/register/_cancel_period"
            },
            success:function(answer){
                var o = $(".cancel_period");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_cancel").before(answer);
                }
                o = $(".cancel_period");
                o.parent().find(".aL").remove();
                o.find("div:hidden").addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addLongPeriod(o){
        var n = $(".long_period").last().attr("class");
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
                model:"CcLongPeriod",
                view:"/register/_long_period"
            },
            success:function(answer){
                var o = $(".long_period");
                $(".aL").remove();
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_long").before(answer);
                }
                o = $(".long_period");
                o.parent().find(".aL").remove();
                o.find("div:hidden").addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addEarlyPeriod(o){
        var n = $(".early_period").last().attr("class");
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
                model:"CcEarlyPeriod",
                view:"/register/_early_period"
            },
            success:function(answer){
                var o = $(".early_period");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_early").before(answer);
                }
                o = $(".early_period");
                o.parent().find(".aL").remove();
                o.find("div.eraly_em").addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
</script>