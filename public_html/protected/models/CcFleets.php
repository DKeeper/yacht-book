<?php

/**
 * This is the model class for table "cc_fleets".
 *
 * The followings are the available columns in table 'cc_fleets':
 * @property integer $id
 * @property integer $cc_id
 * @property integer $profile_id
 * @property integer $isActive
 * @property integer $isTrash
 *
 * The followings are the available model relations:
 * @property User $cc
 * @property Orders[] $orders
 * @property PriceCurrentYear[] $priceCurrentYears
 * @property PriceNextYear[] $priceNextYears
 * @property SyProfile $profile
 * @property YachtFavorites[] $yachtFavorites
 * @property YachtHistoryWatch[] $yachtHistoryWatches
 * @property YachtPhoto[] $yachtPhotos
 */
class CcFleets extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cc_fleets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc_id, profile_id', 'required'),
			array('cc_id, profile_id, isActive, isTrash', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cc_id, profile_id, isActive, isTrash', 'safe', 'on'=>'search'),
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
			'cc' => array(self::BELONGS_TO, 'User', 'cc_id'),
			'profile' => array(self::BELONGS_TO, 'SyProfile', 'profile_id'),
			'orders' => array(self::HAS_MANY, 'Orders', 'yacht_id'),
			'priceCurrentYears' => array(self::HAS_MANY, 'PriceCurrentYear', 'yacht_id'),
			'priceNextYears' => array(self::HAS_MANY, 'PriceNextYear', 'yacht_id'),
			'yachtFavorites' => array(self::HAS_MANY, 'YachtFavorites', 'yacht_id'),
			'yachtHistoryWatches' => array(self::HAS_MANY, 'YachtHistoryWatch', 'yacht_id'),
			'yachtPhotos' => array(self::HAS_MANY, 'YachtPhoto', 'yacht_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'cc_id' => Yii::t('model','СС'),
			'profile_id' => Yii::t('model','Profile'),
            'isActive' => Yii::t('model','Is active'),
            'isTrash' => Yii::t('model','Is trash'),
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
     * @param integer $uid
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($uid)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('cc_id',$uid);
		$criteria->compare('profile_id',$this->profile_id);
        $criteria->compare('isActive',$this->isActive);
        $criteria->compare('isTrash',$this->isTrash);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CcFleets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
