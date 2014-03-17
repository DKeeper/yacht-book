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
        'value'=>isset($model->checkin_day)?$model->checkin_day:Yii::t("view","Any"),
        'cssClass'=>'chind',
    ),
    array(
        'label'=>$model->getAttributeLabel('checkin_hour'),
        'value'=>!empty($model->checkin_hour)?$model->checkin_hour:Yii::t("view","No data"),
    ),
    array(
        'label'=>$model->getAttributeLabel('checkout_day'),
        'value'=>isset($model->checkout_day)?$model->checkout_day:Yii::t("view","Any"),
        'cssClass'=>'choutd',
    ),
    array(
        'label'=>$model->getAttributeLabel('checkout_hour'),
        'value'=>!empty($model->checkout_hour)?$model->checkout_hour:Yii::t("view","No data"),
    ),
);
foreach($model->ccPaymentsPeriods as $i => $data){
    $value = '{p}% in {v} {d}';
    $params = array('{p}'=>$data->value,'{v}'=>$data->before_duration,'{d}'=>strtolower(Yii::t('view',$data->durationType->name)));
    if($data->before_duration<0){
        $params = array();
        if($data->before_duration==-2){
            $value = Yii::t("view","{v}% after confirmation",array('{v}'=>$data->value));
        } else {
            $value = Yii::t("view","{v}% on spot",array('{v}'=>$data->value));
        }
    }
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Payment period #{n}',array('{n}'=>$i+1)),
                'value'=>Yii::t('view',$value,$params),
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
            'type'=>'html',
        ),
    )
);
foreach($model->ccCancelPeriods as $i => $data){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Cancel period #{n}',array('{n}'=>$i+1)),
                'value'=>Yii::t('view','{p}% in {v} {d}',array('{p}'=>$data->value,'{v}'=>$data->before_duration,'{d}'=>strtolower(Yii::t('view',$data->durationType->name)))),
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
            'type'=>'html',
        ),
    )
);
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>'',
            'value'=>'<h3>'.Yii::t("view","Discount").'</h3>',
            'type'=>'html',
        ),
    )
);
foreach($model->ccLongPeriods as $i => $data){
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Long period #{n}',array('{n}'=>$i+1)),
                'value'=>Yii::t('view','{p}% for {v} {d}',array('{p}'=>$data->value,'{v}'=>$data->before_duration,'{d}'=>strtolower(Yii::t('view',$data->durationType->name)))),
            ),
        )
    );
}
foreach($model->ccEarlyPeriods as $i => $data){
    $value = '{p}% in {v} {d}';
    $params = array(
        '{p}'=>$data->value,
        '{v}'=>$data->before_duration,
        '{d}'=>strtolower(Yii::t('view',$data->durationType->name))
    );
    if($data->before_duration=="-1"){
        $value = '{p}% to {d}';
        $params = array(
            '{p}'=>$data->value,
            '{d}'=>$data->date_value
        );
    }
    $attributes = array_merge(
        $attributes,
        array(
            array(
                'label'=>Yii::t('model','Early booking #{n}',array('{n}'=>$i+1)),
                'value'=>Yii::t('view',$value,$params),
            ),
        )
    );
}
if($model->last_minute_duration!="-1"){
    $value = '{p}% for {v} {d} before charter';
    $params = array(
        '{p}'=>$model->last_minute_value,
        '{v}'=>$model->last_minute_duration,
        '{d}'=>strtolower(Yii::t('view',$model->lastMinuteDurationType->name))
    );
} else {
    $value = '{p}% from {dF} to {dT}';
    $params = array(
        '{p}'=>$model->last_minute_value,
        '{dF}'=>date('d.m.Y',strtotime($model->last_minute_date_from)),
        '{dT}'=>date('d.m.Y',strtotime($model->last_minute_date_to))
    );
}
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>Yii::t('model','Last minute'),
            'value'=>Yii::t('view',$value,$params),
        ),
    )
);
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>$model->getAttributeLabel('repeater_discount'),
            'value'=>!empty($model->repeater_discount)?$model->repeater_discount."%":Yii::t("view","No data"),
        ),
        array(
            'label'=>$model->getAttributeLabel('max_discount'),
            'value'=>!empty($model->max_discount)?$model->max_discount."%":Yii::t("view","No data"),
        ),
    )
);
$attributes = array_merge(
    $attributes,
    array(
        array(
            'label'=>$model->getAttributeLabel('discount_other'),
            'value'=>!empty($model->discount_other)?$model->discount_other:Yii::t("view","No data"),
            'type'=>'html',
        ),
    )
);
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$attributes,
));
?>
<script>
    appLng = '<?php echo Yii::app()->language; ?>';
    $(function(){
        if(appLng=='en'){
            appLng = '';
        }
        var s = $.datepicker.regional[appLng];
        if(appLng==''){
            appLng='en';
        }
        var chIn = +$(".chind td").text();
        var chOut = +$(".choutd td").text();
        if(!isNaN(chIn)){
            $(".chind td").empty().append(s.dayNames[chIn]);
        }
        if(!isNaN(chOut)){
            $(".choutd td").empty().append(s.dayNames[chOut]);
        }
    });
</script>