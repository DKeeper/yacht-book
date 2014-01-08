<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 10.12.13
 * @time 13:53
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileC CProfile */
/* @var $form CActiveForm */
$genderList = Gender::model()->getModelList();
$nationalityList = Nationality::model()->getModelList();
?>
    <?php echo $form->hiddenField($profileC,'c_id'); ?>
    <div class="row">
        <?php echo $form->labelEx($profileC,'name_eng'); ?>
        <?php echo $form->textField($profileC,'name_eng'); ?>
        <?php echo $form->error($profileC,'name_eng'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'name_rus'); ?>
        <?php echo $form->textField($profileC,'name_rus'); ?>
        <?php echo $form->error($profileC,'name_rus'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'last_name_eng'); ?>
        <?php echo $form->textField($profileC,'last_name_eng'); ?>
        <?php echo $form->error($profileC,'last_name_eng'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'last_name_rus'); ?>
        <?php echo $form->textField($profileC,'last_name_rus'); ?>
        <?php echo $form->error($profileC,'last_name_rus'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'sex_id'); ?>
        <?php echo $form->dropDownList($profileC,'sex_id',$genderList); ?>
        <?php echo $form->error($profileC,'sex_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'zagran_passport'); ?>
        <?php echo $form->textField($profileC,'zagran_passport'); ?>
        <?php echo $form->error($profileC,'zagran_passport'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'expire_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $profileC,
            'attribute' => 'expire_date',
            'language' => Yii::app()->language,
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'minDate' => 0,
                'changeMonth' => true,
                'changeYear' => true,
            ),
            /*'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
            ),*/
        ));
        ?>
        <?php echo $form->error($profileC,'expire_date'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'nationality_id'); ?>
        <?php echo $form->dropDownList($profileC,'nationality_id',$nationalityList); ?>
        <?php echo $form->error($profileC,'nationality_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'date_of_birth'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $profileC,
            'attribute' => 'date_of_birth',
            'language' => Yii::app()->language,
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'minDate' => '-70y',
                'yearRange' => 'c-70:c+10',
                'changeMonth' => true,
                'changeYear' => true,
            ),
            /*'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
            ),*/
        ));
        ?>
        <?php echo $form->error($profileC,'date_of_birth'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'phone'); ?>
        <?php echo $form->textField($profileC,'phone'); ?>
        <?php echo $form->error($profileC,'phone'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'email'); ?>
        <?php echo $form->textField($profileC,'email'); ?>
        <?php echo $form->error($profileC,'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'site_commission'); ?>
        <?php echo $form->textField($profileC,'site_commission'); ?>
        <?php echo $form->error($profileC,'site_commission'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'avatar'); ?>
        <?php echo $form->fileField($profileC,'avatar'); ?>
        <?php echo $form->error($profileC,'avatar'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'license'); ?>
        <?php echo $form->textField($profileC,'license'); ?>
        <?php echo $form->error($profileC,'license'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'school_issued'); ?>
        <?php echo $form->textField($profileC,'school_issued'); ?>
        <?php echo $form->error($profileC,'school_issued'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'date_issued'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $profileC,
            'attribute' => 'date_issued',
            'language' => Yii::app()->language,
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'minDate' => 0,
                'changeMonth' => true,
                'changeYear' => true,
            ),
            /*'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
            ),*/
        ));
        ?>
        <?php echo $form->error($profileC,'date_issued'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'scan_of_license'); ?>
        <?php echo $form->fileField($profileC,'scan_of_license'); ?>
        <?php echo $form->error($profileC,'scan_of_license'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'website'); ?>
        <?php echo $form->textField($profileC,'website'); ?>
        <?php echo $form->error($profileC,'website'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'receive_news'); ?>
        <?php echo $form->checkBox($profileC,'receive_news'); ?>
        <?php echo $form->error($profileC,'receive_news'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'professional_regatta'); ?>
        <?php echo $form->checkBox($profileC,'professional_regatta'); ?>
        <?php echo $form->error($profileC,'professional_regatta'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'amateur_regatta'); ?>
        <?php echo $form->checkBox($profileC,'amateur_regatta'); ?>
        <?php echo $form->error($profileC,'amateur_regatta'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'repeater'); ?>
        <?php echo $form->textField($profileC,'repeater'); ?>
        <?php echo $form->error($profileC,'repeater'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'extra'); ?>
        <?php echo $form->textField($profileC,'extra'); ?>
        <?php echo $form->error($profileC,'extra'); ?>
    </div>
    <div class="row submit">
        <?php echo CHtml::submitButton(UserModule::t("Register")); ?>
    </div>