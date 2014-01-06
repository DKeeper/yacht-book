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
        'label'=>$model->getAttributeLabel('checkin_day'),
        'value'=>!empty($model->checkin_day)?$model->checkin_day:Yii::t("view","No data"),
    ),
    array(
        'label'=>$model->getAttributeLabel('checkin_hour'),
        'value'=>!empty($model->checkin_hour)?$model->checkin_hour:Yii::t("view","No data"),
    ),
    array(
        'label'=>$model->getAttributeLabel('checkout_day'),
        'value'=>!empty($model->checkout_day)?$model->checkout_day:Yii::t("view","No data"),
    ),
    array(
        'label'=>$model->getAttributeLabel('checkout_hour'),
        'value'=>!empty($model->checkout_hour)?$model->checkout_hour:Yii::t("view","No data"),
    ),
);
foreach($model->ccPaymentsPeriods as $i => $data){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Payment period #{n}',array('{n}'=>$i+1)),
                'value'=>$data->value.'% за '.$data->before_duration.' '.mb_strtolower($data->durationType->name),
            ),
        )
    );
}
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>$model->getAttributeLabel('payment_other'),
            'value'=>!empty($model->payment_other)?$model->payment_other:Yii::t("view","No data"),
        ),
    )
);
foreach($model->ccCancelPeriods as $i => $data){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Cancel period #{n}',array('{n}'=>$i+1)),
                'value'=>$data->value.'% за '.$data->before_duration.' '.mb_strtolower($data->durationType->name),
            ),
        )
    );
}
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>$model->getAttributeLabel('cancel_other'),
            'value'=>!empty($model->cancel_other)?$model->cancel_other:Yii::t("view","No data"),
        ),
    )
);
foreach($model->ccLongPeriods as $i => $data){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Long period #{n}',array('{n}'=>$i+1)),
                'value'=>$data->value.'% за '.$data->before_duration.' '.mb_strtolower($data->durationType->name),
            ),
        )
    );
}
foreach($model->ccEarlyPeriods as $i => $data){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Early period #{n}',array('{n}'=>$i+1)),
                'value'=>$data->value.'% за '.$data->before_duration.' '.mb_strtolower($data->durationType->name),
            ),
        )
    );
}
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>$model->getAttributeLabel('repeater_discount'),
            'value'=>!empty($model->repeater_discount)?$model->repeater_discount:Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('max_discount'),
            'value'=>!empty($model->max_discount)?$model->max_discount:Yii::t("view","No data"),
        ),
    )
);
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$attributes,
));