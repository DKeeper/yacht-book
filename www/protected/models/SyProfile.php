<?php

/**
 * This is the model class for table "sy_profile".
 *
 * The followings are the available columns in table 'sy_profile':
 * @property integer $id
 * @property integer $yacht_id
 * @property string $name
 * @property integer $shipyard_id
 * @property integer $model_id
 * @property integer $_index_id
 * @property integer $modification_id
 * @property string $built_date
 * @property string $renovation_date
 * @property integer $double_cabins
 * @property integer $bunk_cabins
 * @property integer $twin_cabins
 * @property integer $single_cabins
 * @property integer $berth_cabin
 * @property integer $berth_salon
 * @property integer $crew_cabins
 * @property integer $crew_berth
 * @property integer $WC
 * @property integer $shower
 * @property double $main_sail_area
 * @property integer $main_sail_full_battened
 * @property integer $main_sail_furling_id
 * @property integer $main_sail_material_id
 * @property integer $jib_type_id
 * @property double $jib_area
 * @property integer $jib_automatic
 * @property integer $jib_furling_id
 * @property integer $jib_material_id
 * @property integer $winches
 * @property integer $el_winches
 * @property integer $spinnaker
 * @property double $spinnaker_area
 * @property double $spinnaker_price
 * @property double $spinnaker_deposiit
 * @property integer $gennaker
 * @property double $gennaker_area
 * @property double $gennaker_price
 * @property double $gennaker_deposit
 * @property double $length_m
 * @property double $beam
 * @property double $draft
 * @property double $mast_draught
 * @property integer $displacement
 * @property integer $no_of_engine
 * @property integer $engine_type_id
 * @property integer $engine_mark_id
 * @property double $engine_power_hp
 * @property double $engine_power_kW
 * @property integer $wheel_type_id
 * @property integer $wheel_no
 * @property integer $rudder
 * @property integer $folding_propeller
 * @property integer $bow_thruster
 * @property integer $auto_pilot
 * @property integer $GPS
 * @property integer $in_cockpit
 * @property integer $wind
 * @property integer $speed
 * @property integer $depht
 * @property integer $compass
 * @property integer $VHF
 * @property integer $radio
 * @property integer $inverter
 * @property integer $radar
 * @property integer $local_charts
 * @property integer $local_pilot
 * @property integer $tick_cockpit
 * @property integer $tick_deck
 * @property integer $sprayhood
 * @property integer $bimini
 * @property integer $cockpit_table
 * @property integer $moveable
 * @property integer $cockpit_speakers
 * @property integer $hot_water
 * @property integer $heater
 * @property integer $aircon
 * @property integer $water_maker
 * @property integer $generator
 * @property integer $media_type_id
 * @property integer $aux
 * @property integer $usb
 * @property integer $TV
 * @property integer $water_tank
 * @property integer $fuel_tank
 * @property integer $grey_tank
 * @property integer $fridge
 * @property integer $fridge_no
 * @property integer $freeser
 * @property integer $gas_cooker
 * @property integer $microwave
 * @property integer $kit_equip
 * @property integer $local_skipper
 * @property string $other_details
 * @property double $latitude
 * @property double $longitude
 * @property double $site_discount
 * @property integer $last_cleaning_incl
 * @property double $last_cleaning_price
 * @property integer $last_cleaning_obl
 * @property integer $race_sail
 * @property integer $race_sail_material_id
 * @property integer $race_sail_price_incl
 * @property double $race_sail_price
 * @property integer $race_sail_price_obl
 * @property double $race_sail_deposit
 * @property integer $race_sail_deposit_obl
 * @property string $IRC_scan
 * @property string $ORC_scan
 * @property double $race_preparation
 * @property double $hull_cleaning
 * @property integer $crew_license
 *
 * The followings are the available model relations:
 * @property SailFurling $mainSailFurling
 * @property SailMaterial $raceSailMaterial
 * @property CcFleets $yacht
 * @property YachtShipyard $shipyard
 * @property YachtModel $model
 * @property YachtIndex $index
 * @property YachtModification $modification
 * @property SailMaterial $mainSailMaterial
 * @property JibType $jibType
 * @property JibFurling $jibFurling
 * @property SailMaterial $jibMaterial
 * @property EngineType $engineType
 * @property EngineMark $engineMark
 * @property WheelType $wheelType
 * @property MediaType $mediaType
 */
