<?php

class FleetsController extends Controller
{
    public function init(){
        parent::init();
        $this->ajax = false;
        $this->validate = true;
    }

    public function filters()
    {
        return array(
            'rights',
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CcFleets;
        $profile=new SyProfile;

        /** @var $priceCurrYear PriceCurrentYear[] */
        $priceCurrYear = array();
        /** @var $priceNextYear PriceNextYear[] */
        $priceNextYear = array();

        $validate=null;

        if(isset($_POST['PriceCurrentYear'])){
            foreach($_POST['PriceCurrentYear'] as $i => $item){
                if(!empty($item['date_from'])){
                    $item['date_from'] = date('Y-m-d',strtotime($item['date_from']));
                }
                if(!empty($item['date_to'])){
                    $item['date_to'] = date('Y-m-d',strtotime($item['date_to']));
                }
                $priceCurrYear[$i] = new PriceCurrentYear;
                $priceCurrYear[$i]->attributes = $item;
                $priceCurrYear[$i]->yacht_id = -1;
            }
        }
        if(isset($_POST['PriceNextYear'])){
            foreach($_POST['PriceNextYear'] as $i => $item){
                if(!empty($item['date_from'])){
                    $item['date_from'] = date('Y-m-d',strtotime($item['date_from']));
                }
                if(!empty($item['date_to'])){
                    $item['date_to'] = date('Y-m-d',strtotime($item['date_to']));
                }
                $priceNextYear[$i] = new PriceNextYear;
                $priceNextYear[$i]->attributes = $item;
                $priceNextYear[$i]->yacht_id = -1;
            }
        }

        $yachtFoto = array(
            1 => new YachtPhoto,
            2 => new YachtPhoto,
            3 => new YachtPhoto,
            4 => new YachtPhoto,
            5 => array(
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
            ),
            6 => array(
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
            ),
            7 => array(
                new YachtPhoto,
                new YachtPhoto,
            ),
            8 => array(
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
                new YachtPhoto,
            ),
        );

        /** @var $profileCC CcProfile */
        list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess(Yii::app()->user);

        $model->cc_id = $profileCC->cc_id;
        $model->profile_id = -1;

        $gennakerOption = $profileCC->ccOrderOptions(array('with'=>'orderOption','condition'=>'orderOption.name=:n','params'=>array(':n'=>'gennaker')));
        $spinnakerOption = $profileCC->ccOrderOptions(array('with'=>'orderOption','condition'=>'orderOption.name=:n','params'=>array(':n'=>'spinnaker')));

        if(!empty($gennakerOption)){
            $profile->gennaker_price = $gennakerOption[0]->price;
        }
        if(!empty($spinnakerOption)){
            $profile->spinnaker_price = $spinnakerOption[0]->price;
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='cc-fleets-form')
        {
            $validateModels = array($model,$profile);

            $firstValidate = json_decode(CActiveForm::validate($validateModels),true);
            $priceCurrYearValidate = array();
            if(!empty($priceCurrYear)){
                $priceCurrYearValidate = json_decode(CActiveForm::validateTabular($priceCurrYear),true);
            }
            $priceNextYearValidate = array();
            if(!empty($priceNextYear)){
                $priceNextYearValidate = json_decode(CActiveForm::validateTabular($priceNextYear),true);
            }
            $result = array_merge(
                $firstValidate,
                $priceCurrYearValidate,
                $priceNextYearValidate
            );
            $fotoValidate = array();
            foreach($_POST['YachtPhoto'] as $type => $items){
                if($type==8) continue;
                if(!isset($items['link'])){
                    foreach($items as $i => $item){
                        if(empty($item['link'])){
                            $fotoValidate['YachtPhoto_'.$type.'_'.$i] = false;
                        } else {
                            $fotoValidate['YachtPhoto_'.$type.'_'.$i] = true;
                        }
                    }
                } else {
                    if(empty($items['link'])){
                        $fotoValidate['YachtPhoto_'.$type] = false;
                    } else {
                        $fotoValidate['YachtPhoto_'.$type] = true;
                    }
                }
            }
            $result['fotoValidate'] = array('validate'=>$fotoValidate,'message'=>Yii::t("view","Required photos are not added"));
            echo function_exists('json_encode') ? json_encode($result) : CJSON::encode($result);
            Yii::app()->end();
        }

        if(isset($_POST['CcFleets']) && isset($_POST['SyProfile']))
        {
            $model->attributes=$_POST['CcFleets'];
            $profile->attributes=$_POST['SyProfile'];

            $validate = true;
            $validate = $validate && $model->validate();
            $validate = $validate && $profile->validate();
            foreach($priceCurrYear as $i => $price){
                $validate = $validate && $priceCurrYear[$i]->validate();
            }
            foreach($priceNextYear as $i => $price){
                $validate = $validate && $priceNextYear[$i]->validate();
            }

            foreach($_POST['YachtPhoto'] as $type => $items){
                if($type==8) continue;
                if(!isset($items['link'])){
                    foreach($items as $i => $item){
                        if(empty($item['link'])){
                            $validate = $validate && false;
                        }
                    }
                } else {
                    if(empty($items['link'])){
                        $validate = $validate && false;
                    }
                }
            }

            if($validate){
                if(!empty($profile->ORC_scan)){
                    if(preg_match('/\/upload/',$profile->ORC_scan)){
                        $ext = preg_replace('/.+?\./','',$profile->ORC_scan);
                        $scanName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->ORC_scan,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanName)){
                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->ORC_scan);
                            $profile->ORC_scan = $scanName;
                        } else {
                            $profile->ORC_scan = null;
                        }
                    }
                }
                if(!empty($profile->IRC_scan)){
                    if(preg_match('/\/upload/',$profile->IRC_scan)){
                        $ext = preg_replace('/.+?\./','',$profile->IRC_scan);
                        $scanName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->IRC_scan,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanName)){
                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->IRC_scan);
                            $profile->IRC_scan = $scanName;
                        } else {
                            $profile->IRC_scan = null;
                        }
                    }
                }
                $profile->save();
                $model->profile_id = $profile->id;
                $model->save();
                foreach($_POST['YachtPhoto'] as $type => $items){
                    if(is_array($items) && !isset($items['link'])){
                        foreach($items as $i => $item){
                            if(!empty($item['link'])){
                                $yachtFoto[$type][$i]->attributes = $item;
                                $yachtFoto[$type][$i]->yacht_id = $model->id;
                                if(preg_match('/\/upload/',$yachtFoto[$type][$i]->link)){
                                    $ext = preg_replace('/.+?\./','',$yachtFoto[$type][$i]->link);
                                    $fotoName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                                    if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type][$i]->link,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$fotoName)){
                                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type][$i]->link);
                                        $yachtFoto[$type][$i]->link = $fotoName;
                                    } else {
                                        $yachtFoto[$type][$i]->link = "";
                                    }
                                }
                                $yachtFoto[$type][$i]->save();
                            }
                        }
                    } else {
                        if(!empty($items['link'])){
                            $yachtFoto[$type]->attributes = $items;
                            $yachtFoto[$type]->yacht_id = $model->id;

                            if(preg_match('/\/upload/',$yachtFoto[$type]->link)){
                                $ext = preg_replace('/.+?\./','',$yachtFoto[$type]->link);
                                $fotoName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                                if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type]->link,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$fotoName)){
                                    unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type]->link);
                                    $yachtFoto[$type]->link = $fotoName;
                                } else {
                                    $yachtFoto[$type]->link = "";
                                }
                            }

                            $yachtFoto[$type]->save();
                        }
                    }
                }

                foreach($priceCurrYear as $price){
                    $price->yacht_id = $model->id;
                    $price->save(false);
                }
                foreach($priceNextYear as $price){
                    $price->yacht_id = $model->id;
                    $price->save(false);
                }

                $this->redirect(array('view','id'=>$model->id));
            } else {
                $model->validate();
                $profile->validate();
                foreach($priceCurrYear as $price){
                    $price->validate();
                }
                foreach($priceNextYear as $price){
                    $price->validate();
                }
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'profile'=>$profile,
            'yachtFoto'=>$yachtFoto,
            'priceCurrYear'=>$priceCurrYear,
            'priceNextYear'=>$priceNextYear,
            'save_mode'=>-1,
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $profile = $model->profile;
        $photos = $model->yachtPhotos;
        $yachtFoto = array();

        /** @var $priceCurrYear PriceCurrentYear[] */
        $priceCurrYear = array();
        /** @var $priceNextYear PriceNextYear[] */
        $priceNextYear = array();

        $saveMode = isset($_POST['save_mode'])?$_POST['save_mode']:-1;

        $validate=null;

        if(isset($_POST['PriceCurrentYear'])){
            foreach($_POST['PriceCurrentYear'] as $i => $item){
                if(!empty($item['date_from'])){
                    $item['date_from'] = date('Y-m-d',strtotime($item['date_from']));
                }
                if(!empty($item['date_to'])){
                    $item['date_to'] = date('Y-m-d',strtotime($item['date_to']));
                }
                $priceCurrYear[$i] = new PriceCurrentYear;
                $priceCurrYear[$i]->attributes = $item;
                $priceCurrYear[$i]->yacht_id = $model->id;
            }
        } elseif (!isset($_POST['PriceCurrentYear'])) {
            $priceCurrYear = $model->priceCurrentYears;
        }
        if(isset($_POST['PriceNextYear'])){
            foreach($_POST['PriceNextYear'] as $i => $item){
                if(!empty($item['date_from'])){
                    $item['date_from'] = date('Y-m-d',strtotime($item['date_from']));
                }
                if(!empty($item['date_to'])){
                    $item['date_to'] = date('Y-m-d',strtotime($item['date_to']));
                }
                $priceNextYear[$i] = new PriceNextYear;
                $priceNextYear[$i]->attributes = $item;
                $priceNextYear[$i]->yacht_id = $model->id;
            }
        } elseif (!isset($_POST['PriceNextYear'])) {
            $priceNextYear = $model->priceNextYears;
        }

        foreach($photos as $photo){
            switch($photo->type){
                case 1:
                case 2:
                case 3:
                case 4:
                    $yachtFoto[$photo->type] = $photo;
                    break;
                case 5:
                case 6:
                case 7:
                case 8:
                    if(!isset($yachtFoto[$photo->type])){
                        $yachtFoto[$photo->type] = array();
                    }
                    array_push($yachtFoto[$photo->type],$photo);
                    break;
            }
        }

        for($i=1;$i<9;$i++){
            if($i<5 && !isset($yachtFoto[$i])){
                $yachtFoto[$i] = new YachtPhoto;
            }
            if($i>4) {
                if( ($i==5 || $i ==6) && !isset($yachtFoto[$i])){
                    $yachtFoto[$i] = array(
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                    );
                }
                if( $i==7 && !isset($yachtFoto[$i])){
                    $yachtFoto[$i] = array(
                        new YachtPhoto,
                        new YachtPhoto,
                    );
                }
                if( $i==8 && !isset($yachtFoto[$i])){
                    $yachtFoto[$i] = array(
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                        new YachtPhoto,
                    );
                }
                if( ($i==5 || $i ==6) && count($yachtFoto[$i])<3 ){
                    do{
                        $yachtFoto[$i][] = new YachtPhoto;
                    } while (count($yachtFoto[$i])!=3);
                }
                if( $i==7 && count($yachtFoto[$i])<2 ){
                    do{
                        $yachtFoto[$i][] = new YachtPhoto;
                    } while (count($yachtFoto[$i])!=2);
                }
                if( $i==8 && count($yachtFoto[$i])<8 ){
                    do{
                        $yachtFoto[$i][] = new YachtPhoto;
                    } while (count($yachtFoto[$i])!=8);
                }
            }
        }

        $profileCC = CcProfile::model()->findByAttributes(array('cc_id'=>$model->cc_id));

        $gennakerOption = $profileCC->ccOrderOptions(array('with'=>'orderOption','condition'=>'orderOption.name=:n','params'=>array(':n'=>'gennaker')));
        $spinnakerOption = $profileCC->ccOrderOptions(array('with'=>'orderOption','condition'=>'orderOption.name=:n','params'=>array(':n'=>'spinnaker')));

        if(!empty($gennakerOption) && is_null($profile->gennaker_price)){
            $profile->gennaker_price = $gennakerOption[0]->price;
        }
        if(!empty($spinnakerOption) && is_null($profile->spinnaker_price)){
            $profile->spinnaker_price = $spinnakerOption[0]->price;
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='cc-fleets-form')
        {
            $validateModels = array($model,$profile);

            $firstValidate = json_decode(CActiveForm::validate($validateModels),true);
            $priceCurrYearValidate = array();
            if(!empty($priceCurrYear)){
                $priceCurrYearValidate = json_decode(CActiveForm::validateTabular($priceCurrYear),true);
            }
            $priceNextYearValidate = array();
            if(!empty($priceNextYear)){
                $priceNextYearValidate = json_decode(CActiveForm::validateTabular($priceNextYear),true);
            }
            $result = array_merge(
                $firstValidate,
                $priceCurrYearValidate,
                $priceNextYearValidate
            );
            $fotoValidate = array();
            foreach($_POST['YachtPhoto'] as $type => $items){
                if($type==8) continue;
                if(!isset($items['link'])){
                    foreach($items as $i => $item){
                        if(empty($item['link'])){
                            $fotoValidate['YachtPhoto_'.$type.'_'.$i] = false;
                        } else {
                            $fotoValidate['YachtPhoto_'.$type.'_'.$i] = true;
                        }
                    }
                } else {
                    if(empty($items['link'])){
                        $fotoValidate['YachtPhoto_'.$type] = false;
                    } else {
                        $fotoValidate['YachtPhoto_'.$type] = true;
                    }
                }
            }
            $result['fotoValidate'] = array('validate'=>$fotoValidate,'message'=>Yii::t("view","Required photos are not added"));
            echo function_exists('json_encode') ? json_encode($result) : CJSON::encode($result);
            Yii::app()->end();
        }

        if(isset($_POST['CcFleets']) && isset($_POST['SyProfile']))
        {
            $oldIRCScan = $profile->IRC_scan;
            $oldORCScan = $profile->ORC_scan;

            $model->attributes=$_POST['CcFleets'];
            $profile->attributes=$_POST['SyProfile'];

            $validate = true;
            $validate = $validate && $model->validate();
            $validate = $validate && $profile->validate();
            foreach($priceCurrYear as $i => $price){
                $validate = $validate && $priceCurrYear[$i]->validate();
            }
            foreach($priceNextYear as $i => $price){
                $validate = $validate && $priceNextYear[$i]->validate();
            }

            foreach($_POST['YachtPhoto'] as $type => $items){
                if($type==8) continue;
                if(!isset($items['link'])){
                    foreach($items as $i => $item){
                        if(empty($item['link'])){
                            $validate = $validate && false;
                        }
                    }
                } else {
                    if(empty($items['link'])){
                        $validate = $validate && false;
                    }
                }
            }

            //TODO Продумать механизм удаления не используемых фото
            if($validate){
                if(!empty($profile->IRC_scan)){
                    if(preg_match('/\/upload/',$profile->IRC_scan)){
                        $ext = preg_replace('/.+?\./','',$profile->IRC_scan);
                        $scanName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->IRC_scan,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanName)){
                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->IRC_scan);
                            $profile->IRC_scan = $scanName;
                        } else {
                            $profile->IRC_scan = null;
                        }
                        if(!empty($oldIRCScan) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldIRCScan)){
                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldIRCScan);
                        }
                    }
                } else {
                    if(!empty($oldIRCScan) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldIRCScan)){
                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldIRCScan);
                    }
                }

                if(!empty($profile->ORC_scan)){
                    if(preg_match('/\/upload/',$profile->ORC_scan)){
                        $ext = preg_replace('/.+?\./','',$profile->ORC_scan);
                        $scanName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->ORC_scan,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanName)){
                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profile->ORC_scan);
                            $profile->ORC_scan = $scanName;
                        } else {
                            $profile->ORC_scan = null;
                        }
                        if(!empty($oldORCScan) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldORCScan)){
                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldORCScan);
                        }
                    }
                } else {
                    if(!empty($oldORCScan) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldORCScan)){
                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldORCScan);
                    }
                }

                $profile->save();
                $model->save();

                foreach($_POST['YachtPhoto'] as $type => $items){
                    if(!isset($items['link'])){
                        foreach($items as $i => $item){
                            if(isset($yachtFoto[$type][$i]->link)){
                                $oldFoto = $yachtFoto[$type][$i]->link;
                            }
                            if(!empty($item['link'])){
                                $yachtFoto[$type][$i]->attributes = $item;
                                $yachtFoto[$type][$i]->yacht_id = $model->id;

                                if(preg_match('/\/upload/',$yachtFoto[$type][$i]->link)){
                                    $ext = preg_replace('/.+?\./','',$yachtFoto[$type][$i]->link);
                                    $fotoName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                                    if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type][$i]->link,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$fotoName)){
                                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type][$i]->link);
                                        $yachtFoto[$type][$i]->link = $fotoName;
                                    } else {
                                        $yachtFoto[$type][$i]->link = "";
                                    }
                                }

                                $yachtFoto[$type][$i]->save();
                            } else {
//                                if(!empty($oldFoto) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldFoto)){
//                                    unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldFoto);
//                                }
                                if(!$yachtFoto[$type][$i]->isNewRecord){
                                    $yachtFoto[$type][$i]->delete();
                                }
                            }
                        }
                    } else {
                        if(isset($yachtFoto[$type]->link)){
                            $oldFoto = $yachtFoto[$type]->link;
                        }
                        if(!empty($items['link'])){
                            $yachtFoto[$type]->attributes = $items;
                            $yachtFoto[$type]->yacht_id = $model->id;

                            if(preg_match('/\/upload/',$yachtFoto[$type]->link)){
                                $ext = preg_replace('/.+?\./','',$yachtFoto[$type]->link);
                                $fotoName = '/i/cc_fleets/'.md5(time()+rand()).'.'.$ext;
                                if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type]->link,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$fotoName)){
                                    unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$yachtFoto[$type]->link);
                                    $yachtFoto[$type]->link = $fotoName;
                                } else {
                                    $yachtFoto[$type]->link = "";
                                }
                            }

                            $yachtFoto[$type]->save();
                        } else {
//                            if(!empty($oldFoto) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldFoto)){
//                                unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldFoto);
//                            }
                            if(!$yachtFoto[$type]->isNewRecord){
                                $yachtFoto[$type]->delete();
                            }
                        }
                    }
                }

                foreach($model->priceCurrentYears as $price){
                    $price->delete();
                }
                foreach($priceCurrYear as $price){
                    $price->save(false);
                }

                foreach($model->priceNextYears as $price){
                    $price->delete();
                }
                foreach($priceNextYear as $price){
                    $price->save(false);
                }

                if($saveMode==-1){
                    $this->redirect(array('view','id'=>$model->id));
                } else {
                    $model = $this->loadModel($id);
                    $priceCurrYear = $model->priceCurrentYears;
                    $priceNextYear = $model->priceNextYears;
                }
            }
        }

        $this->render('update',array(
            'model'=>$model,
            'profile'=>$profile,
            'yachtFoto'=>$yachtFoto,
            'priceCurrYear'=>$priceCurrYear,
            'priceNextYear'=>$priceNextYear,
            'save_mode'=>$saveMode,
        ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $modelUser = $this->loadUser();

        $model = $this->loadModel($id);

        /** @var $profileCC CcProfile */
        list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess($modelUser);

        if( ($role === "CC" && $model->cc_id == $profileCC->cc_id) || $role === "A"){
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else {
            $this->redirect('/');
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $uid = Yii::app()->user->id;
        /** @var $profileCC CcProfile */
        list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess(Yii::app()->user);
        if($role == 'M'){
            $uid = $profileCC->cc_id;
        }

		$dataProvider=new CActiveDataProvider(
            'CcFleets',
            array(
                'criteria'=>array(
                    'condition' => 'cc_id = :ccid',
                    'params' => array(
                        ':ccid' => $uid,
                    ),
                ),
            )
        );
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $uid = Yii::app()->user->id;
        /** @var $profileCC CcProfile */
        list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess(Yii::app()->user);
        if($role == 'M'){
            $uid = $profileCC->cc_id;
        }

		$model=new CcFleets('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CcFleets']))
			$model->attributes=$_GET['CcFleets'];

		$this->render('admin',array(
			'model'=>$model,
            'uid'=>$uid,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CcFleets the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CcFleets::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
