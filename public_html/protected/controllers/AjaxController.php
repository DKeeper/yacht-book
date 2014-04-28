<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 02.12.13
 * @time 17:19
 * Created by JetBrains PhpStorm.
 */
class AjaxController extends Controller
{
    public function init(){
        parent::init();
        $this->ajax = true;
        $this->validate = true;
    }

    public function filters()
    {
        return array(
            'rights',
        );
    }

    public function allowedActions(){
        return 'getfleetcard, getclustermarker, getyachtcards ,autocomplete, icreate, getcityll, getmodelbynum, findgeoobject, upload';
    }

    public function actionGetfleetcard($fid){
        if(Yii::app()->request->isAjaxRequest){
            $data = '';
            $script = '';
            $model=CcFleets::model()->findByPk($fid);
            if(isset($model)){
                $data = $this->renderPartial('/fleets/view',array(
                    'model'=>$model,
                    'ajax'=>true,
                ),true);
                if($data===''){
                    unset($data);
                    $error = Yii::t("view","No data");
                }
                if(isset($data)){
                    foreach(Yii::app()->clientScript->scripts as $pos){
                        foreach($pos as $s){
                            $script .= $s;
                        }
                    }
                    echo CJavaScript::jsonEncode(array('success'=>true,'data'=>$data,'script'=>$script));
                } else {
                    echo CJavaScript::jsonEncode(array('success'=>false,'data'=>$error));
                }
            }
        }
        Yii::app()->end();
    }

    public function actionGetclustermarker($data){
        $data = CJavaScript::jsonDecode($data);
        $marker = imagecreatetruecolor(40,40);
        $black = imagecolorallocate($marker, 0, 0, 0);
        $white = imagecolorallocate($marker, 0xFF, 0xFF, 0xFF);
        $red = imagecolorallocate($marker, 0xFF, 0x00, 0x00);
        $green = imagecolorallocate($marker, 0x00, 0xFF, 0x00);
        $blue = imagecolorallocate($marker, 0x00, 0x00, 0xFF);
        imagefilledarc($marker,20,20,40,40,270,30,$red,IMG_ARC_PIE);
        imagefilledarc($marker,20,20,40,40,30,150,$green,IMG_ARC_PIE);
        imagefilledarc($marker,20,20,40,40,150,270,$blue,IMG_ARC_PIE);
        imagefilledarc($marker,20,20,40,40,0,360,$white,IMG_ARC_NOFILL);
        imagecolortransparent($marker, $black);
        header('Content-Type: image/png');
        imagepng($marker);
        imagedestroy($marker);
    }

    public function actionGetyachtcards(){
        if(Yii::app()->request->isAjaxRequest){
            $markerData = Yii::app()->request->getParam('data');
            $data = '';
            foreach($markerData as $marker){
                /** @var $fleet CcFleets */
                $fleet = CcFleets::model()->findByPk($marker['fid']);
                $company = CcProfile::model()->findByAttributes(array('cc_id'=>$marker['cid']));
                $priceCurrentYear = PriceCurrentYear::model()->findByPk($marker['prid']);
                if(isset($fleet) && isset($company) && isset($priceCurrentYear)){
                    $data .= $this->renderPartial(
                        '/fleets/_view_yacht_card_for_map',
                        array(
                            'fleet' => $fleet,
                            'company' => $company,
                            'price' => $priceCurrentYear,
                        ),
                        true
                    );
                }
            }
            if($data===''){
                unset($data);
                $error = Yii::t("view","No data");
            }
            if(isset($data)){
                echo CJavaScript::jsonEncode(array('success'=>true,'data'=>$data));
            } else {
                echo CJavaScript::jsonEncode(array('success'=>false,'data'=>$error));
            }
        }
        Yii::app()->end();
    }

