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
        return 'captcha, index, captain, company';
    }

    public function actions()
    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
        );
    }

    public function actionIndex(){
        if(isset($_POST['type_register'])){
            if($_POST['type_register']==="0"){
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('/register/captain'));
            } else {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('/register/company'));
            }
        }
        $this->render('index');
    }

    public function actionCaptain(){
        $modelUser = new RegistrationForm;
        $profileUser = new Profile;
        $profileUser->regMode = true;
        $profileC = new CProfile;
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo UActiveForm::validate(array($modelUser,$profileUser,$profileC));
            Yii::app()->end();
        }
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if(isset($_POST['RegistrationForm'])) {
                $modelUser->attributes=$_POST['RegistrationForm'];
                $profileUser->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
                $profileC->attributes=((isset($_POST['CProfile'])?$_POST['CProfile']:array()));
                if($modelUser->validate()&&$profileUser->validate()&&$profileC->validate())
                {
                    $soucePassword = $modelUser->password;
                    $modelUser->activkey=UserModule::encrypting(microtime().$modelUser->password);
                    $modelUser->password=UserModule::encrypting($modelUser->password);
                    $modelUser->verifyPassword=UserModule::encrypting($modelUser->verifyPassword);
                    $modelUser->superuser=0;
                    $modelUser->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                    if ($modelUser->save()) {
                        $profileUser->user_id=$modelUser->id;
                        $profileUser->save();
                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $modelUser->activkey, "email" => $modelUser->email));
                            UserModule::sendMail($modelUser->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                        }

                        if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
                            $identity=new UserIdentity($modelUser->username,$soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity,0);
                            $this->redirect(Yii::app()->controller->module->returnUrl);
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
                            } elseif(Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                } else $profileUser->validate();
            }
            $this->render('captain',array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'profileC'=>$profileC));
        }
    }

    public function actionCompany(){
        $modelUser = new RegistrationForm;
        $profileUser = new Profile;
        $profileUser->regMode = true;
        $profileCC = new CcProfile;
        if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
        {
            echo UActiveForm::validate(array($modelUser,$profileUser,$profileCC));
            Yii::app()->end();
        }
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if(isset($_POST['RegistrationForm'])) {
                $modelUser->attributes=$_POST['RegistrationForm'];
                $profileUser->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
                $profileCC->attributes=((isset($_POST['CProfile'])?$_POST['CProfile']:array()));
                if($modelUser->validate()&&$profileUser->validate()&&$profileCC->validate())
                {
                    $soucePassword = $modelUser->password;
                    $modelUser->activkey=UserModule::encrypting(microtime().$modelUser->password);
                    $modelUser->password=UserModule::encrypting($modelUser->password);
                    $modelUser->verifyPassword=UserModule::encrypting($modelUser->verifyPassword);
                    $modelUser->superuser=0;
                    $modelUser->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                    if ($modelUser->save()) {
                        $profileUser->user_id=$modelUser->id;
                        $profileUser->save();
                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $modelUser->activkey, "email" => $modelUser->email));
                            UserModule::sendMail($modelUser->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                        }

                        if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
                            $identity=new UserIdentity($modelUser->username,$soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity,0);
                            $this->redirect(Yii::app()->controller->module->returnUrl);
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
                            } elseif(Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                } else $profileUser->validate();
            }
            $this->render('company',array('modelUser'=>$modelUser,'profileUser'=>$profileUser,'profileCC'=>$profileCC));
        }
    }
}
