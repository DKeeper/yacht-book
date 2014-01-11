<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 03.12.13
 * @time 14:52
 * Created by JetBrains PhpStorm.
 */
class AController extends Controller
{
    public function filters()
    {
        return array(
            'rights',
        );
    }

    public function allowedActions(){
        return 'index';
    }

    public function actionIndex(){
        $model = SyProfile::model();
        $this->render('index',array('model'=>$model));
    }
}
