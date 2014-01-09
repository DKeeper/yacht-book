<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.12.13
 * @time 16:10
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileCC CCProfile */
/* @var $form CActiveForm */
?>
    <div class="row">
        <?php echo $form->labelEx($profileCC,'vat'); ?>
        <?php echo $form->textField($profileCC,'vat'); ?>
        <?php echo $form->error($profileCC,'vat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_name'); ?>
        <?php echo $form->textField($profileCC,'bank_name'); ?>
        <?php echo $form->error($profileCC,'bank_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_addres'); ?>
        <?php echo $form->textField($profileCC,'bank_addres'); ?>
        <?php echo $form->error($profileCC,'bank_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'beneficiary'); ?>
        <?php echo $form->textField($profileCC,'beneficiary'); ?>
        <?php echo $form->error($profileCC,'beneficiary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'beneficiary_addres'); ?>
        <?php echo $form->textField($profileCC,'beneficiary_addres'); ?>
        <?php echo $form->error($profileCC,'beneficiary_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'account_no'); ?>
        <?php echo $form->textField($profileCC,'account_no'); ?>
        <?php echo $form->error($profileCC,'account_no'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'swift'); ?>
        <?php echo $form->textField($profileCC,'swift'); ?>
        <?php echo $form->error($profileCC,'swift'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'iban'); ?>
        <?php echo $form->textField($profileCC,'iban'); ?>
        <?php echo $form->error($profileCC,'iban'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'visa'); ?>
        <?php echo $form->checkBox($profileCC,'visa'); ?>
        <?php echo $form->error($profileCC,'visa'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'visa_percent'); ?>
        <?php echo $form->textField($profileCC,'visa_percent'); ?>
        <?php echo $form->error($profileCC,'visa_percent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'mastercard'); ?>
        <?php echo $form->checkBox($profileCC,'mastercard'); ?>
        <?php echo $form->error($profileCC,'mastercard'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'mastercard_percent'); ?>
        <?php echo $form->textField($profileCC,'mastercard_percent'); ?>
        <?php echo $form->error($profileCC,'mastercard_percent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'amex'); ?>
        <?php echo $form->checkBox($profileCC,'amex'); ?>
        <?php echo $form->error($profileCC,'amex'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'amex_percent'); ?>
        <?php echo $form->textField($profileCC,'amex_percent'); ?>
        <?php echo $form->error($profileCC,'amex_percent'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_transfer'); ?>
        <?php echo $form->checkBox($profileCC,'bank_transfer'); ?>
        <?php echo $form->error($profileCC,'bank_transfer'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'western_union'); ?>
        <?php echo $form->checkBox($profileCC,'western_union'); ?>
        <?php echo $form->error($profileCC,'western_union'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'contact'); ?>
        <?php echo $form->checkBox($profileCC,'contact'); ?>
        <?php echo $form->error($profileCC,'contact'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'others'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'others',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'others'); ?>
    </div>
<?php if($this->id=="register"){?>
    <div class="row">
        <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Backward"); ?></button></div>
        <div class="pull-right"><button title="<?php echo Yii::t("view","To go fill in all fields"); ?>" type="button" data-type="next" class="btn btn-default"><?php echo Yii::t("view","Forward"); ?></button></div>
    </div>
<?php } ?>