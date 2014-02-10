<?php

class FleetsController extends Controller
{
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

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation(array($model,$profile));

        if(isset($_POST['CcFleets']) && isset($_POST['SyProfile']))
        {
            $model->attributes=$_POST['CcFleets'];
            $profile->attributes=$_POST['SyProfile'];
            if($profile->save()){
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
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
            'profile'=>$profile,
            'yachtFoto'=>$yachtFoto,
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

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation(array($model,$profile));

        if(isset($_POST['CcFleets']) && isset($_POST['SyProfile']))
        {
            $model->attributes=$_POST['CcFleets'];
            $profile->attributes=$_POST['SyProfile'];
            //TODO Продумать механизм удаления не используемых фото
            if($profile->save() && $model->save()){
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
                $this->redirect(array('view','id'=>$model->id));
            } else {
                $model->validate();
                $profile->validate();
            }
        }

        $this->render('update',array(
            'model'=>$model,
            'profile'=>$profile,
            'yachtFoto'=>$yachtFoto,
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

	/**
	 * Performs the AJAX validation.
	 * @param BaseModel $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cc-fleets-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
