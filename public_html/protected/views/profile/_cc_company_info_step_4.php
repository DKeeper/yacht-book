<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 06.01.14
 * @time 15:24
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model CcProfile */
$attributes = array(
    array(
        'label'=>$model->getAttributeLabel('currency_id'),
        'value'=>$model->currency->name,
    )
);
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
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>'',
            'value'=>'<h3>'.Yii::t("view","General options").'</h3>',
            'type'=>'html',
        ),
    )
);
$includedOptions = $model->ccOrderOptions(array('condition'=>'included = :i','params'=>array(':i'=>true)));
$obligatoryOptions = $model->ccOrderOptions(array('condition'=>'obligatory = :o','params'=>array(':o'=>true)));
$otherOptions = $model->ccOrderOptions(array('condition'=>'obligatory = :o and included = :i','params'=>array(':i'=>false,':o'=>false)));
if(!empty($includedOptions)){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>'',
                'value'=>'<h4>'.Yii::t("view","included").'</h4>',
                'type'=>'html',
            ),
        )
    );
    foreach($includedOptions as $i => $options){
        $attributes = array_merge(
            $attributes,
            array(
                array(
                    'label'=>Yii::t('model','Order options #{n}',array('{n}'=>$i+1)),
                    'value'=>Yii::t(
                        'model',
                        '{opt} - {v} per {d}',
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
}
if(!empty($obligatoryOptions)){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>'',
                'value'=>'<h4>'.Yii::t("view","obligatory").'</h4>',
                'type'=>'html',
            ),
        )
    );
    foreach($obligatoryOptions as $i => $options){
        $attributes = array_merge(
            $attributes,
            array(
                array(
                    'label'=>Yii::t('model','Order options #{n}',array('{n}'=>$i+1)),
                    'value'=>Yii::t(
                        'model',
                        '{opt} - {v} per {d}',
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
}
if(!empty($otherOptions)){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>'',
                'value'=>'<h4>'.Yii::t("view","optional").'</h4>',
                'type'=>'html',
            ),
        )
    );
    foreach($otherOptions as $i => $options){
        $attributes = array_merge(
            $attributes,
            array(
                array(
                    'label'=>Yii::t('model','Order options #{n}',array('{n}'=>$i+1)),
                    'value'=>Yii::t(
                        'model',
                        '{opt} - {v} per {d}',
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
}
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>$model->getAttributeLabel('options_other'),
            'value'=>$model->options_other,
            'type'=>'html'
        )
    )
);
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$attributes,
));