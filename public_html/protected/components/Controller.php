<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    protected  $_modelUser;

    /**
     * @param $id
     * @return User
     */
    protected function loadUser($id=null)
    {
        if(isset($id)){
            $this->_modelUser=User::model()->findByPk($id);
        }
        elseif($this->_modelUser===null)
        {
            if(Yii::app()->user->id)
                $this->_modelUser=Yii::app()->getModule('user')->user();
            if($this->_modelUser===null)
                $this->redirect(Yii::app()->getModule('user')->loginUrl);
        }
        return $this->_modelUser;
    }

    /**
     * @param $model User
     * @return array
     */
    protected function checkAccess($model){
        if(Rights::getAuthorizer()->isSuperuser($model->id)===true){
            $this->redirect('/');
        }
        $id = $model->id;
        $profileCC=$profileC=$profileM=null;
        /** @var $profileCC CcProfile */
        $profileCC = CcProfile::model()->findByAttributes(array('cc_id'=>$id));
        $view = 'CC';
        if(!isset($profileCC)){
            /** @var $profileC CProfile */
            $profileC = CProfile::model()->findByAttributes(array('c_id'=>$id));
            $view = 'C';
            if(!isset($profileC)){
                /** @var $profileM MProfile */
                $profileM = MProfile::model()->findByAttributes(array('m_id'=>$id));
                $profileCC = CcProfile::model()->findByAttributes(array("cc_id"=>$profileM->cc_id));
                $view = 'M';
            }
        }
        $role = (Yii::app()->user->checkAccess('C') ? 'C' : (Yii::app()->user->checkAccess('CC') ? 'CC' : (Yii::app()->user->checkAccess('M') ? 'M' : '')));
        if(Yii::app()->user->checkAccess('Administrator')){
            $role = 'A';
        }
        $owner = $id==Yii::app()->user->id?true:false;
        if( $role=='CC' && $view == 'M'){
            if($profileM->cc_id == Yii::app()->user->id){
                $owner = true;
            }
        }
        if( $role == 'A'){
            $owner = true;
        }
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