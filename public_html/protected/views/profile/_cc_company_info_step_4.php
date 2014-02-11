<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 06.01.14
 * @time 15:24
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
$attributes = array();
foreach($model->ccTransitLogs as $i => $transitLog){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Transit log #{n}',array('{n}'=>$i+1)),
                'value'=>Yii::t(
                    'model',
                    '{c} (Price: {v}, Obligatory: {o}, Included: {i})',
                    array(
                        '{c}'=>$transitLog->country['nazvanie_'.Yii::app()->params['geoFieldName'][Yii::app()->language]],
                        '{v}'=>$transitLog->price,
                        '{o}'=>$transitLog->obligatory?Yii::t("view","Yes"):Yii::t("view","No"),
                        '{i}'=>$transitLog->included?Yii::t("view","Yes"):Yii::t("view","No"),
                    )
                ),
            ),
        )
    );
}
foreach($model->ccOrderOptions as $i => $options){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Order options #{n}',array('{n}'=>$i+1)),
                'value'=>Yii::t(
                    'model',
                    '{opt} - {v} for {d} (Obligatory: {o}, Included: {i})',
                    array(
                        '{opt}'=>$options->orderOption->name,
                        '{v}'=>$options->price,
                        '{d}'=>mb_strtolower(Yii::t('view',$options->durationType->name)),
                        '{o}'=>$options->obligatory?Yii::t("view","Yes"):Yii::t("view","No"),
                        '{i}'=>$options->included?Yii::t("view","Yes"):Yii::t("view","No"),
                    )
                ),
            ),
        )
    );
}
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$attributes,
));