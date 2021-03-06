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
/* @var $validate boolean */

$scriptLink = Yii::app()->clientScript->getCoreScriptUrl().'/jui/js/jquery-ui-i18n.min.js';
Yii::app()->clientScript->registerScriptFile($scriptLink,CClientScript::POS_HEAD);

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
<h3 style="color:red;"><?php echo Yii::t("view","You can fill in other data profile after registration, in a private office.<br/>We remind you that without a fully populated part of the functional profile of the site will not be available.")?></h3>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
        'id'=>'registration-form',
        'enableAjaxValidation'=>true,
        'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
        'clientOptions'=>array(
            'validateOnSubmit'=>false,
        ),
        'htmlOptions' => array(
            'class'=>'form-horizontal'
        ),
    ));
?>
<?php

    /** @var $models CActiveRecord[] */
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

    echo $form->errorSummary($models);

    $err = false;
    foreach($models as $m){
        $e = $m->getErrors();
        if(!empty($e)){
            $err = true;
            break;
        }
    }
    $options = array();
    if(!$err){
        $options = array(
            //'collapsible'=>true,
            'disabled'=> array(1,2,3,4),
        );
    }
?>
<?php
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            UserModule::t("User info")=>array(
                'content'=>$this->renderPartial(
                    '_user_info',
                    array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'form'=>$form,'validate'=>$validate),
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
        'options'=>$options,
        'htmlOptions'=>array(
            'id'=>'company_tabs',
        ),
    ));
    ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    var checker = {};
    $(function(){
        $('button[data-type="next"]').tooltip();
        $('button[data-type="submit"]').tooltip();
        $('button[data-type="back"]').on("click",function(event){
            var currTabNum = +$('#company_tabs').tabs("option","active");
            $('#company_tabs').tabs("option","active",currTabNum-1);
        });
        $('button[data-type="next"]').on("click",function(event){
            event.preventDefault();
            $('#registration-form').data('settings')['submitting'] = true;
            $.fn.yiiactiveform.validate(
                    '#registration-form',
                    function(messages){
                        var hasError = false;
                        $.each($('#registration-form').data('settings')['attributes'], function () {
                            hasError = $.fn.yiiactiveform.updateInput(this, messages, $('#registration-form')) || hasError;
                        });
                        $.fn.yiiactiveform.updateSummary($('#registration-form'), messages);
                        if(!hasError){
                            var currTabNum = +$('#company_tabs').tabs("option","active");
                            $('#company_tabs').tabs("enable",currTabNum+1);
                            $('#company_tabs').tabs("option","active",currTabNum+1);
                        }
                    }
            );
            $('#registration-form').data('settings')['submitting'] = false;
            return false;
        });
        $("#RegistrationForm_email").on("change",function(){
            $("#CcProfile_company_email").val($(this).val());
        });
    });
</script>
<?php endif; ?>