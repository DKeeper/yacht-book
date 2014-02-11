<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 06.01.14
 * @time 15:24
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'label'=>$model->getAttributeLabel('vat'),
            'value'=>!empty($model->vat)?$model->vat:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('bank_name'),
            'value'=>!empty($model->bank_name)?$model->bank_name:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('bank_addres'),
            'value'=>!empty($model->bank_addres)?$model->bank_addres:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('beneficiary'),
            'value'=>!empty($model->beneficiary)?$model->beneficiary:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('beneficiary_addres'),
            'value'=>!empty($model->beneficiary_addres)?$model->beneficiary_addres:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('account_no'),
            'value'=>!empty($model->account_no)?$model->account_no:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('swift'),
            'value'=>!empty($model->swift)?$model->swift:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('iban'),
            'value'=>!empty($model->iban)?$model->iban:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('visa'),
            'value'=>$model->visa?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('visa_percent'),
            'value'=>!empty($model->visa_percent)?$model->visa_percent:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('mastercard'),
            'value'=>$model->mastercard?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('mastercard_percent'),
            'value'=>!empty($model->mastercard_percent)?$model->mastercard_percent:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('amex'),
            'value'=>$model->amex?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('amex_percent'),
            'value'=>!empty($model->amex_percent)?$model->amex_percent:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('bank_transfer'),
            'value'=>$model->bank_transfer?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('western_union'),
            'value'=>$model->western_union?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('contact'),
            'value'=>$model->contact?Yii::t("view","Yes"):Yii::t("view","No"),
        ),
        array(
            'label'=>$model->getAttributeLabel('others'),
            'value'=>!empty($model->others)?$model->others:Yii::t("view","No data"),
            'type'=>'html',
        ),
    ),
));