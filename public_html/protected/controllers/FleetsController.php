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

        if(isset($_POST['CcFleets']))
        {
            $model->attributes=$_POST['CcFleets'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
            'profile'=>$profile,
            'profileCC'=>$profileCC,
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

        $modelUser = $this->loadUser();

        /** @var $profileCC CcProfile */
        list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess($modelUser);

        if( ($role === "CC" && $model->cc_id == $profileCC->cc_id) || $role === "A"){
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['CcFleets']))
            {
                $model->attributes=$_POST['CcFleets'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('update',array(
                'model'=>$model,
            ));
        } else {
            $this->redirect('/');
        }
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
		$model=new CcFleets('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CcFleets']))
			$model->attributes=$_GET['CcFleets'];

		$this->render('admin',array(
			'model'=>$model,
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
