<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 14.12.13
 * @time 14:37
 * Created by JetBrains PhpStorm.
 */
/** @var $this AdminController */
/** @var $company CcProfile */
/** @var $captain CProfile */
/** @var $manager MProfile */
$this->widget('CTabView', array(
    'tabs'=>array(
        'account_admin'=>array(
            'title'=>Yii::t('view','Accounts admin'),
            'view'=>'_account',
            'data'=>array(
                'company' => $company,
                'captain' => $captain,
            ),
        ),
        'fleets_admin'=>array(
            'title'=>Yii::t('view','Fleets admin'),
            'view'=>'_fleets',
            'data'=>array(),
        ),
        'app_settings'=>array(
            'title'=>Yii::t('view','System settings'),
            'view'=>'_app',
            'data'=>array(),
        ),
    ),
    'htmlOptions'=>array(
        'id'=>'admin_tabs',
    ),
));