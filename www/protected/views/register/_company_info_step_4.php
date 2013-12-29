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
/* @var $orderOptions CcOrderOptions[] */
?>
<div class="row">
<?php
    echo CHtml::label(Yii::t("model","transit log"),"",array("style"=>"display:inline-block;"));
    echo CHtml::image("/i/def/plus.png","",array(
        'onclick'=>'addTransitLog(this)',
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
</div>
<div class="row">
    <?php
        echo CHtml::label(Yii::t("view","Options"),"",array("style"=>"display:inline-block;"));
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addOptions(this)',
            'style'=>'cursor:pointer;',
            'class'=>'add_options'
        ));
        foreach($orderOptions as $i=>$option){
            $this->renderPartial("_order_options",array(
                "i"=>$i,
                "model"=>$option,
                "form"=>$form,
            ));
        }
    ?>
</div>
<?php
$this->widget('fancyapps.EFancyApps', array(
    'mode'=>'inline',
    'id'=>'createForm',
    'config'=>array(
        'maxWidth'	=> 500,
        'maxHeight'	=> 350,
        'afterClose'=>"function(){jQuery(currentObj).effect('highlight',500);}",
    ),
    'options' => array(
        'url' => '#c',
        'label'=> '',
    ),
    'htmlOptions'=>array('class'=> "custom_create")
)
);
?>
<div style="display:none;" id="c"></div>
<script>
    function addTransitLog(o){
        var n = $(".transit_log").last().attr("class");
        if(typeof n === "undefined"){
            n = 0;
        } else {
            n = n.split(" ");
            n = n[2].split("_");
            n = +n[1]+1;
        }
        $(o).after("<img class=aL src=/i/indicator.gif />");
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
                o.parent().find(".aL").remove();
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addOptions(о){
        var n = $(".order_options").last().attr("class");
        if(typeof n === "undefined"){
            n = 0;
        } else {
            n = n.split(" ");
            n = n[2].split("_");
            n = +n[1]+1;
        }
        $(о).after("<img class=aL src=/i/indicator.gif />");
        $.ajax({
            url:'/ajax/getmodelbynum',
            data:{
                i:n,
                model:"CcOrderOptions",
                view:"/register/_order_options"
            },
            success:function(answer){
                var o =  $(".order_options");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_options").after(answer);
                }
                o = $(".order_options");
                o.parent().find(".aL").remove();
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function createOptions(o){
        if($(o).val()=="0"){
            createAddForm("#c","order_options",o,function(){
                    $.getJSON(
                        "<?php echo $this->createUrl('ajax/autocomplete'); ?>",
                        {
                            term: "",
                            modelClass: "OrderOptions",
                            sql: false
                        },
                        function(data){
                            $.each($("select[name^='CcOrderOptions']"),function(){
                                var v = $(this).val();
                                var out = "<option value=''><?php echo Yii::t("view","Select options"); ?></option>";
                                $.each(data,function(){
                                    var selected = "";
                                    if(this.id == v){
                                        selected = " selected";
                                    }
                                    out += "<option value='"+this.id+"'"+selected+">"+this.label+"</option>";
                                });
                                $(this).empty().append(out);
                            });
                        });
            });
            $(".custom_create").click();
            return false;
        }
    }
</script>