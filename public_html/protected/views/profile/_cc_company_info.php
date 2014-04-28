<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 13.12.13
 * @time 10:24
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
/* @var $sub_tabs integer */
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        UserModule::t("General info")=>array(
            'content'=>$this->renderPartial(
                '_cc_company_info_step_1',
                array('model'=>$model),
                true
            ),
            'id'=>'tab_1'
        ),
        UserModule::t("Bank")=>array(
            'content'=>$this->renderPartial(
                '_cc_company_info_step_2',
                array('model'=>$model),
                true
            ),
            'id'=>'tab_2'
        ),
        UserModule::t("Policy")=>array(
            'content'=>$this->renderPartial(
                '_cc_company_info_step_3',
                array('model'=>$model),
                true
            ),
            'id'=>'tab_3'
        ),
        UserModule::t("Prices")=>array(
            'content'=>$this->renderPartial(
                '_cc_company_info_step_4',
                array('model'=>$model),
                true
            ),
            'id'=>'tab_4'
        ),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'active'=>$sub_tabs,
        'activate'=>'js: function(event, ui){
            $.cookie("sub_tabs", $(this).tabs("option","active"),{path:"/"});
        }',
    ),
    'htmlOptions'=>array(
        'id'=>'company_tabs',
    ),
));
?>