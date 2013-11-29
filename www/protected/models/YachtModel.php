<?php

/**
 * This is the model class for table "yacht_model".
 *
 * The followings are the available columns in table 'yacht_model':
 * @property integer $id
 * @property integer $shipyard_id
 * @property integer $name
 *
 * The followings are the available model relations:
 * @property SyProfile[] $syProfiles
 * @property YachtIndex[] $yachtIndexes
 * @property YachtShipyard $shipyard
 * @property YachtModification[] $yachtModifications
 */
class YachtModel extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yacht_model';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shipyard_id, name', 'required'),
			array('shipyard_id, name', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shipyard_id, name', 'safe', 'on'=>'search'),
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
			'syProfiles' => array(self::HAS_MANY, 'SyProfile', 'model_id'),
			'yachtIndexes' => array(self::HAS_MANY, 'YachtIndex', 'model_id'),
			'shipyard' => array(self::BELONGS_TO, 'YachtShipyard', 'shipyard_id'),
			'yachtModifications' => array(self::HAS_MANY, 'YachtModification', 'model_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'shipyard_id' => 'Shipyard',
			'name' => Yii::t('model','Name'),
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
		$criteria->compare('shipyard_id',$this->shipyard_id);
		$criteria->compare('name',$this->name);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YachtModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
