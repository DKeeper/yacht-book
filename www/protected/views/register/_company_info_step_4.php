<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 24.12.13
 * @time 16:09
 * Created by JetBrains PhpStorm.
 */
/* @var $this RegisterController */
/* @var $profileCC CCProfile */
/* @var $form CActiveForm */
/* @var $transitLogs CcTransitLog[] */
    echo CHtml::label(Yii::t("model","transit log"),"",array("style"=>"display:inline-block;"));
    echo CHtml::image("/i/def/plus.png","",array(
        'onclick'=>'addTransitLog()',
        'style'=>'cursor:pointer;',
        'class'=>'add_transit_log'
    ));
    foreach($transitLogs as $i=>$log){
        $this->renderPartial("_transit_log",array(
            "i"=>$i,
            "model"=>$log,
            "form"=>$form,
        ));
    }
?>
<script>
    function addTransitLog(){
        var n = $(".transit_log").last().attr("class");
        if(typeof n === "undefined"){
            n = 0;
        } else {
            n = n.split(" ");
            n = n[2].split("_");
            n = +n[1]+1;
        }
        $.ajax({
            url:'/ajax/getmodelbynum',
            data:{
                i:n,
                model:"CcTransitLog",
                view:"/register/_transit_log"
            },
            success:function(answer){
                var o =  $(".transit_log");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_transit_log").after(answer);
                }
                o = $(".transit_log");
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
</script>