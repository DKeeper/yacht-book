<?php

/**
 * This is the model class for table "yacht_index".
 *
 * The followings are the available columns in table 'yacht_index':
 * @property integer $id
 * @property integer $model_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property SyProfile[] $syProfiles
 * @property YachtModel $model
 */
class YachtIndex extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yacht_index';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('model_id', 'application.components.validators.CompositeUnique', 'keyColumns' => array('name'), 'addErrorToAllColumns'=>false),
			array('model_id, name', 'required'),
			array('model_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, model_id, name', 'safe', 'on'=>'search'),
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
			'syProfiles' => array(self::HAS_MANY, 'SyProfile', '_index_id'),
			'model' => array(self::BELONGS_TO, 'YachtModel', 'model_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'model_id' => Yii::t('model','Model'),
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YachtIndex the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
