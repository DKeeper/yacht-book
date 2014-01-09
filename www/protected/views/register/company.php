<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 09.12.13
 * @time 15:40
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $modelUser RegistrationForm */
/* @var $profileUser Profile */
/* @var $profileCC CCProfile */
/* @var $form UActiveForm */
/* @var $paymentsPeriods CcPaymentsPeriod[] */
/* @var $cancelPeriods CcCancelPeriod[] */
/* @var $longPeriods CcLongPeriod[] */
/* @var $earlyPeriods CcEarlyPeriod[] */
/* @var $transitLogs CcTransitLog[] */
/* @var $orderOptions CcOrderOptions[] */
Yii::app()->clientScript->registerScriptFile("/js/m.js",CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCoreScript("jquery.ui");
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration company");
$this->breadcrumbs=array(
    UserModule::t("Registration company"),
);
?>

<h1><?php echo UserModule::t("Registration company"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
    <?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
        'id'=>'registration-form',
        'enableAjaxValidation'=>true,
        'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
        'clientOptions'=>array(
            'validateOnSubmit'=>false,
        ),
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
    ));
?>
<?php

    $models = array(
        $modelUser,
        $profileUser,
        $profileCC,
    );

    foreach($paymentsPeriods as $model){
        array_push($models,$model);
    }
    foreach($cancelPeriods as $model){
        array_push($models,$model);
    }
    foreach($longPeriods as $model){
        array_push($models,$model);
    }
    foreach($earlyPeriods as $model){
        array_push($models,$model);
    }
    foreach($transitLogs as $model){
        array_push($models,$model);
    }
    foreach($orderOptions as $model){
        array_push($models,$model);
    }

    echo $err = $form->errorSummary($models);
?>
<?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            UserModule::t("User info")=>array(
                'content'=>$this->renderPartial(
                    '_user_info',
                    array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form),
                    true
                ),
                'id'=>'tab1'
            ),
            UserModule::t("Company info")=>array(
                'content'=>$this->renderPartial(
                    '_company_info_step_1',
                    array('profileCC'=>$profileCC,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
            UserModule::t("Bank")=>array(
                'content'=>$this->renderPartial(
                    '_company_info_step_2',
                    array('profileCC'=>$profileCC,'form'=>$form),
                    true
                ),
                'id'=>'tab3'
            ),
            UserModule::t("Policy")=>array(
                'content'=>$this->renderPartial(
                    '_company_info_step_3',
                    array(
                        'profileCC'=>$profileCC,
                        'form'=>$form,
                        'paymentsPeriods'=>$paymentsPeriods,
                        'cancelPeriods'=>$cancelPeriods,
                        'longPeriods'=>$longPeriods,
                        'earlyPeriods'=>$earlyPeriods,
                    ),
                    true
                ),
                'id'=>'tab4'
            ),
            UserModule::t("Prices")=>array(
                'content'=>$this->renderPartial(
                    '_company_info_step_4',
                    array(
                        'profileCC'=>$profileCC,
                        'form'=>$form,
                        'transitLogs'=>$transitLogs,
                        'orderOptions'=>$orderOptions,
                    ),
                    true
                ),
                'id'=>'tab5'
            ),
        ),
        // additional javascript options for the tabs plugin
        'options'=>array(
            //'collapsible'=>true,
            'disabled'=> empty($err)?array(1,2,3,4):array(),
        ),
        'htmlOptions'=>array(
            'id'=>'company_tabs',
        ),
    ));
    ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function(){
        $('button[data-type="next"]').tooltip();
        $('button[data-type="back"]').on("click",function(event){
            var currTabNum = +$('#company_tabs').tabs("option","active");
            $('#company_tabs').tabs("option","active",currTabNum-1);
        });
        $('button[data-type="next"]').on("click",function(event){
            var o = $('#company_tabs li.ui-state-disabled a');
            var disabledDiv = [];
            var Field = [];
            $.each(o,function(){
                disabledDiv.push($(this).attr("title"));
            });
            $.each($('#company_tabs div[role="tabpanel"]'),function(){
                if(disabledDiv.indexOf($(this).attr("id"))==-1){
                    var f = $(this).find("input").serializeArray();
                    Field = Field.concat(f);
                }
            });
            var currTabNum = +$('#company_tabs').tabs("option","active");
            var data = {ajax:'registration-form'};
            $.each(Field,function(){
                data[this.name]=this.value;
            });
            $.ajax({
                url:'/register/company',
                data: data,
                success:function(answer){
                    if(emptyObject(answer)){
                        $('#company_tabs').tabs("enable",currTabNum+1);
                        $('#company_tabs').tabs("option","active",currTabNum+1);
                    } else {
                        alert("Необходимо заполнить все поля или устранить ошибки ввода");
                    }
                },
                type:'POST',
                dataType:'json',
                async:true
            });
            return false;
        });
    });
</script>
<?php endif; ?>