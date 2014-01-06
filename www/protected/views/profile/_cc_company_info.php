<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 13.12.13
 * @time 10:24
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
$this->widget('CTabView', array(
    'tabs'=>array(
        'company_info_1'=>array(
            'title'=>UserModule::t("General info"),
            'view'=>'_cc_company_info_step_1',
            'data'=>array('model'=>$model),
        ),
        'company_info_2'=>array(
            'title'=>UserModule::t("Bank"),
            'view'=>'_cc_company_info_step_2',
            'data'=>array('model'=>$model),
        ),
        'company_info_3'=>array(
            'title'=>UserModule::t("Policy"),
            'view'=>'_cc_company_info_step_3',
            'data'=>array('model'=>$model),
        ),
        'company_info_4'=>array(
            'title'=>UserModule::t("Prices"),
            'view'=>'_cc_company_info_step_4',
            'data'=>array('model'=>$model),
        ),
    ),
    'htmlOptions'=>array(
        'id'=>'company_tabs',
    ),
));