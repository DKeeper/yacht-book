<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $yacht_id
 * @property integer $yacht_name
 * @property double $yacht_latitude
 * @property double $yacht_longitude
 * @property integer $captain_id
 * @property integer $manager_id
 * @property string $date_from
 * @property integer $duration
 * @property integer $duration_type_id
 * @property integer $status_id
 * @property string $status_end
 * @property double $base_price
 * @property double $site_price
 * @property integer $repeater
 * @property integer $_long
 * @property integer $early
 * @property integer $extra
 * @property double $charter_price
 * @property integer $site_commission
 * @property double $total
 * @property double $additional_price
 * @property string $additional_text
 *
 * The followings are the available model relations:
 * @property CcQuestionnaire[] $ccQuestionnaires
 * @property Message[] $messages
 * @property OrderStatusHistory[] $orderStatusHistories
 * @property CcFleets $yacht
 * @property User $captain
 * @property User $manager
 * @property OrderStatus $status
 * @property DurationType $durationType
 */
class Orders extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('yacht_name, yacht_latitude, yacht_longitude, date_from, duration, duration_type_id, status_id, base_price, site_price, charter_price, site_commission, total', 'required'),
			array('yacht_id, yacht_name, captain_id, manager_id, duration, duration_type_id, status_id, repeater, _long, early, extra, site_commission', 'numerical', 'integerOnly'=>true),
			array('yacht_latitude, yacht_longitude, base_price, site_price, charter_price, total, additional_price', 'numerical'),
			array('status_end, additional_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, yacht_id, yacht_name, yacht_latitude, yacht_longitude, captain_id, manager_id, date_from, duration, duration_type_id, status_id, status_end, base_price, site_price, repeater, _long, early, extra, charter_price, site_commission, total, additional_price, additional_text', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'ccQuestionnaires' => array(self::HAS_MANY, 'CcQuestionnaire', 'order_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'order_id'),
			'orderStatusHistories' => array(self::HAS_MANY, 'OrderStatusHistory', 'order_id'),
			'yacht' => array(self::BELONGS_TO, 'CcFleets', 'yacht_id'),
			'captain' => array(self::BELONGS_TO, 'User', 'captain_id'),
			'manager' => array(self::BELONGS_TO, 'User', 'manager_id'),
			'status' => array(self::BELONGS_TO, 'OrderStatus', 'status_id'),
			'durationType' => array(self::BELONGS_TO, 'DurationType', 'duration_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'yacht_id' => Yii::t('model','Yacht'),
			'yacht_name' => Yii::t('model','Yacht name'),
			'yacht_latitude' => Yii::t('model','Yacht latitude'),
			'yacht_longitude' => Yii::t('model','Yacht longitude'),
			'captain_id' => Yii::t('model','C'),
			'manager_id' => Yii::t('model','M'),
			'date_from' => Yii::t('model','Date from'),
			'duration' => Yii::t('model','Duration'),
			'duration_type_id' => Yii::t('model','Duration type'),
			'status_id' => Yii::t('model','Status'),
			'status_end' => Yii::t('model','Status end'),
			'base_price' => Yii::t('model','base price'),
			'site_price' => Yii::t('model','site price'),
			'repeater' => Yii::t('model','Repeater'),
			'_long' => Yii::t('model','Long'),
			'early' => Yii::t('model','Early'),
			'extra' => Yii::t('model','Extra'),
			'charter_price' => Yii::t('model','Charter price'),
			'site_commission' => Yii::t('model','Site commission'),
			'total' => Yii::t('model','Total'),
			'additional_price' => Yii::t('model','Additional price'),
			'additional_text' => Yii::t('model','Additional text'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('yacht_id',$this->yacht_id);
		$criteria->compare('yacht_name',$this->yacht_name);
		$criteria->compare('yacht_latitude',$this->yacht_latitude);
		$criteria->compare('yacht_longitude',$this->yacht_longitude);
		$criteria->compare('captain_id',$this->captain_id);
		$criteria->compare('manager_id',$this->manager_id);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('duration_type_id',$this->duration_type_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('status_end',$this->status_end,true);
		$criteria->compare('base_price',$this->base_price);
		$criteria->compare('site_price',$this->site_price);
		$criteria->compare('repeater',$this->repeater);
		$criteria->compare('_long',$this->_long);
		$criteria->compare('early',$this->early);
		$criteria->compare('extra',$this->extra);
		$criteria->compare('charter_price',$this->charter_price);
		$criteria->compare('site_commission',$this->site_commission);
		$criteria->compare('total',$this->total);
		$criteria->compare('additional_price',$this->additional_price);
		$criteria->compare('additional_text',$this->additional_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
