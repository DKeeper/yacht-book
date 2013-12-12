<?php

/**
 * This is the model class for table "m_profile".
 *
 * The followings are the available columns in table 'm_profile':
 * @property integer $id
 * @property integer $m_id
 * @property integer $cc_id
 * @property string $phone
 * @property string $avatar
 *
 * The followings are the available model relations:
 * @property User $cc
 * @property User $m
 */
class MProfile extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('m_id, cc_id', 'required'),
			array('m_id, cc_id', 'numerical', 'integerOnly'=>true),
			array('phone', 'length', 'max'=>20),
            array('avatar', 'file',
                'allowEmpty' => true,
                'mimeTypes'=> 'image/jpg,image/jpeg,image/gif,image/png',
                'maxSize' => 1024 * 1024 * 5, // 5MB
                'tooLarge' => Yii::t('view','The file was larger than {limit} byte. Please upload a smaller file'),
                'wrongMimeType' => Yii::t('view','The format of the selected file does not correspond to valid: jpg, png, gif'),
            ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, m_id, cc_id, phone, avatar', 'safe', 'on'=>'search'),
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
			'm' => array(self::BELONGS_TO, 'User', 'm_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'm_id' => Yii::t('model','M'),
			'cc_id' => Yii::t('model','СС'),
			'phone' => Yii::t('model','Phone'),
			'avatar' => Yii::t('model','Avatar'),
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
		$criteria->compare('m_id',$this->m_id);
		$criteria->compare('cc_id',$this->cc_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
