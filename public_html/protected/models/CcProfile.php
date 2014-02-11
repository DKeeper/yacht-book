<?php

/**
 * This is the model class for table "cc_profile".
 *
 * The followings are the available columns in table 'cc_profile':
 * @property integer $id
 * @property integer $cc_id
 * @property integer $isActive
 * @property string $company_name
 * @property integer $company_country_id
 * @property integer $company_city_id
 * @property string $company_postal_code
 * @property string $company_full_addres
 * @property string $company_web_site
 * @property string $company_email
 * @property string $company_phone
 * @property string $company_faxe
 * @property string $vat
 * @property string $company_logo
 * @property integer $q_boat
 * @property double $longitude
 * @property double $latitude
 * @property string $bank_name
 * @property string $bank_addres
 * @property string $beneficiary
 * @property string $beneficiary_addres
 * @property string $account_no
 * @property string $swift
 * @property string $iban
 * @property integer $visa
 * @property double $visa_percent
 * @property integer $mastercard
 * @property double $mastercard_percent
 * @property integer $amex
 * @property double $amex_percent
 * @property integer $bank_transfer
 * @property integer $western_union
 * @property integer $contact
 * @property string $others
 * @property integer $checkin_day
 * @property string $checkin_hour
 * @property integer $checkout_day
 * @property string $checkout_hour
 * @property string $payment_other
 * @property string $cancel_other
 * @property integer $repeater_discount
 * @property integer $max_discount
 *
 * The followings are the available model relations:
 * @property CcCancelPeriod[] $ccCancelPeriods
 * @property CcEarlyPeriod[] $ccEarlyPeriods
 * @property CcLongPeriod[] $ccLongPeriods
 * @property CcOrderComfortPacks[] $ccOrderComfortPacks
 * @property CcOrderOptions[] $ccOrderOptions
 * @property CcPaymentsPeriod[] $ccPaymentsPeriods
 * @property User $cc
 * @property Strana $country
 * @property Gorod $city
 * @property CcTransitLog[] $ccTransitLogs
 * @property CcLanguage[] $ccLanguages
 * @property Language[] $languages
 */
