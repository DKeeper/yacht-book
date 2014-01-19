<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 12.12.13
 * @time 14:30
 * Created by JetBrains PhpStorm.
 */
class ProfileController extends Controller
{

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
                /** Блок редактирования Капитана */
                case 'C':
                    if($role === "C" || $role === "A"){
                        if($role === "C" && !$owner){
                            $this->redirect("/profile/edit/".Yii::app()->user->id);
                        }
                        /** @var $profileC CProfile */
                        $profileC = CProfile::model()->findByAttributes(array("c_id"=>$modelUser->id));
                        // ajax validator
                        if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
                        {
                            echo UActiveForm::validate(array($modelUser,$profileUser,$profileC));
                            Yii::app()->end();
                        }
                        if(isset($_POST['User']))
                        {
                            $modelUser->attributes=$_POST['User'];
                            $profileUser->attributes=$_POST['Profile'];

                            $oldAvatar = $profileC->avatar;
                            $oldScanOfLicense = $profileC->scan_of_license;

                            $profileC->attributes=((isset($_POST['CProfile'])?$_POST['CProfile']:array()));

                            $validate = true;
                            $validate = $validate && $modelUser->validate();
                            $validate = $validate && $profileUser->validate();
                            $validate = $validate && $profileC->validate();

                            if($validate) {
                                $modelUser->save();
                                $profileUser->save();

                                if(!empty($profileC->avatar)){
                                    if(preg_match('/\/upload/',$profileC->avatar)){
                                        $ext = preg_replace('/.+?\./','',$profileC->avatar);
                                        $avatarName = '/i/cc/'.md5(time()+rand()).'.'.$ext;
                                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileC->avatar,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$avatarName)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileCC->avatar);
                                            $profileC->avatar = $avatarName;
                                        } else {
                                            $profileC->avatar = null;
                                        }
                                        if(file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar);
                                        }
                                    }
                                }

                                if(!empty($profileC->scan_of_license)){
                                    if(preg_match('/\/upload/',$profileC->scan_of_license)){
                                        $ext = preg_replace('/.+?\./','',$profileC->scan_of_license);
                                        $scanOfLicenseName = '/i/cc/'.md5(time()+rand()).'.'.$ext;
                                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileC->scan_of_license,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanOfLicenseName)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileCC->scan_of_license);
                                            $profileC->scan_of_license = $scanOfLicenseName;
                                        } else {
                                            $profileC->scan_of_license = null;
                                        }
                                        if(file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldScanOfLicense)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldScanOfLicense);
                                        }
                                    }
                                }

                                $profileC->save();

                                Yii::app()->user->updateSession();
                                Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("Changes are saved."));
                                $this->redirect(array('/profile'));
                            }
                        }
                        $this->render('edit_captain',
                            array(
                                'modelUser'=>$modelUser,
                                'profileUser'=>$profileUser,
                                'profileC'=>$profileC,
                            )
                        );
                    } else {
                        $this->redirect("/profile/edit/".Yii::app()->user->id);
                    }
                    break;
                /** Конец блока редактирования Капитана */
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
                        if(isset($_POST['CcPaymentsPeriod'])){
                            foreach($_POST['CcPaymentsPeriod'] as $i => $item){
                                $paymentsPeriods[$i] = new CcPaymentsPeriod;
                                $paymentsPeriods[$i]->attributes = $item;
                                $paymentsPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        }
                        if(isset($_POST['CcCancelPeriod'])){
                            foreach($_POST['CcCancelPeriod'] as $i => $item){
                                $cancelPeriods[$i] = new CcCancelPeriod;
                                $cancelPeriods[$i]->attributes = $item;
                                $cancelPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        }
                        if(isset($_POST['CcLongPeriod'])){
                            foreach($_POST['CcLongPeriod'] as $i => $item){
                                $longPeriods[$i] = new CcLongPeriod;
                                $longPeriods[$i]->attributes = $item;
                                $longPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        }
                        if(isset($_POST['CcEarlyPeriod'])){
                            foreach($_POST['CcEarlyPeriod'] as $i => $item){
                                $earlyPeriods[$i] = new CcEarlyPeriod;
                                $earlyPeriods[$i]->attributes = $item;
                                $earlyPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        }
                        if(isset($_POST['CcTransitLog'])){
                            foreach($_POST['CcTransitLog'] as $i => $item){
                                $transitLogs[$i] = new CcTransitLog;
                                $transitLogs[$i]->attributes = $item;
                                $transitLogs[$i]->cc_profile_id = $profileCC->id;
                            }
                        }
                        if(isset($_POST['CcOrderOptions'])){
                            foreach($_POST['CcOrderOptions'] as $i => $item){
                                $orderOptions[$i] = new CcOrderOptions;
                                $orderOptions[$i]->attributes = $item;
                                $orderOptions[$i]->cc_profile_id = $profileCC->id;
                            }
                        }
                        // ajax validator
                        if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
                        {
                            $validateModels = array($modelUser,$profileUser,$profileCC);
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

                            $oldLogo = $profileCC->company_logo;
                            $profileCC->attributes=((isset($_POST['CcProfile'])?$_POST['CcProfile']:array()));

                            $validate = true;
                            $validate = $validate && $modelUser->validate();
                            $validate = $validate && $profileUser->validate();
                            $validate = $validate && $profileCC->validate();
                            foreach($paymentsPeriods as $i => $period){
                                $validate = $validate && $paymentsPeriods[$i]->validate();
                            }
                            foreach($cancelPeriods as $i => $period){
                                $validate = $validate && $cancelPeriods[$i]->validate();
                            }
                            foreach($longPeriods as $i => $period){
                                $validate = $validate && $longPeriods[$i]->validate();
                            }
                            foreach($earlyPeriods as $i => $period){
                                $validate = $validate && $earlyPeriods[$i]->validate();
                            }
                            foreach($transitLogs as $i => $log){
                                $validate = $validate && $transitLogs[$i]->validate();
                            }
                            foreach($orderOptions as $i => $option){
                                $validate = $validate && $orderOptions[$i]->validate();
                            }

                            if($validate) {
                                $modelUser->save();
                                $profileUser->save();

                                if(!empty($profileCC->company_logo)){
                                    if(preg_match('/\/upload/',$profileCC->company_logo)){
                                        $ext = preg_replace('/.+?\./','',$profileCC->company_logo);
                                        $logoName = '/i/cc/'.md5(time()+rand()).'.'.$ext;
                                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileCC->company_logo,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$logoName)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileCC->company_logo);
                                            $profileCC->company_logo = $logoName;
                                        } else {
                                            $profileCC->company_logo = null;
                                        }
                                        if(file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldLogo)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldLogo);
                                        }
                                    }
                                }

                                $profileCC->save();

                                foreach($profileCC->ccPaymentsPeriods as $period){
                                    $period->delete();
                                }
                                foreach($paymentsPeriods as $period){
                                    $period->save(false);
                                }

                                foreach($profileCC->ccCancelPeriods as $period){
                                    $period->delete();
                                }
                                foreach($cancelPeriods as $period){
                                    $period->save(false);
                                }

                                foreach($profileCC->ccLongPeriods as $period){
                                    $period->delete();
                                }
                                foreach($longPeriods as $period){
                                    $period->save(false);
                                }

                                foreach($profileCC->ccEarlyPeriods as $period){
                                    $period->delete();
                                }
                                foreach($earlyPeriods as $period){
                                    $period->save(false);
                                }

                                foreach($profileCC->ccTransitLogs as $period){
                                    $period->delete();
                                }
                                foreach($transitLogs as $log){
                                    $log->save(false);
                                }

                                foreach($profileCC->ccOrderOptions as $period){
                                    $period->delete();
                                }
                                foreach($orderOptions as $option){
                                    $option->save(false);
                                }

                                Yii::app()->user->updateSession();
                                Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("Changes are saved."));
                                $this->redirect(array('/profile'));
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

}
