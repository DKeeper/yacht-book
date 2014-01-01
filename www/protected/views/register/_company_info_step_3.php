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
/* @var $paymentsPeriods CcPaymentsPeriod[] */
/* @var $cancelPeriods CcCancelPeriod[] */
/* @var $longPeriods CcLongPeriod[] */
/* @var $earlyPeriods CcEarlyPeriod[] */
?>
    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkin_day'); ?>
        <?php echo $form->textField($profileCC,'checkin_day'); ?>
        <?php echo $form->error($profileCC,'checkin_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkin_hour'); ?>
        <?php echo $form->textField($profileCC,'checkin_hour'); ?>
        <?php echo $form->error($profileCC,'checkin_hour'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkout_day'); ?>
        <?php echo $form->textField($profileCC,'checkout_day'); ?>
        <?php echo $form->error($profileCC,'checkout_day'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'checkout_hour'); ?>
        <?php echo $form->textField($profileCC,'checkout_hour'); ?>
        <?php echo $form->error($profileCC,'checkout_hour'); ?>
    </div>

    <?php
        echo CHtml::label(Yii::t("view","Payment period - [%][before][type]"),"",array("style"=>"display:inline-block;"));
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addPaymentPeriod(this)',
            'style'=>'cursor:pointer;',
            'class'=>'add_payment'
        ));
        foreach($paymentsPeriods as $i=>$period){
            $this->renderPartial("/register/_payment_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
    ?>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'payment_other'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'payment_other',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'payment_other'); ?>
    </div>

    <?php
        echo CHtml::label(Yii::t("view","Cancel period - [%][before][type]"),"",array("style"=>"display:inline-block;"));
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addCancelPeriod(this)',
            'style'=>'cursor:pointer;',
            'class'=>'add_cancel'
        ));
        foreach($cancelPeriods as $i=>$period){
            $this->renderPartial("/register/_cancel_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
    ?>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'cancel_other'); ?>
        <?php
        $this->widget('ckeditor.CKEditor', array(
            'model'=>$profileCC,
            'attribute'=>'cancel_other',
            'config'=> array(
                'height' => 100,
                'toolbar' => array(
                    array('Bold','Italic','Underline'),
                ),
            ),
        ));
        ?>
        <?php echo $form->error($profileCC,'cancel_other'); ?>
    </div>

    <?php
        echo CHtml::label(Yii::t("view","Long period - [%][value][type]"),"",array("style"=>"display:inline-block;"));
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addLongPeriod(this)',
            'style'=>'cursor:pointer;',
            'class'=>'add_long'
        ));
        foreach($longPeriods as $i=>$period){
            $this->renderPartial("/register/_long_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
    ?>
    <div class="row"></div>
    <?php
        echo CHtml::label(Yii::t("view","Early period - [%][before][type]"),"",array("style"=>"display:inline-block;"));
        echo CHtml::image("/i/def/plus.png","",array(
            'onclick'=>'addEarlyPeriod(this)',
            'style'=>'cursor:pointer;',
            'class'=>'add_early'
        ));
        foreach($earlyPeriods as $i=>$period){
            $this->renderPartial("/register/_early_period",array(
                "i"=>$i,
                "model"=>$period,
                "form"=>$form,
            ));
        }
    ?>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'repeater_discount'); ?>
        <?php echo $form->textField($profileCC,'repeater_discount'); ?>
        <?php echo $form->error($profileCC,'repeater_discount'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profileCC,'max_discount'); ?>
        <?php echo $form->textField($profileCC,'max_discount'); ?>
        <?php echo $form->error($profileCC,'max_discount'); ?>
    </div>
<script>
    function addPaymentPeriod(o){
        var n = $(".payment_period").last().attr("class");
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
                model:"CcPaymentsPeriod",
                view:"/register/_payment_period"
            },
            success:function(answer){
                var o =  $(".payment_period");
                $(".aL").remove();
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_payment").after(answer);
                }
                o = $(".payment_period");
                o.parent().find(".aL").remove();
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addCancelPeriod(o){
        var n = $(".cancel_period").last().attr("class");
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
                model:"CcCancelPeriod",
                view:"/register/_cancel_period"
            },
            success:function(answer){
                var o = $(".cancel_period");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_cancel").after(answer);
                }
                o = $(".cancel_period");
                o.parent().find(".aL").remove();
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addLongPeriod(o){
        var n = $(".long_period").last().attr("class");
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
                model:"CcLongPeriod",
                view:"/register/_long_period"
            },
            success:function(answer){
                var o = $(".long_period");
                $(".aL").remove();
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_long").after(answer);
                }
                o = $(".long_period");
                o.parent().find(".aL").remove();
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function addEarlyPeriod(o){
        var n = $(".early_period").last().attr("class");
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
                model:"CcEarlyPeriod",
                view:"/register/_early_period"
            },
            success:function(answer){
                var o = $(".early_period");
                if(o.length != 0){
                    o.last().after(answer);
                } else {
                    $(".add_early").after(answer);
                }
                o = $(".early_period");
                o.parent().find(".aL").remove();
                o.last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields(o.parents('form'), o.last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function delRow(o){
        var n = $(o).parent().remove();
    }
</script>