<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.01.14
 * @time 10:09
 * Created by JetBrains PhpStorm.
 */
/* @var $this FleetsController */
/* @var $profile SyProfile */
/* @var $form CActiveForm */
/* @var $yachtFoto array */
?>
    <div class="row panel panel-default">
        <div class="panel-heading"><?php echo Yii::t("view","Pls attach the real photo of this yacht (obligatory)"); ?></div>
        <div id="gallery" class="panel-body gallery">
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($yachtFoto[1],"[1]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($yachtFoto[1],"[1]type",array("value"=>1)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","stem (with name of boat)")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($yachtFoto[2],"[2]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($yachtFoto[2],"[2]type",array("value"=>2)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","starboard")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($yachtFoto[3],"[3]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($yachtFoto[3],"[3]type",array("value"=>3)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","portside")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($yachtFoto[4],"[4]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($yachtFoto[4],"[4]type",array("value"=>4)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","cockpit")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <?php
                foreach($yachtFoto[5] as $i => $foto){
            ?>
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($foto,"[5][$i]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($foto,"[5][$i]type",array("value"=>5)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","interior (state-room)")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <?php
                }
            ?>
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($yachtFoto[7][0],"[7][0]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($yachtFoto[7][0],"[7][0]type",array("value"=>7)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","layout")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <?php
            foreach($yachtFoto[6] as $i => $foto){
                ?>
                <div class="col-md-3 cell ui-widget-content">
                    <?php echo $form->hiddenField($foto,"[6][$i]link",array('class'=>'link')); ?>
                    <?php echo $form->hiddenField($foto,"[6][$i]type",array("value"=>6)); ?>
                    <h5 class="ui-widget-header"><?php echo Yii::t("view","the photos of cabins")?></h5>
                    <span class="glyphicon glyphicon-picture"></span>
                </div>
                <?php
            }
            ?>
            <div class="col-md-3 cell ui-widget-content">
                <?php echo $form->hiddenField($yachtFoto[7][1],"[7][1]link",array('class'=>'link')); ?>
                <?php echo $form->hiddenField($yachtFoto[7][1],"[7][1]type",array("value"=>7)); ?>
                <h5 class="ui-widget-header"><?php echo Yii::t("view","layout")?></h5>
                <span class="glyphicon glyphicon-picture"></span>
            </div>
            <?php
            foreach($yachtFoto[8] as $i => $foto){
                ?>
                <div class="col-md-3 cell ui-widget-content">
                    <?php echo $form->hiddenField($foto,"[8][$i]link",array('class'=>'link')); ?>
                    <?php echo $form->hiddenField($foto,"[8][$i]type",array("value"=>8)); ?>
                    <h5 class="ui-widget-header"><?php echo Yii::t("view","particular photo (optional)")?></h5>
                    <span class="glyphicon glyphicon-picture"></span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="row panel panel-default">
        <div class="panel-heading"><?php echo Yii::t("view","Preview uploaded images"); ?></div>
        <div class="panel-body upload_preview">
            <ul id="upload_preview"></ul>
        </div>
    </div>
    <div class="row">
        <?php
        $this->widget('fileuploader.EFineUploader',
            array(
                'config'=>array(
                    'multiple'=>true,
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
                                $('.qq-upload-list').children('.qq-upload-success').fadeOut(1000,function(){ $(this).remove() });
                                var wrapper = $('<li>').appendTo($('#upload_preview')).addClass('pull-left images');
                                $('<img>').appendTo(wrapper).attr('src',response.link).addClass('img-thumbnail');
                                refreshUploadPreview($('#upload_preview li'));
                            }
                        }",
                        'onError'=>"js:function(id, name, errorReason){
                            alert(errorReason);
                        }",
                    ),
                    'validation'=>array(
                        'allowedExtensions'=>array('jpg','jpeg','png','gif'),
                        'sizeLimit'=>10*1024*1024,//maximum file size in bytes
                        'minSizeLimit'=>0.5*1024*1024,// minimum file size in bytes
                    ),
                ),
                'htmlOptions'=>array(
                    'id'=>'UploadYachtPhoto',
                ),
            )
        );
        ?>
    </div>
<script>
    function refreshUploadPreview($o){
        $o.draggable({
            revert: "invalid",
            cursor: "move",
            helper: "clone",
            containment: "document"
        });
    }
    function addImage(o, $item, mode){
        var $o = $(o);
        var $copy = $item.clone().toggleClass('pull-left');
        $item.fadeOut(function() {
            switch(mode){
                case 'gallery':
                    var link = $item.find("img").attr("src");
                    $o.find(".link").val(link);
                    $item.remove();
                    $o.find("span.glyphicon").remove();
                    $copy.appendTo($o);
                    refreshUploadPreview($(".gallery li"));
                    break;
                case 'preview':
                    $item.parents(".cell").append('<span class="glyphicon glyphicon-picture"></span>');
                    $item.parents(".cell").find(".link").val("");
                    $item.remove();
                    $copy.appendTo($o.find('ul'));
                    refreshUploadPreview($("#upload_preview li"));
                    break;
            }
        });
    }
    $(function(){
        $(".cell").droppable({
            accept: "#upload_preview > li",
            drop: function(event,ui){
                if($(event.target).find("li").length==0){
                    addImage(event.target, ui.draggable,'gallery');
                } else {
                    return false;
                }
            }
        });
        $(".upload_preview").droppable({
            accept: ".cell li",
            drop: function(event,ui){
                addImage(event.target, ui.draggable,'preview');
            }
        });
    });
</script>