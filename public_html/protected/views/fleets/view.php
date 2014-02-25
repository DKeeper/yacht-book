<?php
/* @var $this FleetsController */
/* @var $model CcFleets */

$this->breadcrumbs=array(
	'Cc Fleets'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>Yii::t('view','List'), 'url'=>array('index')),
    array('label'=>Yii::t('view','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('view','Update'), 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>Yii::t('view','Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>Yii::t('view','Manage'), 'url'=>array('admin')),
);
Yii::app()->clientScript->registerCoreScript('yiiactiveform');
?>
<div class="row">
    <div class="row view_danger text-danger text-center" style="display: none;">
        <h1>
        <?php
        echo Yii::t("view","!!! WARNING !!! - yacht is not available<br/>for search by customers if incorrectly entered data <span class='glyphicon glyphicon-question-sign'></span>")
        ?>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h1><?php echo !empty($model->profile->name)?$model->profile->name:Yii::t("view","No name"); ?></h1>
        </div>
        <div class="col-md-4 view_danger text-center" style="display: none;">
            <button type="button" class="btn btn-link change_data_btn"><?php echo Yii::t("view","cnahge data")?></button>
        </div>
    </div>
</div>

<?php
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        Yii::t("model","Details")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_detail',
                array('profile'=>$model->profile,'yachtFoto'=>$model->yachtPhotos(array('condition'=>'type = :tid','params'=>array(':tid'=>7),'limit'=>1))),
                true
            ),
            'id'=>'tab1'
        ),
        Yii::t("model","Photo")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_photo',
                array('profile'=>$model->profile,'yachtFoto'=>$model->yachtPhotos),
                true
            ),
            'id'=>'tab2'
        ),
        Yii::t("model","Price")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_price',
                array('profile'=>$model->profile,'priceCurrYear'=>$model->priceCurrentYears,'priceNextYear'=>$model->priceNextYears),
                true
            ),
            'id'=>'tab3'
        ),
        Yii::t("model","Orders")=>array(
            'content'=>$this->renderPartial(
                '_view_fleets_orders',
                array('profile'=>$model->profile),
                true
            ),
            'id'=>'tab4'
        ),
    ),
    // additional javascript options for the tabs plugin
    'htmlOptions'=>array(
        'id'=>'fleets_tabs',
    ),
));
?>
<script>
    $(function(){
        $("div.text-danger").on("click",function(){
            $(this).children('div').hide();
            $(this).children('div.form').show();
        });
        if(!<?php echo $this->validate?"true":"false"; ?>){
            $(".view_danger").show();
        }
        $(".change_data_btn").on("click",function(){
            $('div.text-danger').click()
        });
    });
    function changeTitle(form, attribute, data, hasError){
        if(hasError){
            var oldTitle = form.parents('.text-danger').attr('data-original-title');
            var err = data[attribute.id];
            err = err.join('&lt;br/&gt;');
            form.parents('.text-danger').attr('data-original-title',err);
            if(typeof form.parents('.text-danger').attr('data-original-title-old') != 'string'){
                form.parents('.text-danger').attr('data-original-title-old',oldTitle);
            }
        } else {
            if(typeof form.parents('.text-danger').attr('data-original-title-old') == 'string' && form.parents('.text-danger').attr('data-original-title-old') != ''){
                form.parents('.text-danger').attr('data-original-title',form.parents('.text-danger').attr('data-original-title-old'));
                form.parents('.text-danger').attr('data-original-title-old','')
            }
        }
    }
</script>
