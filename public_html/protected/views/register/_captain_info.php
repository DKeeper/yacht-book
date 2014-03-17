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
        <?php echo $form->textField($profileC,'name_eng',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'name_eng'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'name_rus'); ?>
        <?php echo $form->textField($profileC,'name_rus',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'name_rus'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'last_name_eng'); ?>
        <?php echo $form->textField($profileC,'last_name_eng',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'last_name_eng'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'last_name_rus'); ?>
        <?php echo $form->textField($profileC,'last_name_rus',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'last_name_rus'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'sex_id'); ?>
        <?php echo $form->dropDownList($profileC,'sex_id',$genderList,array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'sex_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'zagran_passport'); ?>
        <?php echo $form->textField($profileC,'zagran_passport',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'zagran_passport'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'expire_date'); ?>
        <?php
        $this->widget('datepicker.EDatePicker', array(
            'model' => $profileC,
            'attribute' => 'expire_date',
            'language' => Yii::app()->language,
            'options' => array(
                'dateFormat' => 'dd.mm.yy',
                'minDate' => 'y',
                'maxDate' => '+15y',
                'yearRange' => 'c:c+15',
                'changeMonth' => true,
                'changeYear' => true,
                'showOn' => 'button',
            ),
            'htmlOptions' => array(
                'class'=>'form-control',
            ),
        ));
        ?>
        <?php echo $form->error($profileC,'expire_date'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'nationality_id'); ?>
        <?php echo $form->dropDownList($profileC,'nationality_id',$nationalityList,array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'nationality_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'date_of_birth'); ?>
        <?php
        $this->widget('datepicker.EDatePicker', array(
            'model' => $profileC,
            'attribute' => 'date_of_birth',
            'language' => Yii::app()->language,
            'options' => array(
                'dateFormat' => 'dd.mm.yy',
                'minDate' => '-75y',
                'maxDate' => '-14y',
                'yearRange' => '-75:-14',
                'changeMonth' => true,
                'changeYear' => true,
                'showOn' => 'button',
            ),
            'htmlOptions' => array(
                'class'=>'form-control',
            ),
        ));
        ?>
        <?php echo $form->error($profileC,'date_of_birth'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'phone'); ?>
        <?php echo $form->textField($profileC,'phone',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'phone'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'email'); ?>
        <?php echo $form->textField($profileC,'email',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'avatar'); ?>
        <?php
            echo isset($profileC->avatar)?CHtml::tag('button',array('class'=>'btn btn-default btn-xs','data-type'=>'delImg','data-attribute'=>'CProfile_avatar','style'=>'margin:5px;'),'<span class="glyphicon glyphicon-minus"></span>'):"";
            echo CHtml::image(isset($profileC->avatar)?$profileC->avatar:'/i/def/avatar.png','',array('id'=>'CaptainAvatar','class'=>'avatar_img'));
            echo $form->hiddenField($profileC,'avatar');
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
                                $('#CProfile_avatar').val(response.link);
                                $('#CaptainAvatar').attr('src',response.link);
                                $('button[data-type=\"delImg\"]').remove();
                                $('#CaptainAvatar').before(\"<button class='btn btn-default btn-xs' data-type='delImg' data-attribute='CProfile_avatar' style='margin:5px;'><span class='glyphicon glyphicon-minus'></span></button>\");
                                $('.qq-upload-list').children().fadeOut(1000,function(){ $('.qq-upload-list').empty() });
                            }
                        }",
                        'onError'=>"js:function(id, name, errorReason){
                            $('#CProfile_avatar').val();
                            alert(errorReason);
                        }",
                    ),
                    'validation'=>array(
                        'allowedExtensions'=>array('jpg','jpeg','png','gif'),
                        'sizeLimit'=>10*1024*1024,//maximum file size in bytes
//                        'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                    ),
                ),
                'htmlOptions'=>array(
                    'id'=>'UploadCaptainAvatar',
                    'style'=>'margin-top:5px;'
                ),
            )
        );
        ?>
        <?php echo $form->error($profileC,'avatar'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'license'); ?>
        <?php echo $form->textField($profileC,'license',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'license'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'school_issued'); ?>
        <?php echo $form->textField($profileC,'school_issued',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'school_issued'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'date_issued'); ?>
        <?php
        $this->widget('datepicker.EDatePicker', array(
            'model' => $profileC,
            'attribute' => 'date_issued',
            'language' => Yii::app()->language,
            'options' => array(
                'dateFormat' => 'dd.mm.yy',
                'minDate' => 'js: new Date(1960, 0, 1)',
                'maxDate' => 'd',
                'defaultDate' => '0',
                'yearRange' => '1960:c',
                'changeMonth' => true,
                'changeYear' => true,
                'showOn' => 'button',
            ),
            'htmlOptions' => array(
                'class'=>'form-control'
            ),
        ));
        ?>
        <?php echo $form->error($profileC,'date_issued'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'scan_of_license'); ?>
        <div class="input-group">
        <?php echo $form->textField($profileC,'scan_of_license',array('class'=>'form-control','readonly'=>true)); ?>
        <span class="input-group-addon" data-type='delImg' data-attribute='CProfile_scan_of_license' style="cursor: pointer;"><span class='glyphicon glyphicon-minus'></span></span>
        </div>
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
                                $('#CProfile_scan_of_license').val(response.link);
                            }
                        }",
                        'onError'=>"js:function(id, name, errorReason){
                            $('#CcProfile_scan_of_license').val();
                            alert(errorReason);
                        }",
                    ),
                    'validation'=>array(
                        'allowedExtensions'=>array('jpg','jpeg','png','gif','pdf'),
                        'sizeLimit'=>10*1024*1024,//maximum file size in bytes
                        'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                    ),
                ),
                'htmlOptions'=>array(
                    'id'=>'UploadCaptainScanOfLicense',
                    'style'=>'margin-top:5px;'
                ),
            )
        );
        ?>
        <?php echo $form->error($profileC,'scan_of_license'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($profileC,'website'); ?>
        <?php echo $form->textField($profileC,'website',array('class'=>'form-control')); ?>
        <?php echo $form->error($profileC,'website'); ?>
    </div>
    <div class="row checkbox">
        <?php echo CHtml::openTag("label"); ?>
        <?php echo $form->checkBox($profileC,'receive_news',array('uncheckValue'=>null)); ?>
        <?php echo $profileC->getAttributeLabel("receive_news"); ?>
        <?php echo CHtml::closeTag("label"); ?>
        <?php echo $form->error($profileC,'receive_news'); ?>
    </div>
    <div class="row checkbox">
        <?php echo CHtml::openTag("label"); ?>
        <?php echo $form->checkBox($profileC,'professional_regatta',array('uncheckValue'=>null)); ?>
        <?php echo $profileC->getAttributeLabel("professional_regatta"); ?>
        <?php echo CHtml::closeTag("label"); ?>
        <?php echo $form->error($profileC,'professional_regatta'); ?>
    </div>
    <div class="row checkbox">
        <?php echo CHtml::openTag("label"); ?>
        <?php echo $form->checkBox($profileC,'amateur_regatta',array('uncheckValue'=>null)); ?>
        <?php echo $profileC->getAttributeLabel("amateur_regatta"); ?>
        <?php echo CHtml::closeTag("label"); ?>
        <?php echo $form->error($profileC,'amateur_regatta'); ?>
    </div>
<?php if($this->id=="profile"){?>
    <div class="row submit">
        <div class="pull-left"><button type="button" data-type="back" class="btn btn-default"><?php echo Yii::t("view","Prev"); ?></button></div>
    </div>
<?php } ?>
<script type="text/javascript">
    $(function(){
        $('body').on("click",'button[data-type="delImg"]',function(event){
            event.preventDefault();
            var id = $(this).attr("data-attribute");
            $("#"+id).val("");
            $(this).next().attr("src","/i/def/avatar.png");
            $(this).remove();
        });
        $('body').on("click",'span[data-type="delImg"]',function(event){
            event.preventDefault();
            var id = $(this).attr("data-attribute");
            $("#"+id).val("");
        });
    });
</script>