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
        return 'autocomplete, icreate, getcityll, getmodelbynum';
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
            $sql = Yii::app()->getRequest()->getParam('sql') ? Yii::app()->getRequest()->getParam('sql') : true;
            if(is_string($sql)){
                if($sql==="true"){
                    $sql = true;
                } else {
                    $sql = false;
                }
            }
            $parentID = Yii::app()->getRequest()->getParam('parent_id');
            $parentProp = Yii::app()->getRequest()->getParam('parent_link');
            $parentModel = Yii::app()->getRequest()->getParam('parent_model');

            if($sql){
                $command = Yii::app()->db->createCommand();
                $f = array('g.id as g_id');
                if(is_array($fieldName)){
                    $o = array();
                    foreach($fieldName as $i => $v){
                        $fieldName[$i] = "g.".$v." as g_".$v;
                        $o[] = "g_".$v;
                    }
                    $f = array_merge($f,$fieldName);
                    $o = implode(',',$o);
                } else {
                    array_push($f,"g.".$fieldName." as g_".$fieldName);
                    $o = "g_".$fieldName;
                }
                $f[] = 'r.nazvanie_1 as r_nazvanie_1';
                $f[] = 'r.nazvanie_2 as r_nazvanie_2';
                $command->select($f)
                    ->from($model->tableName().' as g');
                if($parentID && $parentProp){
                    $command->where($parentProp.'=:v',array(':v'=>$parentID));
                }
                $command->andWhere('g.region_id > 0')
                    ->join(Region::model()->tableName().' as r','r.id = g.region_id');
                $command->order($o);
                $objects = $command->queryAll();
            } else {
                $criteria = new CDbCriteria();
                $criteria->addSearchCondition($fieldName,$term);
                if($parentID && $parentProp){
                    $criteria->addCondition($parentProp.'=:v');
                    $criteria->params += array(':v'=>$parentID);
                }
                $criteria->order = $fieldName;
                $objects = $model->findAll($criteria);
            }

            if($createInclude){
                $result = array(array('id'=>0, 'label'=>Yii::t('view','Create'), 'value'=>Yii::t('view','Create')));
            } else {
                $result = array();
            }

            foreach($objects as $obj) {
                if(is_array($fieldName)){
                    foreach(Yii::app()->getRequest()->getParam('fName') as $cF){
                        if(empty($obj["g_".$cF])){
                            continue;
                        }
                        $label = $obj["g_".$cF];
                        if($parentProp && $parentModel){
                            $label .= " (".$obj['r_'.$cF].")";
                        }
                        break;
                    }
                } else {
                    $label = $obj[$fieldName];
                }
                if(isset($field)){
                    foreach($field as $fName => $fValue){
                        if(isset($obj[$fName])){
                            $label .= " (".$obj[$fName]->$fValue.")";
                        }
                    }
                }
                $id = isset($obj['id'])?$obj['id']:$obj['g_id'];
                if($parentProp && $parentModel && $parentInclude){
                    $result[] = array('id'=>$id, 'label'=>$label, 'value'=>$label, 'parent_id'=>$obj[$parentProp], 'parent_name'=>$obj[$parentModel]->name);
                } else {
                    $result[] = array('id'=>$id, 'label'=>$label, 'value'=>$label);
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

    public function actionGetcityll(){
        if(Yii::app()->request->isAjaxRequest){
            $id = Yii::app()->request->getPost('id');
            /** @var $model Gorod */
            $model = Gorod::model()->findByPk($id);
            if(isset($model)){
                $data = array('latitude'=>$model->shirota,'longitude'=>$model->dolgota);
            } else {
                $error = "Некорректный ID";
            }
        } else {
            $error = "Некорректный запрос";
        }
        if(isset($data)){
            echo CJavaScript::jsonEncode(array('success'=>true,'data'=>$data));
        } else {
            echo CJavaScript::jsonEncode(array('success'=>false,'data'=>$error));
        }
        Yii::app()->end();
    }

    public function actionGetmodelbynum(){
        if(Yii::app()->request->isAjaxRequest){
            $i = Yii::app()->request->getPost("i");
            $model = Yii::app()->request->getPost("model");
            $view = Yii::app()->request->getPost("view");
            $form = new CActiveForm;
            $form->enableAjaxValidation = true;
            $this->renderPartial($view,array(
                "i"=>$i,
                "model"=>new $model,
                "form"=>$form
            ));
        }
    }
}
