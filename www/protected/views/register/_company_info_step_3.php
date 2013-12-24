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
        echo CHtml::label(Yii::t("view","Payment period - [%][before][type]"),"");
        foreach($paymentsPeriods as $i=>$period){
            $this->renderPartial("_payment_period",array(
                "i"=>$i,
                "period"=>$period,
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
    function addPaymentPeriod(){
        var n = $(".payment_period").last().attr("class");
        n = n.split(" ");
        n = n[2].split("_");
        n = +n[1]+1;
        $.ajax({
            url:'/ajax/getpaymentperiod',
            data:{i:n},
            success:function(answer){
                $(".payment_period").last().after(answer);
                $(".payment_period").last().find('div').addClass("errorMessage");
                $.fn.yiiactiveform.addFields($(".payment_period").parents('form'), $(".payment_period").last().find('input, select'));
            },
            type:'POST',
            dataType:'html',
            async:true
        });
    }
    function delPaymentPeriod(o){
        var n = $(o).parent().remove();
    }
</script>