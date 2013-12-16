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

    public function actionView($id=null){
        $this->renderProfile($id);
    }

    public function actionIndex(){
        $this->renderProfile();
    }

    protected function renderProfile($id=null){
        if(Yii::app()->user->checkAccess('Administrator') && is_null($id)){
            $this->redirect('/user/profile');
        }
        $model = $this->loadUser($id);
        if($model){
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
            $role = (Yii::app()->user->checkAccess('C') ? 'C' : (Yii::app()->user->checkAccess('CC') ? 'CC' : (!is_null(Yii::app()->user->id) ? 'M' : '')));
            if(Yii::app()->user->checkAccess('Administrator')){
                $role = 'A';
            }
            $owner = $id==Yii::app()->user->id?true:false;
            if(!$owner){
                $this->layout = '//layouts/column1';
            }
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
}
