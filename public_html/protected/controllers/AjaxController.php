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
        return 'autocomplete, icreate, getcityll, getmodelbynum, findgeoobject, upload';
    }

    public function actionMapsearch(){
        if(Yii::app()->request->isAjaxRequest){
            $filterData = Yii::app()->request->getPost('Search');
            $command = Yii::app()->db->createCommand();
            $command
                ->select('f.id as fid, f.cc_id as cid, pr.id as prid, pr.latitude, pr.longitude')
                ->from('cc_fleets as f')
                ->join('sy_profile as p','p.id = f.profile_id')
                ->leftJoin('price_current_year as pr','pr.yacht_id = f.id')
                ->andWhere('p.length_m >= :l_min',array(':l_min'=>$filterData['length']['min']))
                ->andWhere('p.length_m <= :l_max',array(':l_max'=>$filterData['length']['max']))
                ->andWhere('p.built_date BETWEEN :d_min AND :d_max',array(':d_min'=>$filterData['year']['min'].'-01-01',':d_max'=>$filterData['year']['max'].'-01-01'))
                ->andWhere('pr.price >= :pr_min',array(':pr_min'=>$filterData['price']['min']))
                ->andWhere('pr.price <= :pr_max',array(':pr_max'=>$filterData['price']['max']))
                ->andWhere('f.isActive=1');
            if(!empty($filterData['type_id'])){
                $command->andWhere('p.type_id = :tid',array(':tid'=>$filterData['type_id']));
            }
            if(!empty($filterData['shipyard_id'])){
                $command->andWhere('p.shipyard_id = :shid',array(':shid'=>$filterData['shipyard_id']));
            }
            if(!empty($filterData['model_id'])){
                $command->andWhere('p.model_id = :mid',array(':mid'=>$filterData['model_id']));
            }
            /** @var $fleets array|null */
            $fleets = $command->queryAll();
            $data = array(
                'count'=>count($fleets),
                'fleets'=>$fleets,
            );
        }
        if(isset($data)){
            echo CJavaScript::jsonEncode(array('success'=>true,'data'=>$data));
        } else {
            echo CJavaScript::jsonEncode(array('success'=>false,'data'=>$error));
        }
        Yii::app()->end();
    }

    public function actionRm($uid){
        $model = User::model()->findByPk($uid);
        if(isset($model)){
            $model->delete();
            echo CJavaScript::jsonEncode(array('success'=>true));
        } else {
            echo CJavaScript::jsonEncode(array('success'=>false,'data'=>Yii::t("view","No data for {ext}",array('{ext}'=>$uid))));
        }
        Yii::app()->end();
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
                if($modelClass=="Gorod"){
                    $f[] = 'r.nazvanie_1 as r_nazvanie_1';
                    $f[] = 'r.nazvanie_2 as r_nazvanie_2';
                }
                $command->select($f)
                    ->from($model->tableName().' as g');
                if($parentID && $parentProp){
                    $command->where($parentProp.'=:v',array(':v'=>$parentID));
                }
                if($modelClass=="Gorod"){
                    $command->andWhere('g.region_id > 0')
                        ->join(Region::model()->tableName().' as r','r.id = g.region_id');
                }
                $command->order($o);
                $objects = $command->queryAll();
            } else {
                $criteria = new CDbCriteria();
                if(is_array($fieldName)){
                    foreach($fieldName as $f){
                        $criteria->addSearchCondition($f,$term,true,'OR');
                    }
                    $criteria->order = $fieldName[0];
                } else {
                    $criteria->addSearchCondition($fieldName,$term);
                    $criteria->order = $fieldName;
                }
                if($parentID && $parentProp){
                    $criteria->addCondition($parentProp.'=:v');
                    $criteria->params += array(':v'=>$parentID);
                }
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
                        $label = Yii::t("view",$obj["g_".$cF]);
                        if($parentProp && $parentModel){
                            $label .= " (".Yii::t("view",$obj['r_'.$cF]).")";
                        }
                        break;
                    }
                    if(!isset($label)){
                        $label = Yii::t("view",$obj[$fieldName[0]]);
                    }
                } else {
                    $label = Yii::t("view",$obj[$fieldName]);
                }
                if(isset($field)){
                    foreach($field as $fName => $fValue){
                        if(isset($obj[$fName])){
                            $label .= " (".Yii::t("view",$obj[$fName]->$fValue).")";
                        }
                    }
                }
                $id = isset($obj['id'])?$obj['id']:$obj['g_id'];
                if($parentProp && $parentModel && $parentInclude){
                    $result[] = array('id'=>$id, 'label'=>$label, 'value'=>$label, 'parent_id'=>$obj[$parentProp], 'parent_name'=>$obj[$parentModel]->name);
                } else {
                    $result[] = array('id'=>$id, 'label'=>$label, 'value'=>$label);
                }
                unset($label);
            }

            if(empty($result)){
                $result[] = array('id','label'=>Yii::t("view","No results"),'value'=>Yii::t("view","No results"));
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
                        $data = array('addId'=>$model->id);
                        echo CJavaScript::jsonEncode(array('success'=>true,'data'=>$data));
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
                "form"=>$form,
                "ajax"=>true
            ));
        }
    }

    public function actionFindgeoobject(){
        if(Yii::app()->request->isAjaxRequest){
            $t = Yii::app()->request->getPost("type");
            $v = Yii::app()->request->getPost("value");
            $f = Yii::app()->request->getPost("field");
            $parent_link = Yii::app()->request->getPost("parent_link");
            $parent_value = Yii::app()->request->getPost("parent_value");
            $criteria = new CDbCriteria();
            $criteria->compare($f,$v,true);
            if(isset($parent_link) && isset($parent_value)){
                $criteria->addCondition($parent_link.'=:v');
                $criteria->params += array(':v'=>$parent_value);
            }
            switch($t){
                case 'country':
                    $model = Strana::model()->find($criteria);
                    break;
                case 'city':
                    $model = Gorod::model()->find($criteria);
                    break;
            }
            if(isset($model)){
                echo CJavaScript::jsonEncode(array('success'=>true,'data'=>array('id'=>$model->id,'value'=>$model->$f)));
            } else {
                echo CJavaScript::jsonEncode(array('success'=>false,'data'=>Yii::t("view","No data for {ext}",array('{ext}'=>$v))));
            }
            Yii::app()->end();
        }
    }

    public function actionUpload(){
        Yii::import('fileuploader.qqFileUploader');

        $tempFolder=Yii::getPathOfAlias('webroot').'/upload/temp/';

        if(!is_dir($tempFolder)){
            mkdir($tempFolder, 0777, TRUE);
        }
        if(!is_dir($tempFolder.'chunks')){
            mkdir($tempFolder.'chunks', 0777, TRUE);
        }

        $uploader = new qqFileUploader();
        $uploader->allowedExtensions = array('jpg','jpeg','png','gif','pdf');
        $uploader->sizeLimit = 10 * 1024 * 1024;//maximum file size in bytes
        $uploader->chunksFolder = $tempFolder.'chunks';

        $result = $uploader->handleUpload($tempFolder);
        $result['filename'] = $uploader->getUploadName();
        $result['link'] = '/upload/temp/'.$result['filename'];

        header("Content-Type: text/plain");
        $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $result;
        Yii::app()->end();
    }
}
