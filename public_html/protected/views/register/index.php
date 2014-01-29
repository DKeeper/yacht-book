<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 09.12.13
 * @time 15:39
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
?>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'type-register-form',
    )); ?>
    <div class="row">
        <?php
        echo CHtml::label(Yii::t('view','Select type of register'),'type_register');
        echo CHtml::dropDownList('type_register','',array('0'=>Yii::t('model','Captain'),'1'=>Yii::t('model','Charter Company')));
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('view','Register')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>