<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 16.01.14
 * @time 12:32
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CProfile */
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'label'=>$model->getAttributeLabel('isActive'),
            'value'=>$model->isActive?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('name_eng'),
            'value'=>!empty($model->name_eng)?$model->name_eng:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('last_name_eng'),
            'value'=>isset($model->last_name_eng)?$model->last_name_eng:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('name_rus'),
            'value'=>isset($model->name_rus)?$model->name_rus:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('sex_id'),
            'value'=>$model->sex->name,
        ),
        array(
            'label'=>$model->getAttributeLabel('zagran_passport'),
            'value'=>isset($model->zagran_passport)?$model->zagran_passport:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('expire_date'),
            'value'=>isset($model->expire_date)?(date('d.m.Y',strtotime($model->expire_date))):Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('nationality_id'),
            'value'=>$model->nationality->name,
        ),
        array(
            'label'=>$model->getAttributeLabel('date_of_birth'),
            'value'=>isset($model->date_of_birth)?(date('d.m.Y',strtotime($model->date_of_birth))):Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('phone'),
            'value'=>isset($model->phone)?$model->phone:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('email'),
            'value'=>isset($model->email)?$model->email:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('license'),
            'value'=>isset($model->license)?$model->license:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('school_issued'),
            'value'=>isset($model->school_issued)?$model->school_issued:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('date_issued'),
            'value'=>isset($model->date_issued)?(date('d.m.Y',strtotime($model->date_issued))):Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('website'),
            'value'=>isset($model->website)?$model->website:Yii::t("view","No data"),
        ),
    ),
));