    public function actionMapsearch(){
        if(Yii::app()->request->isAjaxRequest){
            $filterData = Yii::app()->request->getPost('Search');
            // Поиск лодок
            $command = Yii::app()->db->createCommand();
            $command
                ->select('f.id as fid, f.cc_id as cid, pr.id as prid, pr.latitude, pr.longitude')
                ->from('cc_fleets as f')
                ->join('sy_profile as p','p.id = f.profile_id')
                ->leftJoin('price_current_year as pr','pr.yacht_id = f.id')
                ->andWhere('p.length_m BETWEEN :l_min AND :l_max',array(':l_min'=>$filterData['length']['min'],':l_max'=>$filterData['length']['max']))
                ->andWhere('p.built_date BETWEEN :d_min AND :d_max',array(':d_min'=>$filterData['year']['min'],':d_max'=>$filterData['year']['max']))
                ->andWhere('pr.price BETWEEN :pr_min AND :pr_max',array(':pr_min'=>$filterData['price']['min'],':pr_max'=>$filterData['price']['max']))
                ->andWhere('
                    (
                        ( CASE WHEN p.single_cabins IS NULL THEN 0 ELSE p.single_cabins END ) +
	                    ( CASE WHEN p.double_cabins IS NULL THEN 0 ELSE p.double_cabins END ) +
	                    ( CASE WHEN p.bunk_cabins IS NULL THEN 0 ELSE p.bunk_cabins END ) +
	                    ( CASE WHEN p.twin_cabins IS NULL THEN 0 ELSE p.twin_cabins END )
	                ) >= :c_min
                ',array(':c_min'=>$filterData['cabins']['min']))
                ->andWhere('
                    (
                        ( CASE WHEN p.single_cabins IS NULL THEN 0 ELSE p.single_cabins END ) +
	                    ( CASE WHEN p.double_cabins IS NULL THEN 0 ELSE p.double_cabins END ) +
	                    ( CASE WHEN p.bunk_cabins IS NULL THEN 0 ELSE p.bunk_cabins END ) +
	                    ( CASE WHEN p.twin_cabins IS NULL THEN 0 ELSE p.twin_cabins END )
	                ) <= :c_max
                ',array(':c_max'=>$filterData['cabins']['max']))
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
            $debugSQL = $command->getText();
            $debugParam = $command->params;
            /** @var $fleets array|null */
            $fleets = $command->queryAll();
            // Поиск граничных значений фильтров
            $command->reset();
            $command
                ->select("
                    MIN(p.length_m) as l_min,
                    MAX(p.length_m) as l_max,
                    MIN(p.built_date) as b_date_min,
                    MAX(p.built_date) as b_date_max,
                    MIN(pr.price) as price_min,
                    MAX(pr.price) as price_max,
                    MIN(
                        ( CASE WHEN p.single_cabins IS NULL THEN 0 ELSE p.single_cabins END ) +
	                    ( CASE WHEN p.double_cabins IS NULL THEN 0 ELSE p.double_cabins END ) +
	                    ( CASE WHEN p.bunk_cabins IS NULL THEN 0 ELSE p.bunk_cabins END ) +
	                    ( CASE WHEN p.twin_cabins IS NULL THEN 0 ELSE p.twin_cabins END )
	                ) AS cabins_min,
                    MAX(
                        ( CASE WHEN p.single_cabins IS NULL THEN 0 ELSE p.single_cabins END ) +
	                    ( CASE WHEN p.double_cabins IS NULL THEN 0 ELSE p.double_cabins END ) +
	                    ( CASE WHEN p.bunk_cabins IS NULL THEN 0 ELSE p.bunk_cabins END ) +
	                    ( CASE WHEN p.twin_cabins IS NULL THEN 0 ELSE p.twin_cabins END )
	                ) AS cabins_max
                ")
                ->from('cc_fleets as f')
                ->join('sy_profile as p','p.id = f.profile_id')
                ->leftJoin('price_current_year as pr','pr.yacht_id = f.id')
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
            $newFilter = $command->queryRow();
            $newFilter['l_min'] = floor($newFilter['l_min']);
            $newFilter['l_max'] = ceil($newFilter['l_max']);
            $newFilter['b_date_min'] = intval($newFilter['b_date_min']);
            $newFilter['b_date_max'] = intval($newFilter['b_date_max']);
            $newFilter['price_min'] = intval($newFilter['price_min']);
            $newFilter['price_max'] = intval($newFilter['price_max']);
            $newFilter['cabins_min'] = intval($newFilter['cabins_min']);
            $newFilter['cabins_max'] = intval($newFilter['cabins_max']);

            $data = array(
                'count'=>count($fleets),
                'fleets'=>$fleets,
                'filter'=>$newFilter,
                'debug'=>array(
                    'sql'=>$debugSQL,
                    'param'=>$debugParam,
                ),
            );
            if(isset($data)){
                echo CJavaScript::jsonEncode(array('success'=>true,'data'=>$data));
            } else {
                echo CJavaScript::jsonEncode(array('success'=>false,'data'=>$error));
            }
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
            $mapSearch = Yii::app()->getRequest()->getParam('map');

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
                if(isset($mapSearch)){
                    $this->addMapSearchCondition($criteria,get_class($model));
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

    /**
     * @param $criteria CDbCriteria
     * @param $className
     */
    protected function addMapSearchCondition(&$criteria,$className){
        $criteria->alias = 't';
        $criteria->distinct = true;
        $criteria->select = 't.'.$criteria->select;
        $criteria->order = 't.'.$criteria->order;
        if($criteria->condition!==''){
            $conditions = explode(' AND ',$criteria->condition);
            $criteria->condition = '';
            foreach($conditions as $condition){
                $condition = 't.'.trim($condition,'()');
                $criteria->addCondition($condition);
            }
        }
        $filterData = Yii::app()->getRequest()->getParam('map_filter');
        $params = array(
            ':l_min'=>$filterData['l_min'],
            ':l_max'=>$filterData['l_max'],
            ':d_min'=>$filterData['y_min'].'-01-01',
            ':d_max'=>$filterData['y_max'].'-01-01',
            ':pr_min'=>$filterData['p_min'],
            ':pr_max'=>$filterData['p_max'],
            ':c_min'=>$filterData['c_min'],
            ':c_max'=>$filterData['c_max']
        );
        $criteria->params += $params;
        switch($className){
            case 'YachtType':
                $criteria->join = "
                    JOIN sy_profile AS yp ON yp.type_id = t.id
                    JOIN cc_fleets AS f ON f.profile_id = yp.id
                    LEFT JOIN price_current_year AS pr ON pr.yacht_id = f.id
                ";
                break;
            case 'YachtShipyard':
                $criteria->join = "
                    JOIN sy_profile AS yp ON yp.shipyard_id = t.id
                    JOIN cc_fleets AS f ON f.profile_id = yp.id
                    LEFT JOIN price_current_year AS pr ON pr.yacht_id = f.id
                ";
                break;
            case 'YachtModel':
                $criteria->join = "
                    JOIN sy_profile AS yp ON yp.model_id = t.id
                    JOIN cc_fleets AS f ON f.profile_id = yp.id
                    LEFT JOIN price_current_year AS pr ON pr.yacht_id = f.id
                ";
                break;
        }
        $criteria->addCondition("yp.length_m >= :l_min");
        $criteria->addCondition("yp.length_m <= :l_max");
        $criteria->addCondition("yp.built_date BETWEEN :d_min AND :d_max");
        $criteria->addCondition("pr.price >= :pr_min");
        $criteria->addCondition("pr.price <= :pr_max");
        $criteria->addCondition("(
                        ( CASE WHEN yp.single_cabins IS NULL THEN 0 ELSE yp.single_cabins END ) +
	                    ( CASE WHEN yp.double_cabins IS NULL THEN 0 ELSE yp.double_cabins END ) +
	                    ( CASE WHEN yp.bunk_cabins IS NULL THEN 0 ELSE yp.bunk_cabins END ) +
	                    ( CASE WHEN yp.twin_cabins IS NULL THEN 0 ELSE yp.twin_cabins END )
	                ) >= :c_min");
        $criteria->addCondition("(
                        ( CASE WHEN yp.single_cabins IS NULL THEN 0 ELSE yp.single_cabins END ) +
	                    ( CASE WHEN yp.double_cabins IS NULL THEN 0 ELSE yp.double_cabins END ) +
	                    ( CASE WHEN yp.bunk_cabins IS NULL THEN 0 ELSE yp.bunk_cabins END ) +
	                    ( CASE WHEN yp.twin_cabins IS NULL THEN 0 ELSE yp.twin_cabins END )
	                ) <= :c_max");
        $criteria->addCondition("f.isActive=1");
        $t = 0;
    }
}