class SyProfile extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sy_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('yacht_id, shipyard_id, model_id, _index_id, modification_id, double_cabins, bunk_cabins, twin_cabins, single_cabins, berth_cabin, berth_salon, crew_cabins, crew_berth, WC, shower, main_sail_full_battened, main_sail_furling_id, main_sail_material_id, jib_type_id, jib_automatic, jib_furling_id, jib_material_id, winches, el_winches, spinnaker, gennaker, displacement, no_of_engine, engine_type_id, engine_mark_id, wheel_type_id, wheel_no, rudder, folding_propeller, bow_thruster, auto_pilot, GPS, in_cockpit, wind, speed, depht, compass, VHF, radio, inverter, radar, local_charts, local_pilot, tick_cockpit, tick_deck, sprayhood, bimini, cockpit_table, moveable, cockpit_speakers, hot_water, heater, aircon, water_maker, generator, media_type_id, aux, usb, TV, water_tank, fuel_tank, grey_tank, fridge, fridge_no, freeser, gas_cooker, microwave, kit_equip, local_skipper, last_cleaning_incl, last_cleaning_obl, race_sail, race_sail_material_id, race_sail_price_incl, race_sail_price_obl, race_sail_deposit_obl, crew_license', 'numerical', 'integerOnly'=>true),
			array('main_sail_area, jib_area, spinnaker_area, spinnaker_price, spinnaker_deposiit, gennaker_area, gennaker_price, gennaker_deposit, length_m, beam, draft, mast_draught, engine_power_hp, engine_power_kW, latitude, longitude, site_discount, last_cleaning_price, race_sail_price, race_sail_deposit, race_preparation, hull_cleaning', 'numerical'),
			array('name, built_date, renovation_date, other_details, IRC_scan, ORC_scan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, yacht_id, name, shipyard_id, model_id, _index_id, modification_id, built_date, renovation_date, double_cabins, bunk_cabins, twin_cabins, single_cabins, berth_cabin, berth_salon, crew_cabins, crew_berth, WC, shower, main_sail_area, main_sail_full_battened, main_sail_furling_id, main_sail_material_id, jib_type_id, jib_area, jib_automatic, jib_furling_id, jib_material_id, winches, el_winches, spinnaker, spinnaker_area, spinnaker_price, spinnaker_deposiit, gennaker, gennaker_area, gennaker_price, gennaker_deposit, length_m, beam, draft, mast_draught, displacement, no_of_engine, engine_type_id, engine_mark_id, engine_power_hp, engine_power_kW, wheel_type_id, wheel_no, rudder, folding_propeller, bow_thruster, auto_pilot, GPS, in_cockpit, wind, speed, depht, compass, VHF, radio, inverter, radar, local_charts, local_pilot, tick_cockpit, tick_deck, sprayhood, bimini, cockpit_table, moveable, cockpit_speakers, hot_water, heater, aircon, water_maker, generator, media_type_id, aux, usb, TV, water_tank, fuel_tank, grey_tank, fridge, fridge_no, freeser, gas_cooker, microwave, kit_equip, local_skipper, other_details, latitude, longitude, site_discount, last_cleaning_incl, last_cleaning_price, last_cleaning_obl, race_sail, race_sail_material_id, race_sail_price_incl, race_sail_price, race_sail_price_obl, race_sail_deposit, race_sail_deposit_obl, IRC_scan, ORC_scan, race_preparation, hull_cleaning, crew_license', 'safe', 'on'=>'search'),
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
			'mainSailFurling' => array(self::BELONGS_TO, 'SailFurling', 'main_sail_furling_id'),
			'raceSailMaterial' => array(self::BELONGS_TO, 'SailMaterial', 'race_sail_material_id'),
			'yacht' => array(self::BELONGS_TO, 'CcFleets', 'yacht_id'),
			'shipyard' => array(self::BELONGS_TO, 'YachtShipyard', 'shipyard_id'),
			'model' => array(self::BELONGS_TO, 'YachtModel', 'model_id'),
			'index' => array(self::BELONGS_TO, 'YachtIndex', '_index_id'),
			'modification' => array(self::BELONGS_TO, 'YachtModification', 'modification_id'),
			'mainSailMaterial' => array(self::BELONGS_TO, 'SailMaterial', 'main_sail_material_id'),
			'jibType' => array(self::BELONGS_TO, 'JibType', 'jib_type_id'),
			'jibFurling' => array(self::BELONGS_TO, 'JibFurling', 'jib_furling_id'),
			'jibMaterial' => array(self::BELONGS_TO, 'SailMaterial', 'jib_material_id'),
			'engineType' => array(self::BELONGS_TO, 'EngineType', 'engine_type_id'),
			'engineMark' => array(self::BELONGS_TO, 'EngineMark', 'engine_mark_id'),
			'wheelType' => array(self::BELONGS_TO, 'WheelType', 'wheel_type_id'),
			'mediaType' => array(self::BELONGS_TO, 'MediaType', 'media_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('model','ID'),
			'yacht_id' => Yii::t('model','Yacht'),
			'name' => Yii::t('model','Name'),
			'shipyard_id' => 'Shipyard',
			'model_id' => 'Model',
			'_index_id' => 'Index',
			'modification_id' => 'Modification',
			'built_date' => 'Built Date',
			'renovation_date' => 'Renovation Date',
			'double_cabins' => 'Double Cabins',
			'bunk_cabins' => 'Bunk Cabins',
			'twin_cabins' => 'Twin Cabins',
			'single_cabins' => 'Single Cabins',
			'berth_cabin' => 'Berth Cabin',
			'berth_salon' => 'Berth Salon',
			'crew_cabins' => 'Crew Cabins',
			'crew_berth' => 'Crew Berth',
			'WC' => 'Wc',
			'shower' => 'Shower',
			'main_sail_area' => 'Main Sail Area',
			'main_sail_full_battened' => 'Main Sail Full Battened',
			'main_sail_furling_id' => 'Main Sail Furling',
			'main_sail_material_id' => 'Main Sail Material',
			'jib_type_id' => 'Jib Type',
			'jib_area' => 'Jib Area',
			'jib_automatic' => 'Jib Automatic',
			'jib_furling_id' => 'Jib Furling',
			'jib_material_id' => 'Jib Material',
			'winches' => 'Winches',
			'el_winches' => 'El Winches',
			'spinnaker' => 'Spinnaker',
			'spinnaker_area' => 'Spinnaker Area',
			'spinnaker_price' => 'Spinnaker Price',
			'spinnaker_deposiit' => 'Spinnaker Deposiit',
			'gennaker' => 'Gennaker',
			'gennaker_area' => 'Gennaker Area',
			'gennaker_price' => 'Gennaker Price',
			'gennaker_deposit' => 'Gennaker Deposit',
			'length_m' => 'Length M',
			'beam' => 'Beam',
			'draft' => 'Draft',
			'mast_draught' => 'Mast Draught',
			'displacement' => 'Displacement',
			'no_of_engine' => 'No Of Engine',
			'engine_type_id' => 'Engine Type',
			'engine_mark_id' => 'Engine Mark',
			'engine_power_hp' => 'Engine Power Hp',
			'engine_power_kW' => 'Engine Power K W',
			'wheel_type_id' => 'Wheel Type',
			'wheel_no' => 'Wheel No',
			'rudder' => 'Rudder',
			'folding_propeller' => 'Folding Propeller',
			'bow_thruster' => 'Bow Thruster',
			'auto_pilot' => 'Auto Pilot',
			'GPS' => 'Gps',
			'in_cockpit' => 'In Cockpit',
			'wind' => 'Wind',
			'speed' => 'Speed',
			'depht' => 'Depht',
			'compass' => 'Compass',
			'VHF' => 'Vhf',
			'radio' => 'Radio',
			'inverter' => 'Inverter',
			'radar' => 'Radar',
			'local_charts' => 'Local Charts',
			'local_pilot' => 'Local Pilot',
			'tick_cockpit' => 'Tick Cockpit',
			'tick_deck' => 'Tick Deck',
			'sprayhood' => 'Sprayhood',
			'bimini' => 'Bimini',
			'cockpit_table' => 'Cockpit Table',
			'moveable' => 'Moveable',
			'cockpit_speakers' => 'Cockpit Speakers',
			'hot_water' => 'Hot Water',
			'heater' => 'Heater',
			'aircon' => 'Aircon',
			'water_maker' => 'Water Maker',
			'generator' => 'Generator',
			'media_type_id' => 'Media Type',
			'aux' => 'Aux',
			'usb' => 'Usb',
			'TV' => 'Tv',
			'water_tank' => 'Water Tank',
			'fuel_tank' => 'Fuel Tank',
			'grey_tank' => 'Grey Tank',
			'fridge' => 'Fridge',
			'fridge_no' => 'Fridge No',
			'freeser' => 'Freeser',
			'gas_cooker' => 'Gas Cooker',
			'microwave' => 'Microwave',
			'kit_equip' => 'Kit Equip',
			'local_skipper' => 'Local Skipper',
			'other_details' => 'Other Details',
			'latitude' => Yii::t('model','Latitude'),
			'longitude' => Yii::t('model','Longitude'),
			'site_discount' => 'Site Discount',
			'last_cleaning_incl' => 'Last Cleaning Incl',
			'last_cleaning_price' => 'Last Cleaning Price',
			'last_cleaning_obl' => 'Last Cleaning Obl',
			'race_sail' => 'Race Sail',
			'race_sail_material_id' => 'Race Sail Material',
			'race_sail_price_incl' => 'Race Sail Price Incl',
			'race_sail_price' => 'Race Sail Price',
			'race_sail_price_obl' => 'Race Sail Price Obl',
			'race_sail_deposit' => 'Race Sail Deposit',
			'race_sail_deposit_obl' => 'Race Sail Deposit Obl',
			'IRC_scan' => 'Irc Scan',
			'ORC_scan' => 'Orc Scan',
			'race_preparation' => 'Race Preparation',
			'hull_cleaning' => 'Hull Cleaning',
			'crew_license' => 'Crew License',
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
		$criteria->compare('yacht_id',$this->yacht_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('shipyard_id',$this->shipyard_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('_index_id',$this->_index_id);
		$criteria->compare('modification_id',$this->modification_id);
		$criteria->compare('built_date',$this->built_date,true);
		$criteria->compare('renovation_date',$this->renovation_date,true);
		$criteria->compare('double_cabins',$this->double_cabins);
		$criteria->compare('bunk_cabins',$this->bunk_cabins);
		$criteria->compare('twin_cabins',$this->twin_cabins);
		$criteria->compare('single_cabins',$this->single_cabins);
		$criteria->compare('berth_cabin',$this->berth_cabin);
		$criteria->compare('berth_salon',$this->berth_salon);
		$criteria->compare('crew_cabins',$this->crew_cabins);
		$criteria->compare('crew_berth',$this->crew_berth);
		$criteria->compare('WC',$this->WC);
		$criteria->compare('shower',$this->shower);
		$criteria->compare('main_sail_area',$this->main_sail_area);
		$criteria->compare('main_sail_full_battened',$this->main_sail_full_battened);
		$criteria->compare('main_sail_furling_id',$this->main_sail_furling_id);
		$criteria->compare('main_sail_material_id',$this->main_sail_material_id);
		$criteria->compare('jib_type_id',$this->jib_type_id);
		$criteria->compare('jib_area',$this->jib_area);
		$criteria->compare('jib_automatic',$this->jib_automatic);
		$criteria->compare('jib_furling_id',$this->jib_furling_id);
		$criteria->compare('jib_material_id',$this->jib_material_id);
		$criteria->compare('winches',$this->winches);
		$criteria->compare('el_winches',$this->el_winches);
		$criteria->compare('spinnaker',$this->spinnaker);
		$criteria->compare('spinnaker_area',$this->spinnaker_area);
		$criteria->compare('spinnaker_price',$this->spinnaker_price);
		$criteria->compare('spinnaker_deposiit',$this->spinnaker_deposiit);
		$criteria->compare('gennaker',$this->gennaker);
		$criteria->compare('gennaker_area',$this->gennaker_area);
		$criteria->compare('gennaker_price',$this->gennaker_price);
		$criteria->compare('gennaker_deposit',$this->gennaker_deposit);
		$criteria->compare('length_m',$this->length_m);
		$criteria->compare('beam',$this->beam);
		$criteria->compare('draft',$this->draft);
		$criteria->compare('mast_draught',$this->mast_draught);
		$criteria->compare('displacement',$this->displacement);
		$criteria->compare('no_of_engine',$this->no_of_engine);
		$criteria->compare('engine_type_id',$this->engine_type_id);
		$criteria->compare('engine_mark_id',$this->engine_mark_id);
		$criteria->compare('engine_power_hp',$this->engine_power_hp);
		$criteria->compare('engine_power_kW',$this->engine_power_kW);
		$criteria->compare('wheel_type_id',$this->wheel_type_id);
		$criteria->compare('wheel_no',$this->wheel_no);
		$criteria->compare('rudder',$this->rudder);
		$criteria->compare('folding_propeller',$this->folding_propeller);
		$criteria->compare('bow_thruster',$this->bow_thruster);
		$criteria->compare('auto_pilot',$this->auto_pilot);
		$criteria->compare('GPS',$this->GPS);
		$criteria->compare('in_cockpit',$this->in_cockpit);
		$criteria->compare('wind',$this->wind);
		$criteria->compare('speed',$this->speed);
		$criteria->compare('depht',$this->depht);
		$criteria->compare('compass',$this->compass);
		$criteria->compare('VHF',$this->VHF);
		$criteria->compare('radio',$this->radio);
		$criteria->compare('inverter',$this->inverter);
		$criteria->compare('radar',$this->radar);
		$criteria->compare('local_charts',$this->local_charts);
		$criteria->compare('local_pilot',$this->local_pilot);
		$criteria->compare('tick_cockpit',$this->tick_cockpit);
		$criteria->compare('tick_deck',$this->tick_deck);
		$criteria->compare('sprayhood',$this->sprayhood);
		$criteria->compare('bimini',$this->bimini);
		$criteria->compare('cockpit_table',$this->cockpit_table);
		$criteria->compare('moveable',$this->moveable);
		$criteria->compare('cockpit_speakers',$this->cockpit_speakers);
		$criteria->compare('hot_water',$this->hot_water);
		$criteria->compare('heater',$this->heater);
		$criteria->compare('aircon',$this->aircon);
		$criteria->compare('water_maker',$this->water_maker);
		$criteria->compare('generator',$this->generator);
		$criteria->compare('media_type_id',$this->media_type_id);
		$criteria->compare('aux',$this->aux);
		$criteria->compare('usb',$this->usb);
		$criteria->compare('TV',$this->TV);
		$criteria->compare('water_tank',$this->water_tank);
		$criteria->compare('fuel_tank',$this->fuel_tank);
		$criteria->compare('grey_tank',$this->grey_tank);
		$criteria->compare('fridge',$this->fridge);
		$criteria->compare('fridge_no',$this->fridge_no);
		$criteria->compare('freeser',$this->freeser);
		$criteria->compare('gas_cooker',$this->gas_cooker);
		$criteria->compare('microwave',$this->microwave);
		$criteria->compare('kit_equip',$this->kit_equip);
		$criteria->compare('local_skipper',$this->local_skipper);
		$criteria->compare('other_details',$this->other_details,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('site_discount',$this->site_discount);
		$criteria->compare('last_cleaning_incl',$this->last_cleaning_incl);
		$criteria->compare('last_cleaning_price',$this->last_cleaning_price);
		$criteria->compare('last_cleaning_obl',$this->last_cleaning_obl);
		$criteria->compare('race_sail',$this->race_sail);
		$criteria->compare('race_sail_material_id',$this->race_sail_material_id);
		$criteria->compare('race_sail_price_incl',$this->race_sail_price_incl);
		$criteria->compare('race_sail_price',$this->race_sail_price);
		$criteria->compare('race_sail_price_obl',$this->race_sail_price_obl);
		$criteria->compare('race_sail_deposit',$this->race_sail_deposit);
		$criteria->compare('race_sail_deposit_obl',$this->race_sail_deposit_obl);
		$criteria->compare('IRC_scan',$this->IRC_scan,true);
		$criteria->compare('ORC_scan',$this->ORC_scan,true);
		$criteria->compare('race_preparation',$this->race_preparation);
		$criteria->compare('hull_cleaning',$this->hull_cleaning);
		$criteria->compare('crew_license',$this->crew_license);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SyProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
