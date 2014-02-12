<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 01.01.14
 * @time 13:51
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $modelUser User */
/* @var $profileUser Profile */
/* @var $profileCC CCProfile */
/* @var $form UActiveForm */
/* @var $paymentsPeriods CcPaymentsPeriod[] */
/* @var $cancelPeriods CcCancelPeriod[] */
/* @var $longPeriods CcLongPeriod[] */
/* @var $earlyPeriods CcEarlyPeriod[] */
/* @var $transitLogs CcTransitLog[] */
/* @var $orderOptions CcOrderOptions[] */
$scriptLink = Yii::app()->clientScript->getCoreScriptUrl().'/jui/js/jquery-ui-i18n.min.js';
Yii::app()->clientScript->registerScriptFile($scriptLink,CClientScript::POS_HEAD);
?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'profile-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
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
                    '/register/_company_info_step_1',
                    array('profileCC'=>$profileCC,'form'=>$form),
                    true
                ),
                'id'=>'tab2'
            ),
            UserModule::t("Bank")=>array(
                'content'=>$this->renderPartial(
                    '/register/_company_info_step_2',
                    array('profileCC'=>$profileCC,'form'=>$form),
                    true
                ),
                'id'=>'tab3'
            ),
            UserModule::t("Policy")=>array(
                'content'=>$this->renderPartial(
                    '/register/_company_info_step_3',
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
                    '/register/_company_info_step_4',
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
        'htmlOptions'=>array(
            'id'=>'company_tabs',
        ),
    ));
    ?>
    <div class="row submit">
        <button data-type="submit" class="btn btn-default"><?php echo UserModule::t("Save"); ?></button>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    $(function(){
        $("#User_email").on("change",function(){
            $("#CcProfile_company_email").val($(this).val());
        });
        $(".payment_before_duration").on("click",function(){
            if(+$(this).find("input").val()<0){
                $(this).parents("div.input-group").find(".payment_period_value").prop("disabled",true).val("");
                $(this).parents("div.payment_period").find("select").prop("disabled",true).val(1);
            } else {
                $(this).parents("div.input-group").find(".payment_period_value").prop("disabled",false);
                $(this).parents("div.payment_period").find("select").prop("disabled",false);
            }
        });
    });
</script>