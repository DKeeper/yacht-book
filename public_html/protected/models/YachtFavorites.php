<?php

/**
 * This is the model class for table "yacht_favorites".
 *
 * The followings are the available columns in table 'yacht_favorites':
 * @property integer $id
 * @property integer $c_id
 * @property integer $yacht_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property User $c
 * @property CcFleets $yacht
 */
class YachtFavorites extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yacht_favorites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_id, yacht_id, date', 'required'),
			array('c_id, yacht_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, c_id, yacht_id, date', 'safe', 'on'=>'search'),
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
			'c' => array(self::BELONGS_TO, 'User', 'c_id'),
			'yacht' => array(self::BELONGS_TO, 'CcFleets', 'yacht_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'c_id' => Yii::t('model','C'),
			'yacht_id' => Yii::t('model','Yacht'),
			'date' => Yii::t('model','Date'),
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
		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('yacht_id',$this->yacht_id);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YachtFavorites the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
