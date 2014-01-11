<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 14.12.13
 * @time 14:45
 * Created by JetBrains PhpStorm.
 */
/** @var $this AdminController */
/** @var $company CcProfile */
/** @var $captain CProfile */
$this->widget('CTabView', array(
    'tabs'=>array(
        'captain_admin'=>array(
            'title'=>Yii::t('view','Captain admin'),
            'view'=>'_captain',
            'data'=>array(
                'captain' => $captain,
            ),
        ),
        'company_admin'=>array(
            'title'=>Yii::t('view','Company admin'),
            'view'=>'_company',
            'data'=>array(
                'company' => $company,
            ),
        ),
    ),
    'htmlOptions'=>array(
        'id'=>'account_admin_tabs',
    ),
));