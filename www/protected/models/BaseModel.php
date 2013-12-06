<?php
/**
 * @author Капенкин Дмитрий <dkapenkin@rambler.ru>
 * @date 26.11.13
 * @time 13:58
 * Created by JetBrains PhpStorm.
 */
class BaseModel extends CActiveRecord
{
    /**
     * @param array $fields
     * @param string $delimiter
     * @param string $condition
     * @param array $params
     * @return array
     */
    public function getModelList($fields=array(),$delimiter=' - ',$condition=array('order'=>'name'),$params=array()){
        $data = BaseModel::model(get_class($this))->findAll($condition,$params);
        $list = array();
        foreach($data as $model){
            $name = isset($model->name) ? $model->name : Yii::t('class',get_class($this))." ".$model->id;
            $list[$model->id] = $name;
            if(!empty($fields)){
                foreach($fields as $k => $f) {
                    if(is_numeric($k))
                        if(isset($model->$f))
                            $list[$model->id] .= $delimiter.strip_tags($model->$f);
                    if(is_string($k)) {
                        if(isset($model->$k))
                            if(is_array($f)){
                                $list[$model->id] .= self::recName($model,$k,$delimiter,$f);
                            } elseif(isset($model->$k->$f))
                                $list[$model->id] .= ' ('.strip_tags($model->$k->$f).')';
                    }
                }
            }
        }
        return $list;
    }

    private static function recName($model,$attribute,$delimiter,$fields){
        $data = $model->$attribute;
        $n = '';
        foreach($fields as $_ => $v){
            if(is_array($v)){
                $n = self::recName($data,$_,$delimiter,$v);
            } else {
                $n = $delimiter . $data->$_->$v;
            }
        }
        return $n;
    }

    public function rules(){
        $purifier = new CHtmlPurifier();
        $purifier->options = array(
            'HTML.AllowedElements' => array
            (
                'strong'    => TRUE,
                'em'        => TRUE,
                'ul'        => TRUE,
                'ol'        => TRUE,
                'li'        => TRUE,
                'p'         => TRUE,
                'span'      => TRUE,
            ),
            'HTML.AllowedAttributes' => array
            (
                '*.style'   => TRUE,
                '*.title'   => TRUE,
            ),
        );
        return array(
            array('name, description', 'filter', 'filter' => array($purifier, 'purify')),
            array('description', 'default', 'value' => null),
            array('name', 'required'),
        );
    }
}