class CcProfile extends BaseModel
{
    /** @var $searchCountry Strana */
    public $searchCountry;
    /** @var $searchCity Gorod */
    public $searchCity;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cc_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc_id', 'required'),
			array('cc_id, isActive, q_boat, visa, mastercard, amex, bank_transfer, western_union, contact, checkin_day, checkout_day, repeater_discount, max_discount', 'numerical', 'integerOnly'=>true),
			array('company_postal_code', 'length', 'max'=>10),
			array('company_phone, company_faxe', 'length', 'max'=>15),
            array('longitude, latitude, visa_percent, mastercard_percent, amex_percent', 'match', 'pattern'=>'/^\d+(\.\d+)?$/', 'message' => Yii::t("view","Incorrect symbols (0-9.)")),
			array('vat', 'length', 'max'=>20),
            array('company_country_id, company_city_id, q_boat, longitude, latitude, visa, visa_percent, mastercard, mastercard_percent, amex, amex_percent, bank_transfer, western_union, contact, checkin_day, checkin_hour, checkout_day, checkout_hour, repeater_discount, max_discount, others, payment_other, cancel_other', 'default', 'value' => null),
			array('company_country_id, company_city_id, company_name, company_full_addres, company_web_site, company_email, company_logo, bank_name, bank_addres, beneficiary, beneficiary_addres, account_no, swift, iban, others, payment_other, cancel_other, checkout_hour, checkin_hour', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cc_id, isActive, company_name, company_country_id, company_city_id, company_postal_code, company_full_addres, company_web_site, company_email, company_phone, company_faxe, vat, company_logo, q_boat, longitude, latitude, bank_name, bank_addres, beneficiary, beneficiary_addres, account_no, swift, iban, visa, visa_percent, mastercard, mastercard_percent, amex, amex_percent, bank_transfer, western_union, contact, others, checkin_day, checkin_hour, checkout_day, checkout_hour, payment_other, cancel_other, repeater_discount, max_discount', 'safe', 'on'=>'search'),
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
			'ccCancelPeriods' => array(self::HAS_MANY, 'CcCancelPeriod', 'cc_profile_id'),
			'ccEarlyPeriods' => array(self::HAS_MANY, 'CcEarlyPeriod', 'cc_profile_id'),
			'ccLongPeriods' => array(self::HAS_MANY, 'CcLongPeriod', 'cc_profile_id'),
			'ccOrderComfortPacks' => array(self::HAS_MANY, 'CcOrderComfortPacks', 'cc_profile_id'),
			'ccOrderOptions' => array(self::HAS_MANY, 'CcOrderOptions', 'cc_profile_id'),
			'ccPaymentsPeriods' => array(self::HAS_MANY, 'CcPaymentsPeriod', 'cc_profile_id'),
			'cc' => array(self::BELONGS_TO, 'User', 'cc_id'),
			'country' => array(self::BELONGS_TO, 'Strana', 'company_country_id'),
			'city' => array(self::BELONGS_TO, 'Gorod', 'company_city_id'),
			'ccTransitLogs' => array(self::HAS_MANY, 'CcTransitLog', 'cc_profile_id'),
            'ccLanguages' => array(self::HAS_MANY, 'CcLanguage', 'cc_profile_id'),
            'languages'=>array(self::MANY_MANY, 'Language',
                'cc_language(cc_profile_id, language_id)'),
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
			'isActive' => Yii::t('model','Is active'),
			'company_name' => Yii::t('model','Company name'),
			'company_country_id' => Yii::t('model','Company country'),
			'company_city_id' => Yii::t('model','Company city'),
			'company_postal_code' => Yii::t('model','Company postal code'),
			'company_full_addres' => Yii::t('model','Company full addres'),
			'company_web_site' => Yii::t('model','Company web site'),
			'company_email' => Yii::t('model','Company email'),
			'company_phone' => Yii::t('model','Company phone'),
			'company_faxe' => Yii::t('model','Company faxe'),
			'vat' => Yii::t('model','Vat'),
			'company_logo' => Yii::t('model','Company logo'),
			'q_boat' => Yii::t('model','Q boat'),
			'ccLanguages' => Yii::t('model','Company speak'),
			'longitude' => Yii::t('model','Longitude'),
			'latitude' => Yii::t('model','Latitude'),
			'bank_name' => Yii::t('model','Bank name'),
			'bank_addres' => Yii::t('model','Bank addres'),
			'beneficiary' => Yii::t('model','Beneficiary'),
			'beneficiary_addres' => Yii::t('model','Beneficiary addres'),
			'account_no' => Yii::t('model','Account no'),
			'swift' => Yii::t('model','Swift'),
			'iban' => Yii::t('model','Iban'),
			'visa' => Yii::t('model','Visa'),
			'visa_percent' => Yii::t('model','Visa percent'),
			'mastercard' => Yii::t('model','Mastercard'),
			'mastercard_percent' => Yii::t('model','Mastercard percent'),
			'amex' => Yii::t('model','Amex'),
			'amex_percent' => Yii::t('model','Amex percent'),
			'bank_transfer' => Yii::t('model','Bank transfer'),
			'western_union' => Yii::t('model','Western union'),
			'contact' => Yii::t('model','Contact'),
			'others' => Yii::t('model','Others'),
			'checkin_day' => Yii::t('model','Checkin day'),
			'checkin_hour' => Yii::t('model','Checkin hour'),
			'checkout_day' => Yii::t('model','Checkout day'),
			'checkout_hour' => Yii::t('model','Checkout hour'),
			'payment_other' => Yii::t('model','Payment other'),
			'cancel_other' => Yii::t('model','Cancel other'),
			'repeater_discount' => Yii::t('model','Repeater discount'),
			'max_discount' => Yii::t('model','Max discount'),
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

        $criteria->group = 't.id';
        $criteria->with = array('country','city');
        $criteria->together = true;

		$criteria->compare('id',$this->id);
		$criteria->compare('cc_id',$this->cc_id);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_country_id',$this->company_country_id,true);
        $criteria->compare('country.nazvanie_1', $this->searchCountry->nazvanie_1, true);
		$criteria->compare('company_city_id',$this->company_city_id);
        $criteria->compare('city.nazvanie_1', $this->searchCity->nazvanie_1, true);
		$criteria->compare('company_postal_code',$this->company_postal_code,true);
		$criteria->compare('company_full_addres',$this->company_full_addres,true);
		$criteria->compare('company_web_site',$this->company_web_site,true);
		$criteria->compare('company_email',$this->company_email,true);
		$criteria->compare('company_phone',$this->company_phone,true);
		$criteria->compare('company_faxe',$this->company_faxe,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('company_logo',$this->company_logo,true);
		$criteria->compare('q_boat',$this->q_boat);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_addres',$this->bank_addres,true);
		$criteria->compare('beneficiary',$this->beneficiary,true);
		$criteria->compare('beneficiary_addres',$this->beneficiary_addres,true);
		$criteria->compare('account_no',$this->account_no,true);
		$criteria->compare('swift',$this->swift,true);
		$criteria->compare('iban',$this->iban,true);
		$criteria->compare('visa',$this->visa);
		$criteria->compare('visa_percent',$this->visa_percent);
		$criteria->compare('mastercard',$this->mastercard);
		$criteria->compare('mastercard_percent',$this->mastercard_percent);
		$criteria->compare('amex',$this->amex);
		$criteria->compare('amex_percent',$this->amex_percent);
		$criteria->compare('bank_transfer',$this->bank_transfer);
		$criteria->compare('western_union',$this->western_union);
		$criteria->compare('contact',$this->contact);
		$criteria->compare('others',$this->others,true);
		$criteria->compare('checkin_day',$this->checkin_day);
		$criteria->compare('checkin_hour',$this->checkin_hour,true);
		$criteria->compare('checkout_day',$this->checkout_day);
		$criteria->compare('checkout_hour',$this->checkout_hour,true);
		$criteria->compare('payment_other',$this->payment_other,true);
		$criteria->compare('cancel_other',$this->cancel_other,true);
		$criteria->compare('repeater_discount',$this->repeater_discount);
		$criteria->compare('max_discount',$this->max_discount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CcProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return array
     */
    public function getSelectedLanguage(){
        $selItems = array();
        /** @var $Lang CcLanguage */
        foreach($this->ccLanguages as $Lang){
            $selItems[$Lang->language_id] = array('selected' => 'selected');
        }
        return $selItems;
    }
}
