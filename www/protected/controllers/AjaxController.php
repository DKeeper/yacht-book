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
        return 'autocomplete, icreate';
    }

    public function actionAutocomplete(){
        $term = Yii::app()->getRequest()->getParam('term');
        $modelClass = Yii::app()->getRequest()->getParam('modelClass');
        $model = BaseModel::model($modelClass);
        if(Yii::app()->request->isAjaxRequest && $model) {
            $field = Yii::app()->getRequest()->getParam('field');
            $fieldName = Yii::app()->getRequest()->getParam('fName');
            $fieldName = $fieldName ? $fieldName : 'name';
            $parentInclude = Yii::app()->getRequest()->getParam('parent_include') ? Yii::app()->getRequest()->getParam('parent_include') : true;
            if(is_string($parentInclude)){
                if($parentInclude==="true"){
                    $parentInclude = true;
                } else {
                    $parentInclude = false;
                }
            }
            $createInclude = Yii::app()->getRequest()->getParam('create_include') ? Yii::app()->getRequest()->getParam('create_include') : true;
            if(is_string($createInclude)){
                if($createInclude==="true"){
                    $createInclude = true;
                } else {
                    $createInclude = false;
                }
            }
            $criteria = new CDbCriteria();
            $criteria->addSearchCondition($fieldName,$term);
            $parentID = Yii::app()->getRequest()->getParam('parent_id');
            $parentProp = Yii::app()->getRequest()->getParam('parent_link');
            $parentModel = Yii::app()->getRequest()->getParam('parent_model');
            if($parentID && $parentProp){
                $criteria->addCondition($parentProp.'=:v');
                $criteria->params += array(':v'=>$parentID);
            }
            $criteria->order = $fieldName;
            $objects = $model->findAll($criteria);
            if($createInclude){
                $result = array(array('id'=>0, 'label'=>Yii::t('view','Create'), 'value'=>Yii::t('view','Create')));
            } else {
                $result = array();
            }
            foreach($objects as $obj) {
                $label = $obj->$fieldName;
                if(isset($field)){
                    foreach($field as $fName => $fValue){
                        if(isset($obj->$fName)){
                            $label .= " (".$obj->$fName->$fValue.")";
                        }
                    }
                }
                if($parentProp && $parentModel && $parentInclude){
                    $result[] = array('id'=>$obj->id, 'label'=>$label, 'value'=>$label, 'parent_id'=>$obj->$parentProp, 'parent_name'=>$obj->$parentModel->name);
                } else {
                    $result[] = array('id'=>$obj->id, 'label'=>$label, 'value'=>$label);
                }
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }

    public function actionIcreate(){
        if(Yii::app()->request->isAjaxRequest){
            $ajaxModel = Yii::app()->getRequest()->getParam('ajaxModel');
            $ajaxView = Yii::app()->getRequest()->getParam('ajaxView');
            if($ajaxModel && $ajaxView){
                $view = $ajaxView;
                $modelClass = $ajaxModel;
                /** @var $model BaseModel */
                $model = new $modelClass;
                if(isset($_POST['ajax'])) {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                } else {
                    $model->attributes=$_POST[$modelClass];
			        if($model->save()){
                        echo "create done";
                        Yii::app()->end();
                    }
                }
            } else {
                $view = Yii::app()->getRequest()->getParam('view');
                $modelClass = Yii::app()->getRequest()->getParam('model');
                $parentID = Yii::app()->getRequest()->getParam('pId');
                $parentLink = Yii::app()->getRequest()->getParam('pLink');
                /** @var $model BaseModel */
                $model = new $modelClass;
                if($parentID && $parentLink){
                    $model->$parentLink = $parentID;
                }
            }
            $this->renderPartial('/'.strtolower($modelClass).'/'.$view,array('model'=>$model,'ajax'=>true));
        }
    }
}
