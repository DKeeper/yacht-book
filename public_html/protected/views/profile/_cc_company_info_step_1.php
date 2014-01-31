<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 06.01.14
 * @time 15:21
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
$geoField = "nazvanie_".Yii::app()->params['geoFieldName'][Yii::app()->language];
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'label'=>$model->getAttributeLabel('isActive'),
            'value'=>$model->isActive?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_name'),
            'value'=>!empty($model->company_name)?$model->company_name:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_country_id'),
            'value'=>isset($model->country)?$model->country->$geoField:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_city_id'),
            'value'=>isset($model->city)?$model->city->$geoField:Yii::t("view","No data"),
        ),
        'longitude',
        'latitude',
        array(
            'label'=>$model->getAttributeLabel('company_postal_code'),
            'value'=>!empty($model->company_postal_code)?$model->company_postal_code:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_city_id'),
            'value'=>!empty($model->company_full_addres)?$model->company_full_addres:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_web_site'),
            'value'=>!empty($model->company_web_site)?$model->company_web_site:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_email'),
            'value'=>!empty($model->company_email)?$model->company_email:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_phone'),
            'value'=>!empty($model->company_phone)?$model->company_phone:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('company_faxe'),
            'value'=>!empty($model->company_faxe)?$model->company_faxe:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('q_boat'),
            'value'=>!empty($model->q_boat)?$model->q_boat:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('ccLanguages'),
            'value'=>$model->getPropertyAsString('languages'),
        ),
    ),
));