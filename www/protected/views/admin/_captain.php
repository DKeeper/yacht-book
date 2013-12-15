<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 14.12.13
 * @time 14:52
 * Created by JetBrains PhpStorm.
 */
/** @var $this AdminController */
/** @var $captain CProfile */
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'c-profile-grid',
    'dataProvider'=>$captain->search(),
    'filter'=>$captain,
    'columns'=>array(
        'id',
        'name_eng',
        'last_name_eng',
        array(
            'name'=>'isActive',
            'value'=>'$data->isActive?Yii::t("view","Yes"):Yii::t("view","No")',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
));