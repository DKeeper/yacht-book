<?php

/**
 * This is the model class for table "cc_order_comfort_packs".
 *
 * The followings are the available columns in table 'cc_order_comfort_packs':
 * @property integer $id
 * @property integer $cc_profile_id
 * @property string $options_id
 * @property string $description
 * @property integer $obligatory
 * @property integer $included
 * @property double $price
 *
 * The followings are the available model relations:
 * @property CcProfile $ccProfile
 */
class CcOrderComfortPacks extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cc_order_comfort_packs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, cc_profile_id, options_id, description, price', 'required'),
			array('id, cc_profile_id, obligatory, included', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cc_profile_id, options_id, description, obligatory, included, price', 'safe', 'on'=>'search'),
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
			'options_id' => Yii::t('model','Options'),
			'description' => Yii::t('model','Description'),
			'obligatory' => Yii::t('model','Obligatory'),
			'included' => Yii::t('model','Included'),
			'price' => Yii::t('model','Price'),
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
		$criteria->compare('options_id',$this->options_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('obligatory',$this->obligatory);
		$criteria->compare('included',$this->included);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CcOrderComfortPacks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
