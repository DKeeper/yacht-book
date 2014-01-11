<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $recipient_id
 * @property integer $order_id
 * @property string $text
 * @property string $out_date
 * @property string $in_date
 *
 * The followings are the available model relations:
 * @property User $sender
 * @property User $recipient
 * @property Orders $order
 */
class Message extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, recipient_id, order_id, text, out_date', 'required'),
			array('sender_id, recipient_id, order_id', 'numerical', 'integerOnly'=>true),
			array('in_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sender_id, recipient_id, order_id, text, out_date, in_date', 'safe', 'on'=>'search'),
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
			'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
			'recipient' => array(self::BELONGS_TO, 'User', 'recipient_id'),
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
			'sender_id' => Yii::t('model','Sender'),
			'recipient_id' => Yii::t('model','Recipient'),
			'order_id' => Yii::t('model','Order'),
			'text' => Yii::t('model','Text'),
			'out_date' => Yii::t('model','Out date'),
			'in_date' => Yii::t('model','In date'),
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
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('recipient_id',$this->recipient_id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('out_date',$this->out_date,true);
		$criteria->compare('in_date',$this->in_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
