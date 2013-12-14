<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 14.12.13
 * @time 14:41
 * Created by JetBrains PhpStorm.
 */
/** @var $this AdminController */
/** @var $company CcProfile */
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'cc-profile-grid',
    'dataProvider'=>$company->search(),
    'filter'=>$company,
    'columns'=>array(
        'id',
        'company_name',
        'company_email',
        array(
            'name'=>'company_country_id',
            'value'=>'$data->country->nazvanie_1',
//            'filter'=>$yachtModelList,
        ),
        array(
            'name'=>'company_city_id',
            'value'=>'$data->city->nazvanie_1',
//            'filter'=>$yachtModelList,
        ),
        array(
            'name'=>'isActive',
            'value'=>'$data->isActive?Yii::t("view","Yes"):Yii::t("view","No")',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
));