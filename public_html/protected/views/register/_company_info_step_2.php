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
        <?php echo $form->textField($profileCC,'vat',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'vat'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_name'); ?>
        <?php echo $form->textField($profileCC,'bank_name',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'bank_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'bank_addres'); ?>
        <?php echo $form->textField($profileCC,'bank_addres',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'bank_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'beneficiary'); ?>
        <?php echo $form->textField($profileCC,'beneficiary',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'beneficiary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'beneficiary_addres'); ?>
        <?php echo $form->textField($profileCC,'beneficiary_addres',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'beneficiary_addres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'account_no'); ?>
        <?php echo $form->textField($profileCC,'account_no',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'account_no'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'swift'); ?>
        <?php echo $form->textField($profileCC,'swift',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'swift'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'iban'); ?>
        <?php echo $form->textField($profileCC,'iban',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileCC,'iban'); ?>
    </div>

    <div class="row">
        <h4><?php echo Yii::t("view","We are accept for payment:"); ?></h4>
    </div>

    <div class="row">
    <div class="col-md-2">
        <div class="row checkbox">
        <?php echo CHtml::openTag("label"); ?>
        <?php echo $form->checkBox($profileCC,'visa'); ?>
        <?php echo $profileCC->getAttributeLabel("visa"); ?>
        <?php echo CHtml::closeTag("label"); ?>
        </div>
        <?php echo $form->error($profileCC,'visa'); ?>
    </div>
    <div class="col-md-2">
        <div class="input-group">
        <?php echo $form->textField($profileCC,'visa_percent',array('class'=>'form-control')); ?>
        <span class="input-group-addon">%</span>
        </div>
        <?php echo $form->error($profileCC,'visa_percent'); ?>
    </div>

    <div class="col-md-2">
        <div class="row checkbox">
            <?php echo CHtml::openTag("label"); ?>
            <?php echo $form->checkBox($profileCC,'mastercard'); ?>
            <?php echo $profileCC->getAttributeLabel("mastercard"); ?>
            <?php echo CHtml::closeTag("label"); ?>
        </div>
        <?php echo $form->error($profileCC,'mastercard'); ?>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <?php echo $form->textField($profileCC,'mastercard_percent',array('class'=>'form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
        <?php echo $form->error($profileCC,'mastercard_percent'); ?>
    </div>

    <div class="col-md-2">
        <div class="row checkbox">
            <?php echo CHtml::openTag("label"); ?>
            <?php echo $form->checkBox($profileCC,'amex'); ?>
            <?php echo $profileCC->getAttributeLabel("amex"); ?>
            <?php echo CHtml::closeTag("label"); ?>
        </div>
        <?php echo $form->error($profileCC,'amex'); ?>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <?php echo $form->textField($profileCC,'amex_percent',array('class'=>'form-control')); ?>
            <span class="input-group-addon">%</span>
        </div>
        <?php echo $form->error($profileCC,'amex_percent'); ?>
    </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="row checkbox">
                <?php echo CHtml::openTag("label"); ?>
                <?php echo $form->checkBox($profileCC,'bank_transfer'); ?>
                <?php echo $profileCC->getAttributeLabel("bank_transfer"); ?>
                <?php echo CHtml::closeTag("label"); ?>
            </div>
            <?php echo $form->error($profileCC,'bank_transfer'); ?>
        </div>
        <div class="col-md-4">
            <div class="row checkbox">
                <?php echo CHtml::openTag("label"); ?>
                <?php echo $form->checkBox($profileCC,'western_union'); ?>
                <?php echo $profileCC->getAttributeLabel("western_union"); ?>
                <?php echo CHtml::closeTag("label"); ?>
            </div>
            <?php echo $form->error($profileCC,'western_union'); ?>
        </div>
        <div class="col-md-4">
            <div class="row checkbox">
                <?php echo CHtml::openTag("label"); ?>
                <?php echo $form->checkBox($profileCC,'contact'); ?>
                <?php echo $profileCC->getAttributeLabel("contact"); ?>
                <?php echo CHtml::closeTag("label"); ?>
            </div>
            <?php echo $form->error($profileCC,'contact'); ?>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'others'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'others',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(),
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