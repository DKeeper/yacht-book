<?php

/**
 * This is the model class for table "price_current_year".
 *
 * The followings are the available columns in table 'price_current_year':
 * @property integer $id
 * @property integer $yacht_id
 * @property string $date_from
 * @property integer $duration
 * @property integer $duration_type_id
 * @property double $price
 * @property double $deposit
 * @property double $deposit_insurance_price
 * @property double $deposit_insurance_deposit
 * @property integer $last_minute
 * @property integer $week_before
 * @property double $latitude
 * @property double $longitude
 *
 * The followings are the available model relations:
 * @property CcFleets $yacht
 * @property DurationType $durationType
 */
class PriceCurrentYear extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price_current_year';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('yacht_id, duration_type_id', 'required'),
			array('yacht_id, duration, duration_type_id, last_minute, week_before', 'numerical', 'integerOnly'=>true),
			array('price, deposit, deposit_insurance_price, deposit_insurance_deposit, latitude, longitude', 'numerical'),
			array('date_from', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, yacht_id, date_from, duration, duration_type_id, price, deposit, deposit_insurance_price, deposit_insurance_deposit, last_minute, week_before, latitude, longitude', 'safe', 'on'=>'search'),
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
			'yacht' => array(self::BELONGS_TO, 'CcFleets', 'yacht_id'),
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
			'date_from' => 'Date From',
			'duration' => 'Duration',
			'duration_type_id' => Yii::t('model','Duration type'),
			'price' => Yii::t('model','Price'),
			'deposit' => 'Deposit',
			'deposit_insurance_price' => 'Deposit Insurance Price',
			'deposit_insurance_deposit' => 'Deposit Insurance Deposit',
			'last_minute' => 'Last Minute',
			'week_before' => 'Week Before',
			'latitude' => Yii::t('model','Latitude'),
			'longitude' => Yii::t('model','Longitude'),
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
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('duration_type_id',$this->duration_type_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('deposit',$this->deposit);
		$criteria->compare('deposit_insurance_price',$this->deposit_insurance_price);
		$criteria->compare('deposit_insurance_deposit',$this->deposit_insurance_deposit);
		$criteria->compare('last_minute',$this->last_minute);
		$criteria->compare('week_before',$this->week_before);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PriceCurrentYear the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
