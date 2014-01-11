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
            'value'=>'isset($data->country)?$data->country->nazvanie_1:null',
            'filter'=> CHtml::activeTextField($company->searchCountry, 'nazvanie_1'),
        ),
        array(
            'name'=>'company_city_id',
            'value'=>'isset($data->city)?$data->city->nazvanie_1:null',
            'filter'=> CHtml::activeTextField($company->searchCity, 'nazvanie_1'),
        ),
        array(
            'name'=>'isActive',
            'value'=>'$data->isActive?Yii::t("view","Yes"):Yii::t("view","No")',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createAbsoluteUrl("profile/view",array("id"=>$data->cc_id))',
                ),
            ),
            'htmlOptions'=>array(
                'width' => 75,
                'style' => 'text-align:center;',
            ),
        ),
    ),
));