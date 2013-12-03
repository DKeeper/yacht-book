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
        if(Yii::app()->request->isAjaxRequest && $model) {
            $field = Yii::app()->getRequest()->getParam('field');
            $criteria = new CDbCriteria();
            $criteria->addSearchCondition('name',$term);
            $parentID = Yii::app()->getRequest()->getParam('parent_id');
            $parentProp = Yii::app()->getRequest()->getParam('parent_link');
            $parentModel = Yii::app()->getRequest()->getParam('parent_model');
            if($parentID && $parentProp){
                $criteria->addCondition($parentProp.'=:v');
                $criteria->params += array(':v'=>$parentID);
            }
            $objects = $model->findAll($criteria);
            $result = array();
            foreach($objects as $obj) {
                $label = $obj->name;
                if(isset($field)){
                    foreach($field as $fName => $fValue){
                        if(isset($obj->$fName)){
                            $label .= " (".$obj->$fName->$fValue.")";
                        }
                    }
                }
                if($parentProp && $parentModel){
                    $result[] = array('id'=>$obj->id, 'label'=>$label, 'value'=>$label, 'parent_id'=>$obj->$parentProp, 'parent_name'=>$obj->$parentModel->name);
                } else {
                    $result[] = array('id'=>$obj->id, 'label'=>$label, 'value'=>$label);
                }
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }
}
