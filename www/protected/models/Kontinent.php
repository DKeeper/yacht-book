<?php

/**
 * This is the model class for table "kontinent".
 *
 * The followings are the available columns in table 'kontinent':
 * @property integer $sxema
 * @property string $kontinent_id
 * @property integer $kod
 * @property string $ksi
 * @property string $cvet
 * @property string $ksi_lat
 * @property string $nazvanie
 * @property integer $maska
 * @property string $giddom
 * @property integer $status
 * @property string $nazvanie_1
 * @property string $nazvanie_2
 */
class Kontinent extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kontinent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sxema, kontinent_id, kod, ksi, cvet, ksi_lat, nazvanie, status, nazvanie_1, nazvanie_2', 'required'),
			array('sxema, kod, maska, status', 'numerical', 'integerOnly'=>true),
			array('kontinent_id, ksi, ksi_lat', 'length', 'max'=>2),
			array('cvet', 'length', 'max'=>6),
			array('nazvanie, giddom', 'length', 'max'=>255),
			array('nazvanie_1, nazvanie_2', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sxema, kontinent_id, kod, ksi, cvet, ksi_lat, nazvanie, maska, giddom, status, nazvanie_1, nazvanie_2', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sxema' => 'Sxema',
			'kontinent_id' => 'Kontinent',
			'kod' => 'Kod',
			'ksi' => 'Ksi',
			'cvet' => 'Cvet',
			'ksi_lat' => 'Ksi Lat',
			'nazvanie' => 'Nazvanie',
			'maska' => 'Maska',
			'giddom' => 'Giddom',
			'status' => 'Status',
			'nazvanie_1' => 'Nazvanie 1',
			'nazvanie_2' => 'Nazvanie 2',
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

		$criteria->compare('sxema',$this->sxema);
		$criteria->compare('kontinent_id',$this->kontinent_id,true);
		$criteria->compare('kod',$this->kod);
		$criteria->compare('ksi',$this->ksi,true);
		$criteria->compare('cvet',$this->cvet,true);
		$criteria->compare('ksi_lat',$this->ksi_lat,true);
		$criteria->compare('nazvanie',$this->nazvanie,true);
		$criteria->compare('maska',$this->maska);
		$criteria->compare('giddom',$this->giddom,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('nazvanie_1',$this->nazvanie_1,true);
		$criteria->compare('nazvanie_2',$this->nazvanie_2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kontinent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
