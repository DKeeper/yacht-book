<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 14:30
 * Created by JetBrains PhpStorm.
 */
class ProfileController extends Controller
{
    private $_model;

    public function filters()
    {
        return array(
            'rights',
        );
    }

    public function allowedActions(){
        return 'index, view';
    }

    public function actionEdit($id=null){
        $this->editProfile($id);
    }

    public function actionView($id=null){
        $this->renderProfile($id);
    }

    public function actionIndex(){
        $this->renderProfile();
    }

    public function actionChangepassword() {
        $mUser = Yii::app()->getModule('user');
        $model = new UserChangePassword;
        if (Yii::app()->user->id) {

            // ajax validator
            if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
            {
                echo UActiveForm::validate($model);
                Yii::app()->end();
            }

            if(isset($_POST['UserChangePassword'])) {
                $model->attributes=$_POST['UserChangePassword'];
                if($model->validate()) {
                    $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                    $new_password->password = UserModule::encrypting($model->password);
                    $new_password->activkey=UserModule::encrypting(microtime().$model->password);
                    $new_password->save();
                    Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("New password is saved."));
                    $this->redirect(array("/profile"));
                }
            }
            $this->render('changepassword',array('model'=>$model));
        }
    }

    protected function editProfile($id=null){
        $modelUser = $this->loadUser($id);
        if($modelUser){
            $profileUser=$modelUser->profile;
            list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess($modelUser);
            if($role === ""){
                $this->redirect("/");
            }
            switch($view){
                /** Блок редактирования ЧК */
                case 'CC':
                    if($role === "CC" || $role === "A"){
                        if($role === "CC" && !$owner){
                            $this->redirect("/profile/edit/".Yii::app()->user->id);
                        }
                        /** @var $profileCC CcProfile */
                        $profileCC = CcProfile::model()->findByAttributes(array("cc_id"=>$modelUser->id));
                        /** @var $paymentsPeriods CcPaymentsPeriod[] */
                        $paymentsPeriods = $profileCC->ccPaymentsPeriods;
                        /** @var $cancelPeriods CcCancelPeriod[] */
                        $cancelPeriods = $profileCC->ccCancelPeriods;
                        /** @var $longPeriods CcLongPeriod[] */
                        $longPeriods = $profileCC->ccLongPeriods;
                        /** @var $earlyPeriods CcEarlyPeriod[] */
                        $earlyPeriods = $profileCC->ccEarlyPeriods;
                        /** @var $transitLogs CcTransitLog[] */
                        $transitLogs = $profileCC->ccTransitLogs;
                        /** @var $orderOptions CcOrderOptions[] */
                        $orderOptions = $profileCC->ccOrderOptions;
                        // ajax validator
                        if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
                        {
                            $validateModels = array($modelUser,$profileUser,$profileCC);
                            if(isset($_POST['CcPaymentsPeriod'])){
                                foreach($_POST['CcPaymentsPeriod'] as $i => $item){
                                    $paymentsPeriods[$i] = new CcPaymentsPeriod;
                                    $paymentsPeriods[$i]->attributes = $item;
                                    $paymentsPeriods[$i]->cc_profile_id = $modelUser->id;
                                }
                            }
                            if(isset($_POST['CcCancelPeriod'])){
                                foreach($_POST['CcCancelPeriod'] as $i => $item){
                                    $cancelPeriods[$i] = new CcCancelPeriod;
                                    $cancelPeriods[$i]->attributes = $item;
                                    $cancelPeriods[$i]->cc_profile_id = $modelUser->id;
                                }
                            }
                            if(isset($_POST['CcLongPeriod'])){
                                foreach($_POST['CcLongPeriod'] as $i => $item){
                                    $longPeriods[$i] = new CcLongPeriod;
                                    $longPeriods[$i]->attributes = $item;
                                    $longPeriods[$i]->cc_profile_id = $modelUser->id;
                                }
                            }
                            if(isset($_POST['CcEarlyPeriod'])){
                                foreach($_POST['CcEarlyPeriod'] as $i => $item){
                                    $earlyPeriods[$i] = new CcEarlyPeriod;
                                    $earlyPeriods[$i]->attributes = $item;
                                    $earlyPeriods[$i]->cc_profile_id = $modelUser->id;
                                }
                            }
                            if(isset($_POST['CcTransitLog'])){
                                foreach($_POST['CcTransitLog'] as $i => $item){
                                    $transitLogs[$i] = new CcTransitLog;
                                    $transitLogs[$i]->attributes = $item;
                                    $transitLogs[$i]->cc_profile_id = $modelUser->id;
                                }
                            }
                            if(isset($_POST['CcOrderOptions'])){
                                foreach($_POST['CcOrderOptions'] as $i => $item){
                                    $orderOptions[$i] = new CcOrderOptions;
                                    $orderOptions[$i]->attributes = $item;
                                    $orderOptions[$i]->cc_profile_id = $modelUser->id;
                                }
                            }
                            $firstValidate = json_decode(UActiveForm::validate($validateModels),true);
                            $paymentValidate = array();
                            if(!empty($paymentsPeriods)){
                                $paymentValidate = json_decode(CActiveForm::validateTabular($paymentsPeriods),true);
                            }
                            $cancelValidate = array();
                            if(!empty($cancelPeriods)){
                                $cancelValidate = json_decode(CActiveForm::validateTabular($cancelPeriods),true);
                            }
                            $longValidate = array();
                            if(!empty($longPeriods)){
                                $longValidate = json_decode(CActiveForm::validateTabular($longPeriods),true);
                            }
                            $earlyValidate = array();
                            if(!empty($earlyPeriods)){
                                $earlyValidate = json_decode(CActiveForm::validateTabular($longPeriods),true);
                            }
                            $transitLogValidate = array();
                            if(!empty($transitLogs)){
                                $transitLogValidate = json_decode(CActiveForm::validateTabular($transitLogs),true);
                            }
                            $orderOptionValidate = array();
                            if(!empty($orderOptions)){
                                $orderOptionValidate = json_decode(CActiveForm::validateTabular($orderOptions),true);
                            }
                            $result = array_merge(
                                $firstValidate,
                                $paymentValidate,
                                $cancelValidate,
                                $longValidate,
                                $earlyValidate,
                                $transitLogValidate,
                                $orderOptionValidate
                            );
                            echo function_exists('json_encode') ? json_encode($result) : CJSON::encode($result);
                            Yii::app()->end();
                        }
                        if(isset($_POST['User']))
                        {
                            $modelUser->attributes=$_POST['User'];
                            $profileUser->attributes=$_POST['Profile'];
                            $profileCC->attributes=((isset($_POST['CcProfile'])?$_POST['CcProfile']:array()));

                            if($modelUser->validate()&&$profileUser->validate()&&$profileCC->validate()) {
                                $modelUser->save();
                                $profileUser->save();
                                $profileCC->save();

                                foreach($profileCC->ccPaymentsPeriods as $period){
                                    $period->delete();
                                }
                                if(isset($_POST['CcPaymentsPeriod'])){
                                    foreach($_POST['CcPaymentsPeriod'] as $i => $item){
                                        $paymentsPeriods[$i] = new CcPaymentsPeriod;
                                        $paymentsPeriods[$i]->attributes = $item;
                                        $paymentsPeriods[$i]->cc_profile_id = $profileCC->id;
                                    }

                                    foreach($paymentsPeriods as $period){
                                        $period->save(false);
                                    }
                                }

                                foreach($profileCC->ccCancelPeriods as $period){
                                    $period->delete();
                                }
                                if(isset($_POST['CcCancelPeriod'])){
                                    foreach($_POST['CcCancelPeriod'] as $i => $item){
                                        $cancelPeriods[$i] = new CcCancelPeriod;
                                        $cancelPeriods[$i]->attributes = $item;
                                        $cancelPeriods[$i]->cc_profile_id = $profileCC->id;
                                    }

                                    foreach($cancelPeriods as $period){
                                        $period->save(false);
                                    }
                                }

                                foreach($profileCC->ccLongPeriods as $period){
                                    $period->delete();
                                }
                                if(isset($_POST['CcLongPeriod'])){
                                    foreach($_POST['CcLongPeriod'] as $i => $item){
                                        $longPeriods[$i] = new CcLongPeriod;
                                        $longPeriods[$i]->attributes = $item;
                                        $longPeriods[$i]->cc_profile_id = $profileCC->id;
                                    }

                                    foreach($longPeriods as $period){
                                        $period->save(false);
                                    }
                                }

                                foreach($profileCC->ccEarlyPeriods as $period){
                                    $period->delete();
                                }
                                if(isset($_POST['CcEarlyPeriod'])){
                                    foreach($_POST['CcEarlyPeriod'] as $i => $item){
                                        $earlyPeriods[$i] = new CcEarlyPeriod;
                                        $earlyPeriods[$i]->attributes = $item;
                                        $earlyPeriods[$i]->cc_profile_id = $profileCC->id;
                                    }

                                    foreach($earlyPeriods as $period){
                                        $period->save(false);
                                    }
                                }

                                foreach($profileCC->ccTransitLogs as $period){
                                    $period->delete();
                                }
                                if(isset($_POST['CcTransitLog'])){
                                    foreach($_POST['CcTransitLog'] as $i => $item){
                                        $transitLogs[$i] = new CcTransitLog;
                                        $transitLogs[$i]->attributes = $item;
                                        $transitLogs[$i]->cc_profile_id = $profileCC->id;
                                    }

                                    foreach($transitLogs as $log){
                                        $log->save(false);
                                    }
                                }

                                foreach($profileCC->ccOrderOptions as $period){
                                    $period->delete();
                                }
                                if(isset($_POST['CcOrderOptions'])){
                                    foreach($_POST['CcOrderOptions'] as $i => $item){
                                        $orderOptions[$i] = new CcOrderOptions;
                                        $orderOptions[$i]->attributes = $item;
                                        $orderOptions[$i]->cc_profile_id = $profileCC->id;
                                    }

                                    foreach($orderOptions as $option){
                                        $option->save(false);
                                    }
                                }

                                Yii::app()->user->updateSession();
                                Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("Changes is saved."));
                                $this->redirect(array('/profile'));
                            } else {
                                $profileUser->validate();
                                $profileCC->validate();
                                foreach($paymentsPeriods as $i => $period){
                                    $paymentsPeriods[$i]->validate();
                                }
                                foreach($cancelPeriods as $i => $period){
                                    $cancelPeriods[$i]->validate();
                                }
                                foreach($longPeriods as $i => $period){
                                    $longPeriods[$i]->validate();
                                }
                                foreach($earlyPeriods as $i => $period){
                                    $earlyPeriods[$i]->validate();
                                }
                                foreach($transitLogs as $i => $log){
                                    $transitLogs[$i]->validate();
                                }
                                foreach($orderOptions as $i => $option){
                                    $orderOptions[$i]->validate();
                                }
                            }
                        }
                        $this->render('edit_company',
                            array(
                                'modelUser'=>$modelUser,
                                'profileUser'=>$profileUser,
                                'profileCC'=>$profileCC,
                                'paymentsPeriods'=>$paymentsPeriods,
                                'cancelPeriods'=>$cancelPeriods,
                                'longPeriods'=>$longPeriods,
                                'earlyPeriods'=>$earlyPeriods,
                                'transitLogs'=>$transitLogs,
                                'orderOptions'=>$orderOptions,
                            )
                        );
                    } else {
                        $this->redirect("/profile/edit/".Yii::app()->user->id);
                    }
                    break;
                /** Конец блока редактирования ЧК */
            }
        } else {
            $this->render('view',array(
                'no_load'=>true,
            ));
        }
    }

    protected function renderProfile($id=null){
        if(Yii::app()->user->checkAccess('Administrator') && is_null($id)){
            $this->redirect('/user/profile');
        }
        $model = $this->loadUser($id);
        if($model){
            list($profileCC,$profileC,$profileM,$view,$role,$owner) = $this->checkAccess($model);
            $this->render('view',array(
                'model'=>$model,
                'profile'=>$model->profile,
                'profileCC'=>$profileCC,
                'profileC'=>$profileC,
                'profileM'=>$profileM,
                'role'=>$role,
                'view'=>$view,
                'owner'=>$owner,
            ));
        } else {
            $this->render('view',array(
                'no_load'=>true,
            ));
        }
    }
    /**
     * @param $id
     * @return User
     */
    protected function loadUser($id=null)
    {
        if(isset($id)){
            $this->_model=User::model()->findByPk($id);
        }
        elseif($this->_model===null)
        {
            if(Yii::app()->user->id)
                $this->_model=Yii::app()->getModule('user')->user();
            if($this->_model===null)
                $this->redirect(Yii::app()->getModule('user')->loginUrl);
        }
        return $this->_model;
    }

    protected function checkAccess($model){
        if(Rights::getAuthorizer()->isSuperuser($model->id)===true){
            $this->redirect('/');
        }
        $id = $model->id;
        $profileCC=$profileC=$profileM=null;
        $profileCC = CcProfile::model()->findByAttributes(array('cc_id'=>$id));
        $view = 'CC';
        if(!isset($profileCC)){
            $profileC = CProfile::model()->findByAttributes(array('c_id'=>$id));
            $view = 'C';
            if(!isset($profileC)){
                $profileM = MProfile::model()->findByAttributes(array('m_id'=>$id));
                $view = 'M';
            }
        }
        $role = (Yii::app()->user->checkAccess('C') ? 'C' : (Yii::app()->user->checkAccess('CC') ? 'CC' : (Yii::app()->user->checkAccess('M') ? 'M' : '')));
        if(Yii::app()->user->checkAccess('Administrator')){
            $role = 'A';
        }
        $owner = $id==Yii::app()->user->id?true:false;
        if(!$owner){
            $this->layout = '//layouts/column1';
        }
        return array(
            $profileCC,
            $profileC,
            $profileM,
            $view,
            $role,
            $owner
        );
    }
}
