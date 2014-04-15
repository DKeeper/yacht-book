<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
    public $ajax;

    public $validate;

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
            return array(
                null,
                null,
                null,
                null,
                'A',
                true
            );
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

    public function renderRow($model,$attribute='',$options=array()){
        $validate = true;
        if(!isset($options['outtype'])){
            $options['outtype'] = '';
        }
        if(isset($options['validator'])){
            $c = get_class($model);
            /** @var $validateModel BaseModel */
            $validateModel = new $c;
            $validateModel->$attribute = $model->$attribute;
            /** @var $compareValidator CValidator */
            $compareValidator = CValidator::createValidator($options['validator'][0],$validateModel,$attribute,$options['validator']['params']);
            $compareValidator->validate($validateModel,$attribute);
            if($validateModel->hasErrors()){
                $validate = false;
            }
        }
        $_ = "<div class='col-md-1'>";
        if(!isset($model->$attribute)){
            if(!$validate){
                if(!isset($options['value'])){
                    $_ .= "<span class='glyphicon glyphicon-question-sign'></span>";
                }
            } else {
                if(!isset($options['value'])){
                    $_ .= "<span class='glyphicon glyphicon-remove-sign'></span>";
                }
            }
        } else {
            if(!$validate){
                $_ .= "<span class='glyphicon glyphicon-question-sign'></span>";
            } else {
                switch($options['outtype']){
                    case 'checkbox':
                        if($model->$attribute){
                            $_ .= "<span class='glyphicon glyphicon-ok text-success'></span>";
                        } else {
                            $_ .= "<span class='glyphicon glyphicon-remove text-danger'></span>";
                        }
                        break;
                }
            }
        }
        $_ .= "</div>
            <div class='col-md-7' style='white-space: nowrap;'>
        ";
        if(isset($options['label'])){
            $_ .= $options['label'];
        } else {
            $_ .= Yii::t("view",$attribute);
        }
        $_ .= "</div>
            <div class='col-md-3' style='white-space: nowrap;'>
        ";
        if(isset($model->$attribute) || isset($options['value'])){
            switch($options['outtype']){
                case 'checkbox':
                    if(isset($options['value']) && $model->$attribute){
                        $_ .= $options['value'];
                        if(isset($options['measure'])){
                            $_ .= " ".$options['measure'];
                        }
                    }
                    break;
                default:
                    if(isset($options['value'])){
                        $_ .= $options['value'];
                    } else {
                        $_ .= $model->$attribute;
                    }
                    if(isset($options['measure'])){
                        $_ .= " ".$options['measure'];
                    }
                    break;
            }
        }
        $_ .= "</div>";
        $htmlOptions = array(
            'class'=>'row',
        );
        if(!isset($model->$attribute) && !isset($options['value'])){
            $htmlOptions['class'] .= " text-muted";
        }
        if(!$validate){
            $htmlOptions['class'] .= " text-danger";
            $htmlOptions['title'] = $validateModel->getError($attribute);
            if(isset($options['form'])){
                $_ .= $options['form'];
            }
        }
        $this->validate = $this->validate && $validate;
        return CHtml::tag('div',$htmlOptions,$_);
    }
}