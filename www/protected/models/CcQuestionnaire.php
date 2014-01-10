<?php

/**
 * This is the model class for table "cc_questionnaire".
 *
 * The followings are the available columns in table 'cc_questionnaire':
 * @property integer $id
 * @property integer $c_id
 * @property integer $cc_id
 * @property integer $order_id
 * @property integer $question_id
 * @property integer $rating
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Questions $question
 * @property User $c
 * @property User $cc
 * @property Orders $order
 */
class CcQuestionnaire extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cc_questionnaire';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_id, cc_id, order_id, question_id, rating', 'required'),
			array('c_id, cc_id, order_id, question_id, rating', 'numerical', 'integerOnly'=>true),
			array('comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, c_id, cc_id, order_id, question_id, rating, comment', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'Questions', 'question_id'),
			'c' => array(self::BELONGS_TO, 'User', 'c_id'),
			'cc' => array(self::BELONGS_TO, 'User', 'cc_id'),
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'c_id' => Yii::t('model','Captain'),
			'cc_id' => Yii::t('model','Charter Company'),
			'order_id' => Yii::t('model','Order'),
			'question_id' => Yii::t('model','Question'),
			'rating' => Yii::t('model','Rating'),
			'comment' => Yii::t('model','Comment'),
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
		$criteria->compare('cc_id',$this->cc_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CcQuestionnaire the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
