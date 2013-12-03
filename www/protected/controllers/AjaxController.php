<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 02.12.13
 * @time 17:19
 * Created by JetBrains PhpStorm.
 */
class AjaxController extends Controller
{
    public function filters()
    {
        return array(
            'rights',
        );
    }

    public function allowedActions(){
        return 'autocomplete';
    }

    public function actionAutocomplete(){
        $term = Yii::app()->getRequest()->getParam('term');
        $modelClass = Yii::app()->getRequest()->getParam('modelClass');
        $model = BaseModel::model($modelClass);
        if(Yii::app()->request->isAjaxRequest && $term && $model) {
            $field = Yii::app()->getRequest()->getParam('field');
            $objects = $model->findAll(array('condition'=>"name LIKE '%$term%'"));
            $result = array();
            foreach($objects as $obj) {
                $label = $obj->name;
                if(isset($field)){
                    foreach($field as $fName => $fValue){
                        if(isset($obj->$fName)){
                            $label .= " - ".$obj->$fName->$fValue;
                        }
                    }
                }
                $result[] = array('id'=>$obj->id, 'label'=>$label, 'value'=>$label);
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }
}
