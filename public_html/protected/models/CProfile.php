<?php

/**
 * This is the model class for table "c_profile".
 *
 * The followings are the available columns in table 'c_profile':
 * @property integer $id
 * @property integer $c_id
 * @property integer $isActive
 * @property string $name_eng
 * @property string $name_rus
 * @property string $last_name_eng
 * @property string $last_name_rus
 * @property integer $sex_id
 * @property string $zagran_passport
 * @property string $expire_date
 * @property integer $nationality_id
 * @property string $date_of_birth
 * @property string $phone
 * @property string $email
 * @property integer $site_commission
 * @property string $avatar
 * @property string $license
 * @property string $school_issued
 * @property string $date_issued
 * @property string $scan_of_license
 * @property string $website
 * @property integer $receive_news
 * @property integer $professional_regatta
 * @property integer $amateur_regatta
 * @property integer $repeater
 * @property integer $extra
 * @property string $last_settings
 *
 * The followings are the available model relations:
 * @property Gender $sex
 * @property User $c
 * @property Nationality $nationality
 */
class CProfile extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'c_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_id', 'required'),
			array('c_id, isActive, sex_id, nationality_id, site_commission, receive_news, professional_regatta, amateur_regatta, repeater, extra', 'numerical', 'integerOnly'=>true),
			array('name_eng, name_rus, last_name_eng, last_name_rus, zagran_passport, expire_date, date_of_birth, email, avatar, license, school_issued, date_issued, scan_of_license, website, last_settings', 'safe'),
            array('site_commission, repeater, extra, zagran_passport, expire_date, date_of_birth, email, avatar, license, school_issued, date_issued, scan_of_license, website, last_settings', 'default', 'value' => null),
            array('avatar', 'file',
                'allowEmpty' => true,
                'mimeTypes'=> 'image/jpg,image/jpeg,image/gif,image/png',
                'maxSize' => 1024 * 1024 * 5, // 5MB
                'tooLarge' => Yii::t('view','The file was larger than {limit} byte. Please upload a smaller file'),
                'wrongMimeType' => Yii::t('view','The format of the selected file does not correspond to valid: jpg, png, gif'),
            ),
            array('scan_of_license', 'file',
                'allowEmpty' => true,
                'mimeTypes'=> 'image/jpg,image/jpeg,image/gif,image/png,application/pdf',
                'maxSize' => 1024 * 1024 * 10, // 10MB
                'tooLarge' => Yii::t('view','The file was larger than {limit} byte. Please upload a smaller file'),
                'wrongMimeType' => Yii::t('view','The format of the selected file does not correspond to valid: jpg, png, gif, pdf'),
            ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, c_id, isActive, name_eng, name_rus, last_name_eng, last_name_rus, sex_id, zagran_passport, expire_date, nationality_id, date_of_birth, phone, email, site_commission, avatar, license, school_issued, date_issued, scan_of_license, website, receive_news, professional_regatta, amateur_regatta, repeater, extra, last_settings', 'safe', 'on'=>'search'),
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
			'sex' => array(self::BELONGS_TO, 'Gender', 'sex_id'),
			'c' => array(self::BELONGS_TO, 'User', 'c_id'),
			'nationality' => array(self::BELONGS_TO, 'Nationality', 'nationality_id'),
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
			'isActive' => Yii::t('model','Is active'),
			'name_eng' => Yii::t('model','Name (eng)'),
			'name_rus' => Yii::t('model','Name (rus)'),
			'last_name_eng' => Yii::t('model','Last name (eng)'),
            'last_name_rus' => Yii::t('model','Last name (rus)'),
			'sex_id' => Yii::t('model','Sex'),
			'zagran_passport' => Yii::t('model','Zagran passport'),
			'expire_date' => Yii::t('model','Expire date'),
			'nationality_id' => Yii::t('model','Nationality'),
			'date_of_birth' => Yii::t('model','Date of birth'),
			'phone' => Yii::t('model','Phone'),
			'email' => Yii::t('model','Email'),
			'site_commission' => Yii::t('model','Site commission'),
			'avatar' => Yii::t('model','Avatar'),
			'license' => Yii::t('model','License'),
			'school_issued' => Yii::t('model','School issued'),
			'date_issued' => Yii::t('model','Date issued'),
			'scan_of_license' => Yii::t('model','Scan of license'),
			'website' => Yii::t('model','Website'),
			'receive_news' => Yii::t('model','Receive news'),
			'professional_regatta' => Yii::t('model','Professional regatta'),
			'amateur_regatta' => Yii::t('model','Amateur regatta'),
			'repeater' => Yii::t('model','Repeater'),
			'extra' => Yii::t('model','Extra'),
			'last_settings' => Yii::t('model','Last settings'),
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
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('name_eng',$this->name_eng,true);
		$criteria->compare('name_rus',$this->name_rus,true);
		$criteria->compare('last_name_eng',$this->last_name_eng,true);
		$criteria->compare('last_name_rus',$this->last_name_rus,true);
		$criteria->compare('sex_id',$this->sex_id);
		$criteria->compare('zagran_passport',$this->zagran_passport,true);
		$criteria->compare('expire_date',$this->expire_date,true);
		$criteria->compare('nationality_id',$this->nationality_id);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('site_commission',$this->site_commission);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('license',$this->license,true);
		$criteria->compare('school_issued',$this->school_issued,true);
		$criteria->compare('date_issued',$this->date_issued,true);
		$criteria->compare('scan_of_license',$this->scan_of_license,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('receive_news',$this->receive_news);
		$criteria->compare('professional_regatta',$this->professional_regatta);
		$criteria->compare('amateur_regatta',$this->amateur_regatta);
		$criteria->compare('repeater',$this->repeater);
		$criteria->compare('extra',$this->extra);
		$criteria->compare('last_settings',$this->last_settings,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
