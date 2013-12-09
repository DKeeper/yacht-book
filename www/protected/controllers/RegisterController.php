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
            if($_POST['type_register']==="0"){
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('/register/captain'));
            } else {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('/register/company'));
            }
        }
        $this->render('index');
    }

    public function actionCaptain(){
        $this->render('captain');
    }

    public function actionCompany(){
        $this->render('company');
    }
}
