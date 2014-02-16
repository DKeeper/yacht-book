<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 01.01.14
 * @time 13:51
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $save_mode integer */
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
    echo $form->hiddenField($profileCC,'save_mode',array('id'=>'save_mode','name'=>'save_mode','value'=>-1));
    $options = array();
    if($save_mode!=-1){
        $options['active'] = $save_mode;
    }
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
        'options'=>$options,
        // additional javascript options for the tabs plugin
        'htmlOptions'=>array(
            'id'=>'company_tabs',
        ),
    ));
    ?>
    <div class="row submit">
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo UserModule::t("Save"); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a id="save" href="#"><?php echo UserModule::t("Save"); ?></a></li>
                <li><a id="save_close" href="#"><?php echo UserModule::t("Save and close"); ?></a></li>
            </ul>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script>
    var checker = {};
    $(function(){
        $("#User_email").on("change",function(){
            $("#CcProfile_company_email").val($(this).val());
        });
        $(".dropdown-menu a").on("click",function(event){
            if(this.id==="save_close"){
                $("#save_mode").val(-1);
            } else {
                $("#save_mode").val(+$('#company_tabs').tabs("option","active"));
            }
            $("#profile-form").submit();
        });
    });
</script>