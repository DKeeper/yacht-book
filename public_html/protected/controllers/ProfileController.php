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
            $saveMode = isset($_POST['save_mode'])?$_POST['save_mode']:-1;
            switch($view){
                /** Блок редактирования Капитана */
                case 'C':
                    if($role === "C" || $role === "A"){
                        if($role === "C" && !$owner){
                            $this->redirect("/profile/edit/".Yii::app()->user->id);
                        }
                        /** @var $profileC CProfile */
                        $profileC = CProfile::model()->findByAttributes(array("c_id"=>$modelUser->id));
                        /** Правим даты */
                        if(!empty($_POST['CProfile']['expire_date'])){
                            $_POST['CProfile']['expire_date'] = date('Y-m-d',strtotime($_POST['CProfile']['expire_date']));
                        }
                        if(!empty($_POST['CProfile']['date_of_birth'])){
                            $_POST['CProfile']['date_of_birth'] = date('Y-m-d',strtotime($_POST['CProfile']['date_of_birth']));
                        }
                        if(!empty($_POST['CProfile']['date_issued'])){
                            $_POST['CProfile']['date_issued'] = date('Y-m-d',strtotime($_POST['CProfile']['date_issued']));
                        }
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
                                        $avatarName = '/i/c/'.md5(time()+rand()).'.'.$ext;
                                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileC->avatar,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$avatarName)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileC->avatar);
                                            $profileC->avatar = $avatarName;
                                        } else {
                                            $profileC->avatar = null;
                                        }
                                        if(!empty($oldAvatar) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar);
                                        }
                                    }
                                } else {
                                    if(!empty($oldAvatar) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar)){
                                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar);
                                    }
                                }

                                if(!empty($profileC->scan_of_license)){
                                    if(preg_match('/\/upload/',$profileC->scan_of_license)){
                                        $ext = preg_replace('/.+?\./','',$profileC->scan_of_license);
                                        $scanOfLicenseName = '/i/c/'.md5(time()+rand()).'.'.$ext;
                                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileC->scan_of_license,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanOfLicenseName)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileC->scan_of_license);
                                            $profileC->scan_of_license = $scanOfLicenseName;
                                        } else {
                                            $profileC->scan_of_license = null;
                                        }
                                        if(!empty($oldScanOfLicense) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldScanOfLicense)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldScanOfLicense);
                                        }
                                    }
                                } else {
                                    if(!empty($oldScanOfLicense) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldScanOfLicense)){
                                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldScanOfLicense);
                                    }
                                }

                                $profileC->save();

                                if($saveMode==-1){
                                    Yii::app()->user->updateSession();
                                    Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("Changes are saved."));
                                    $this->redirect(array('/profile'));
                                } else {
                                    $profileC = CProfile::model()->findByAttributes(array("c_id"=>$modelUser->id));
                                }
                            }
                        }
                        $this->render('edit_captain',
                            array(
                                'modelUser'=>$modelUser,
                                'profileUser'=>$profileUser,
                                'profileC'=>$profileC,
                                'save_mode'=>$saveMode,
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
                        if(!empty($_POST['CcProfile']['last_minute_date_from'])){
                            $_POST['CcProfile']['last_minute_date_from'] = date('Y-m-d',strtotime($_POST['CcProfile']['last_minute_date_from']));
                        }
                        if(!empty($_POST['CcProfile']['last_minute_date_to'])){
                            $_POST['CcProfile']['last_minute_date_to'] = date('Y-m-d',strtotime($_POST['CcProfile']['last_minute_date_to']));
                        }
                        /** @var $profileCC CcProfile */
                        $profileCC = CcProfile::model()->findByAttributes(array("cc_id"=>$modelUser->id));
                        /** @var $paymentsPeriods CcPaymentsPeriod[] */
                        $paymentsPeriods = array();
                        /** @var $cancelPeriods CcCancelPeriod[] */
                        $cancelPeriods = array();
                        /** @var $longPeriods CcLongPeriod[] */
                        $longPeriods = array();
                        /** @var $earlyPeriods CcEarlyPeriod[] */
                        $earlyPeriods = array();
                        /** @var $transitLogs CcTransitLog[] */
                        $transitLogs = array();
                        /** @var $orderOptions CcOrderOptions[] */
                        $orderOptions = array();
                        /** @var $languages CcLanguage[] */
                        $languages = array();
                        if(isset($_POST['CcProfile']['ccLanguages'])){
                            foreach($_POST['CcProfile']['ccLanguages'] as $i => $item){
                                $languages[$i] = new CcLanguage;
                                $languages[$i]->cc_profile_id = $profileCC->id;
                                $languages[$i]->language_id = $item;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $languages = $profileCC->ccLanguages;
                        }
                        if(isset($_POST['CcPaymentsPeriod'])){
                            foreach($_POST['CcPaymentsPeriod'] as $i => $item){
                                $paymentsPeriods[$i] = new CcPaymentsPeriod;
                                $paymentsPeriods[$i]->attributes = $item;
                                $paymentsPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $paymentsPeriods = $profileCC->ccPaymentsPeriods;
                        }
                        if(isset($_POST['CcCancelPeriod'])){
                            foreach($_POST['CcCancelPeriod'] as $i => $item){
                                $cancelPeriods[$i] = new CcCancelPeriod;
                                $cancelPeriods[$i]->attributes = $item;
                                $cancelPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $cancelPeriods = $profileCC->ccCancelPeriods;
                        }
                        if(isset($_POST['CcLongPeriod'])){
                            foreach($_POST['CcLongPeriod'] as $i => $item){
                                $longPeriods[$i] = new CcLongPeriod;
                                $longPeriods[$i]->attributes = $item;
                                $longPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $longPeriods = $profileCC->ccLongPeriods;
                        }
                        if(isset($_POST['CcEarlyPeriod'])){
                            foreach($_POST['CcEarlyPeriod'] as $i => $item){
                                $earlyPeriods[$i] = new CcEarlyPeriod;
                                $earlyPeriods[$i]->attributes = $item;
                                $earlyPeriods[$i]->cc_profile_id = $profileCC->id;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $earlyPeriods = $profileCC->ccEarlyPeriods;
                        }
                        if(isset($_POST['CcTransitLog'])){
                            foreach($_POST['CcTransitLog'] as $i => $item){
                                $transitLogs[$i] = new CcTransitLog;
                                $transitLogs[$i]->attributes = $item;
                                $transitLogs[$i]->cc_profile_id = $profileCC->id;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $transitLogs = $profileCC->ccTransitLogs;
                        }
                        if(isset($_POST['CcOrderOptions'])){
                            foreach($_POST['CcOrderOptions'] as $i => $item){
                                $orderOptions[$i] = new CcOrderOptions;
                                $orderOptions[$i]->attributes = $item;
                                $orderOptions[$i]->cc_profile_id = $profileCC->id;
                            }
                        } elseif (!isset($_POST['CcProfile'])) {
                            $orderOptions = $profileCC->ccOrderOptions;
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
                                        if(!empty($oldLogo) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldLogo)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldLogo);
                                        }
                                    }
                                } else {
                                    if(!empty($oldLogo) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldLogo)){
                                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldLogo);
                                    }
                                }

                                $profileCC->save();

                                foreach($profileCC->ccLanguages as $language){
                                    $language->delete();
                                }
                                foreach($languages as $language){
                                    $language->save(false);
                                }

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

                                if($saveMode==-1){
                                    Yii::app()->user->updateSession();
                                    Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("Changes are saved."));
                                    $this->redirect(array('/profile'));
                                } else {
                                    $profileCC = CcProfile::model()->findByAttributes(array("cc_id"=>$modelUser->id));
                                    $earlyPeriods = $profileCC->ccEarlyPeriods;
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
                                'save_mode'=>$saveMode,
                            )
                        );
                    } else {
                        $this->redirect("/profile/edit/".Yii::app()->user->id);
                    }
                    break;
                /** Конец блока редактирования ЧК */
                case 'M':
                    if($role === "CC" || $role === "M" || $role === "A"){
                        /** @var $profileM MProfile */
                        $profileM = MProfile::model()->findByAttributes(array("m_id"=>$modelUser->id));

                        if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
                        {
                            echo UActiveForm::validate(array($modelUser,$profileUser,$profileM));
                            Yii::app()->end();
                        }
                        if(isset($_POST['User'])) {
                            $modelUser->attributes=$_POST['User'];
                            $profileUser->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));

                            $oldAvatar = $profileM->avatar;
                            $profileM->attributes=((isset($_POST['MProfile'])?$_POST['MProfile']:array()));

                            $validate = true;
                            $validate = $validate && $modelUser->validate();
                            $validate = $validate && $profileUser->validate();
                            $validate = $validate && $profileM->validate();

                            if($validate){
                                $modelUser->save();
                                $profileUser->save();

                                if(!empty($profileM->avatar)){
                                    if(preg_match('/\/upload/',$profileM->avatar)){
                                        $ext = preg_replace('/.+?\./','',$profileM->avatar);
                                        $avatarName = '/i/m/'.md5(time()+rand()).'.'.$ext;
                                        if(copy(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileM->avatar,Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$avatarName)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$profileM->avatar);
                                            $profileM->avatar = $avatarName;
                                        } else {
                                            $profileM->avatar = null;
                                        }
                                        if(!empty($oldAvatar) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar)){
                                            unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar);
                                        }
                                    }
                                } else {
                                    if(!empty($oldAvatar) && file_exists(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar)){
                                        unlink(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$oldAvatar);
                                    }
                                }

                                $profileM->save(false);

                                if($saveMode==-1){
                                    Yii::app()->user->updateSession();
                                    Yii::app()->user->setFlash('profileMessageSuccess',UserModule::t("Changes are saved."));
                                    $this->redirect(array('/profile'));
                                }
                            }
                        }
                        $this->render('edit_manager',
                            array(
                                'modelUser'=>$modelUser,
                                'profileUser'=>$profileUser,
                                'profileM'=>$profileM,
                                'save_mode'=>$saveMode,
                            )
                        );
                    } else {
                        $this->redirect("/profile/edit/".Yii::app()->user->id);
                    }
                    break;
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
