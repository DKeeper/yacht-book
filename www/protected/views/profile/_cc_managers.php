<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 15:58
 * Created by JetBrains PhpStorm.
 */
/* @var $this ProfileController */
/* @var $model User */
/* @var $modelUser RegistrationForm */
/* @var $profileUser Profile */
/* @var $profileCC CcProfile */
/* @var $profileM MProfile */
/* @var $owner boolean */
/* @var $role string */
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>new CActiveDataProvider(
        'MProfile',
        array(
            '_criteria'=>new CDbCriteria(
                array(
                    'condition'=>'cc_id = :ccid',
                    'params'=>array(':ccid'=>$profileCC->cc_id)
                )
            )
        )
    ),
    'itemView'=>'_view_company_manager',
    'emptyText'=>Yii::t('view','No registered managers'),
));
if($role=='CC' && $owner){
    $this->widget('fancyapps.EFancyApps', array(
            'mode'=>'inline',
            'id'=>'createManager',
            'config'=>array(
                'afterClose'=>"function(){window.location = '".($this->createAbsoluteUrl("/profile"))."';}",
            ),
            'options' => array(
                'url' => '#c',
                'label'=> Yii::t('view','Create manager'),
            ),
            'htmlOptions' => array(
                'class' => 'add_m',
            ),
        )
    );
    ?>
<div style="display:none;" id="c">
    <?php
    $this->renderPartial('/register/manager',array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'profileM'=>$profileM));
    ?>
</div>
<?php
}