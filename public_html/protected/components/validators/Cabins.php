<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 17.03.14
 * @time 14:10
 * Created by JetBrains PhpStorm.
 */
class Cabins extends CValidator{
    public $compareAttributes;

    public $errorMessage = '{columns_labels} - must enter a value in at least one field';

    protected function validateAttribute($object, $attribute) {
        if(is_string($this->compareAttributes)){
            $this->compareAttributes = explode(',',$this->compareAttributes);
        }
        foreach($this->compareAttributes as $i=>$v){
            $this->compareAttributes[$i] = trim($v);
        }
        $hasError = true;
        foreach($this->compareAttributes as $attr){
            if(isset($object->$attr)){
                $hasError &= empty($object->$attr);
            }
        }
        if($hasError){
            $fieldsName = array();
            foreach($this->compareAttributes as $v){
                $fieldsName[] = $object->getAttributeLabel($v);
            }
            $message = Yii::t('model', $this->errorMessage, array(
                '{columns_labels}' => implode(', ', $fieldsName)
            ));
            $this->addError($object,$attribute,$message);
        }
    }
}
