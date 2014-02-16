<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 10:07
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileM MProfile */
/* @var $form CActiveForm */
?>
<?php echo $form->hiddenField($profileM,'m_id'); ?>
<?php echo $form->hiddenField($profileM,'cc_id'); ?>

<div class="row">
    <?php echo $form->labelEx($profileM,'phone'); ?>
    <?php echo $form->textField($profileM,'phone',array('class'=>'form-control')); ?>
    <?php echo $form->error($profileM,'phone'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($profileM,'avatar'); ?>
    <?php
        echo CHtml::image(isset($profileM->avatar)?$profileM->avatar:'/i/def/avatar.png','',array('id'=>'ManagerAvatar','class'=>'avatar_img'));
        echo $form->hiddenField($profileM,'avatar');
    ?>
    <?php
    $this->widget('fileuploader.EFineUploader',
        array(
            'config'=>array(
                'autoUpload'=>true,
                'request'=>array(
                    'endpoint'=>'/ajax/upload',// OR $this->createUrl('files/upload'),
                    'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                ),
                'retry'=>array(
                    'enableAuto'=>false,
                    'preventRetryResponseProperty'=>true
                ),
                'chunking'=>array(
                    'enable'=>true,
                    'partSize'=>100
                ),//bytes
                'callbacks'=>array(
                    'onComplete'=>"js:function(id, name, response){
                            if(response.success){
                                $('#MProfile_avatar').val(response.link);
                                $('#ManagerAvatar').attr('src',response.link);
                                $('.qq-upload-list').children().fadeOut(1000,function(){ $('.qq-upload-list').empty() });
                            }
                        }",
                    'onError'=>"js:function(id, name, errorReason){
                            $('#MProfile_avatar').val();
                            alert(errorReason);
                        }",
                ),
                'validation'=>array(
                    'allowedExtensions'=>array('jpg','jpeg','png','gif'),
                    'sizeLimit'=>10*1024*1024,//maximum file size in bytes
//                    'minSizeLimit'=>1*1024*1024,// minimum file size in bytes
                ),
            ),
            'htmlOptions'=>array(
                'id'=>'UploadManagerAvatar',
                'style'=>'margin-top:5px;'
            ),
        )
    );
    ?>
    <?php echo $form->error($profileM,'avatar'); ?>
</div>
<?php if($this->id=="register"){?>
<div class="row submit">
    <button data-type="submit" class="btn btn-default"><?php echo UserModule::t("Register"); ?></button>
</div>
<?php } ?>