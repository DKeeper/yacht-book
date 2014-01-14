<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 09.12.13
 * @time 15:38
 * Created by JetBrains PhpStorm.
 */
class RegisterController extends Controller
{
    public function filters()
    {
        return array(
            'rights',
        );
    }

    public function allowedActions(){
        return 'index, captain, company';
    }

    public function actionIndex(){
        if(isset($_POST['type_register'])){
            switch($_POST['type_register']){
                case "0":
                    Yii::app()->request->redirect($this->createAbsoluteUrl('/register/captain'));
                    break;
                case "1":
                    Yii::app()->request->redirect($this->createAbsoluteUrl('/register/company'));
                    break;
                case "2":
                    Yii::app()->request->redirect($this->createAbsoluteUrl('/register/manager'));
                    break;
            }
        }
        $this->render('index');
    }

    public function actionCaptain(){
        $modelUser = new RegistrationForm;
        $profileUser = new Profile;
        $profileUser->regMode = true;
        $profileC = new CProfile;
        $profileC->c_id = -1;
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo UActiveForm::validate(array($modelUser,$profileUser,$profileC));
            Yii::app()->end();
        }
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->getModule('user')->profileUrl);
        } else {
            if(isset($_POST['RegistrationForm'])) {
                $modelUser->scenario = 'registerwcaptcha';
                $modelUser->attributes=$_POST['RegistrationForm'];
                $profileUser->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
                $profileC->attributes=((isset($_POST['CProfile'])?$_POST['CProfile']:array()));
                if($modelUser->validate()&&$profileUser->validate()&&$profileC->validate())
                {
                    $modelUser->setScenario(null);
                    $soucePassword = $modelUser->password;
                    $modelUser->activkey=UserModule::encrypting(microtime().$modelUser->password);
                    $modelUser->password=UserModule::encrypting($modelUser->password);
                    $modelUser->verifyPassword=UserModule::encrypting($modelUser->verifyPassword);
                    $modelUser->superuser=0;
                    $modelUser->status=((Yii::app()->getModule('user')->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                    if ($modelUser->save()) {
                        // Присваиваем роль Капитан
                        Yii::app()->getAuthManager()->assign("C", $modelUser->id);
                        // Отправляем письмо администратору
                        UserModule::sendMail(Yii::app()->params['adminEmail'],'Регистрация новой учетной записи','Зарегистрирован новый <a href="'.$this->createAbsoluteUrl('user/admin/view',array('id'=>$modelUser->id)).'">капитан</a>');
                        $profileC->c_id = $modelUser->id;
                        $avatar = CUploadedFile::getInstance($profileC,'avatar');
                        if(isset($avatar)){
                            $ext = preg_replace('/image\/|application\//','',$avatar->getType());
                            $avatarName = '/i/c/'.md5(time()+rand()).'.'.$ext;
                            if($avatar->saveAs(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$avatarName)){
                                $profileC->avatar = $avatarName;
                            }
                        }
                        $scan_of_license = CUploadedFile::getInstance($profileC,'scan_of_license');
                        if(isset($scan_of_license)){
                            $ext = preg_replace('/image\/|application\//','',$scan_of_license->getType());
                            $scanOfLicenseName = '/i/c/'.md5(time()+rand()).'.'.$ext;
                            if($scan_of_license->saveAs(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$scanOfLicenseName)){
                                $profileC->scan_of_license = $scanOfLicenseName;
                            }
                        }
                        $profileC->save(false);

                        $profileUser->user_id=$modelUser->id;
                        $profileUser->save();
                        if (Yii::app()->getModule('user')->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $modelUser->activkey, "email" => $modelUser->email));
                            UserModule::sendMail($modelUser->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t('Please activate you account go to <a href="{activation_url}">link</a>',array('{activation_url}'=>$activation_url)));
                        }

                        if ((Yii::app()->getModule('user')->loginNotActiv||(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false))&&Yii::app()->getModule('user')->autoLogin) {
                            $identity=new UserIdentity($modelUser->username,$soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity,0);
                            $this->redirect(Yii::app()->getModule('user')->returnUrl);
                        } else {
                            if (!Yii::app()->getModule('user')->activeAfterRegister&&!Yii::app()->getModule('user')->sendActivationMail) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->getModule('user')->loginUrl))));
                            } elseif(Yii::app()->getModule('user')->loginNotActiv) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                } else {
                    $profileUser->validate();
                    $profileC->validate();
                }
            }
            $this->render('captain',array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'profileC'=>$profileC));
        }
    }

    public function actionCompany(){
        $modelUser = new RegistrationForm;
        $profileUser = new Profile;
        $profileUser->regMode = true;
        $profileCC = new CcProfile;
        $profileCC->cc_id = -1;
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

        if(isset($_POST['CcPaymentsPeriod'])){
            foreach($_POST['CcPaymentsPeriod'] as $i => $item){
                $paymentsPeriods[$i] = new CcPaymentsPeriod;
                $paymentsPeriods[$i]->attributes = $item;
                $paymentsPeriods[$i]->cc_profile_id = -1;
            }
        }
        if(isset($_POST['CcCancelPeriod'])){
            foreach($_POST['CcCancelPeriod'] as $i => $item){
                $cancelPeriods[$i] = new CcCancelPeriod;
                $cancelPeriods[$i]->attributes = $item;
                $cancelPeriods[$i]->cc_profile_id = -1;
            }
        }
        if(isset($_POST['CcLongPeriod'])){
            foreach($_POST['CcLongPeriod'] as $i => $item){
                $longPeriods[$i] = new CcLongPeriod;
                $longPeriods[$i]->attributes = $item;
                $longPeriods[$i]->cc_profile_id = -1;
            }
        }
        if(isset($_POST['CcEarlyPeriod'])){
            foreach($_POST['CcEarlyPeriod'] as $i => $item){
                $earlyPeriods[$i] = new CcEarlyPeriod;
                $earlyPeriods[$i]->attributes = $item;
                $earlyPeriods[$i]->cc_profile_id = -1;
            }
        }
        if(isset($_POST['CcTransitLog'])){
            foreach($_POST['CcTransitLog'] as $i => $item){
                $transitLogs[$i] = new CcTransitLog;
                $transitLogs[$i]->attributes = $item;
                $transitLogs[$i]->cc_profile_id = -1;
            }
        }
        if(isset($_POST['CcOrderOptions'])){
            foreach($_POST['CcOrderOptions'] as $i => $item){
                $orderOptions[$i] = new CcOrderOptions;
                $orderOptions[$i]->attributes = $item;
                $orderOptions[$i]->cc_profile_id = -1;
            }
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
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
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->getModule('user')->profileUrl);
        } else {
            if(isset($_POST['RegistrationForm'])) {
                $modelUser->scenario = 'registerwcaptcha';
                $modelUser->attributes=$_POST['RegistrationForm'];
                $profileUser->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
                $profileCC->attributes=((isset($_POST['CcProfile'])?$_POST['CcProfile']:array()));

                $validate = true;
                $validate = $validate && $modelUser->validate();
                $validate = $validate && $profileUser->validate();
                $validate = $validate && $profileCC->validate();
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
                    $modelUser->setScenario(null);
                    $soucePassword = $modelUser->password;
                    $modelUser->activkey=UserModule::encrypting(microtime().$modelUser->password);
                    $modelUser->password=UserModule::encrypting($modelUser->password);
                    $modelUser->verifyPassword=UserModule::encrypting($modelUser->verifyPassword);
                    $modelUser->superuser=0;
                    $modelUser->status=((Yii::app()->getModule('user')->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                    if ($modelUser->save()) {
                        // Присваиваем роль Чартерная компания
                        Yii::app()->getAuthManager()->assign("CC", $modelUser->id);
                        // Отправляем письмо администратору
                        UserModule::sendMail(Yii::app()->params['adminEmail'],'Регистрация новой учетной записи','Зарегистрирована новая <a href="'.$this->createAbsoluteUrl('user/admin/view',array('id'=>$modelUser->id)).'">чартерная компания</a>');
                        $profileCC->cc_id = $modelUser->id;
                        $companyLogo = CUploadedFile::getInstance($profileCC,'company_logo');
                        if(isset($companyLogo)){
                            $ext = preg_replace('/image\//','',$companyLogo->getType());
                            $logoName = '/i/cc/'.md5(time()+rand()).'.'.$ext;
                            if($companyLogo->saveAs(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$logoName)){
                                $profileCC->company_logo = $logoName;
                            }
                        }
                        $profileCC->save(false);

                        foreach($paymentsPeriods as $period){
                            $period->cc_profile_id = $profileCC->id;
                            $period->save(false);
                        }

                        foreach($cancelPeriods as $period){
                            $period->cc_profile_id = $profileCC->id;
                            $period->save(false);
                        }

                        foreach($longPeriods as $period){
                            $period->cc_profile_id = $profileCC->id;
                            $period->save(false);
                        }

                        foreach($earlyPeriods as $period){
                            $period->cc_profile_id = $profileCC->id;
                            $period->save(false);
                        }

                        foreach($transitLogs as $log){
                            $log->cc_profile_id = $profileCC->id;
                            $log->save(false);
                        }

                        foreach($orderOptions as $option){
                            $option->cc_profile_id = $profileCC->id;
                            $option->save(false);
                        }

                        $profileUser->user_id=$modelUser->id;
                        $profileUser->save();

                        if (Yii::app()->getModule('user')->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $modelUser->activkey, "email" => $modelUser->email));
                            UserModule::sendMail($modelUser->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                        }

                        if ((Yii::app()->getModule('user')->loginNotActiv||(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false))&&Yii::app()->getModule('user')->autoLogin) {
                            $identity=new UserIdentity($modelUser->username,$soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity,0);
                            $this->redirect(Yii::app()->getModule('user')->returnUrl);
                        } else {
                            if (!Yii::app()->getModule('user')->activeAfterRegister&&!Yii::app()->getModule('user')->sendActivationMail) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->getModule('user')->loginUrl))));
                            } elseif(Yii::app()->getModule('user')->loginNotActiv) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                }
            }
            $this->render('company',
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
        }
    }

    public function actionManager(){
        $modelUser = new RegistrationForm;
        $profileUser = new Profile;
        $profileUser->regMode = true;
        $profileM = new MProfile();
        $profileM->m_id = -1;
        $profileM->cc_id = -1;
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo UActiveForm::validate(array($modelUser,$profileUser,$profileM));
            Yii::app()->end();
        }
        if(isset($_POST['RegistrationForm'])) {
            $modelUser->scenario = 'registerwcaptcha';
            $modelUser->attributes=$_POST['RegistrationForm'];
            $profileUser->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
            $profileM->attributes=((isset($_POST['MProfile'])?$_POST['MProfile']:array()));
            if($modelUser->validate()&&$profileUser->validate()&&$profileM->validate())
            {
                $modelUser->setScenario(null);
                $soucePassword = $modelUser->password;
                $modelUser->activkey=UserModule::encrypting(microtime().$modelUser->password);
                $modelUser->password=UserModule::encrypting($modelUser->password);
                $modelUser->verifyPassword=UserModule::encrypting($modelUser->verifyPassword);
                $modelUser->superuser=0;
                $modelUser->status=((Yii::app()->getModule('user')->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                if ($modelUser->save()) {
                    // Присваиваем роль Менеджер
                    Yii::app()->getAuthManager()->assign("M", $modelUser->id);
                    // Отправляем письмо администратору
                    UserModule::sendMail(Yii::app()->params['adminEmail'],'Регистрация новой учетной записи','Зарегистрирован новый <a href="'.$this->createAbsoluteUrl('user/admin/view',array('id'=>$modelUser->id)).'">менеджер</a>');
                    $profileM->m_id = $modelUser->id;
                    $profileM->cc_id = Yii::app()->user->id;
                    $avatar = CUploadedFile::getInstance($profileM,'avatar');
                    if(isset($avatar)){
                        $ext = preg_replace('/image\//','',$avatar->getType());
                        $avatarName = '/i/m/'.md5(time()+rand()).'.'.$ext;
                        if($avatar->saveAs(Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'..'.$avatarName)){
                            $profileM->avatar = $avatarName;
                        }
                    }
                    $profileM->save(false);

                    $profileUser->user_id=$modelUser->id;
                    $profileUser->save();
                    if (Yii::app()->getModule('user')->sendActivationMail) {
                        $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $modelUser->activkey, "email" => $modelUser->email));
                        UserModule::sendMail($modelUser->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                    }

                    if ((Yii::app()->getModule('user')->loginNotActiv||(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false))&&Yii::app()->getModule('user')->autoLogin) {
                        $identity=new UserIdentity($modelUser->username,$soucePassword);
                        $identity->authenticate();
                        Yii::app()->user->login($identity,0);
                        $this->redirect(Yii::app()->getModule('user')->returnUrl);
                    } else {
                        if (!Yii::app()->getModule('user')->activeAfterRegister&&!Yii::app()->getModule('user')->sendActivationMail) {
                            Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                        } elseif(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false) {
                            Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->getModule('user')->loginUrl))));
                        } elseif(Yii::app()->getModule('user')->loginNotActiv) {
                            Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                        } else {
                            Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                        }
                        $this->refresh();
                    }
                }
            } else {
                $profileUser->validate();
                $profileM->validate();
            }
        }
        if(isset($_POST['ajax']) && $_POST['ajax']==='inline_create'){
            $this->renderPartial('manager',array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'profileM'=>$profileM),false,true);
        } else {
            $this->render('manager',array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'profileM'=>$profileM));
        }
    }
}
