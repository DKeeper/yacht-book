<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 14.12.13
 * @time 14:28
 * Created by JetBrains PhpStorm.
 */
class AdminController extends Controller
{
    public function filters()
    {
        return array(
            'rights',
        );
    }

    public function actionIndex(){
        $company = new CcProfile('search');
        $company->unsetAttributes();
        $captain = new CProfile('search');
        $captain->unsetAttributes();
        $manager = new MProfile('search');
        $manager->unsetAttributes();

        if(isset($_GET['CcProfile']))
            $company->attributes=$_GET['CcProfile'];
        if(isset($_GET['CProfile']))
            $captain->attributes=$_GET['CProfile'];
        if(isset($_GET['CcProfile']))
            $manager->attributes=$_GET['MProfile'];

        $this->render('index',array(
            'company' => $company,
            'captain' => $captain,
            'manager' => $manager,
        ));
    }
}
