<?php

/**
 * This is the model class for table "cc_payments_period".
 *
 * The followings are the available columns in table 'cc_payments_period':
 * @property integer $id
 * @property integer $cc_profile_id
 * @property double $value
 * @property integer $before_duration
 * @property integer $duration_type_id
 *
 * The followings are the available model relations:
 * @property CcProfile $ccProfile
 * @property DurationType $durationType
 */
class CcPaymentsPeriod extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cc_payments_period';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc_profile_id, value, before_duration, duration_type_id', 'required'),
			array('cc_profile_id, before_duration, duration_type_id', 'numerical', 'integerOnly'=>true),
			array('value', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cc_profile_id, value, before_duration, duration_type_id', 'safe', 'on'=>'search'),
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
			'ccProfile' => array(self::BELONGS_TO, 'CcProfile', 'cc_profile_id'),
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
			'cc_profile_id' => Yii::t('model','СС profile'),
			'value' => Yii::t('model','Value'),
			'before_duration' => Yii::t('model','Before duration'),
			'duration_type_id' => Yii::t('model','Duration type'),
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
		$criteria->compare('cc_profile_id',$this->cc_profile_id);
		$criteria->compare('value',$this->value);
		$criteria->compare('before_duration',$this->before_duration);
		$criteria->compare('duration_type_id',$this->duration_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CcPaymentsPeriod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
