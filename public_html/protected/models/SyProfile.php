<?php

/**
 * This is the model class for table "sy_profile".
 *
 * The followings are the available columns in table 'sy_profile':
 * @property integer $id
 * @property integer $type_id
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
 * @property integer $hard_top
 * @property integer $flybridge
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
 * @property integer $water_tank_capacity
 * @property integer $fuel_tank
 * @property integer $fuel_tank_capacity
 * @property integer $grey_tank
 * @property integer $grey_tank_capacity
 * @property integer $fridge
 * @property integer $fridge_no
 * @property integer $freeser
 * @property integer $gas_cooker
 * @property integer $microwave
 * @property integer $kit_equip
 * @property integer $local_skipper
 * @property string $other_details
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
 * @property double $deposit
 * @property double $deposit_insurance_price
 * @property double $deposit_insurance_deposit
 * @property integer $last_minute
 * @property integer $week_before
 * @property integer $last_minute_value
 * @property integer $last_minute_duration
 * @property integer $last_minute_duration_type_id
 * @property string $last_minute_date_from
 * @property string $last_minute_date_to
 *
 * The followings are the available model relations:
 * @property SailFurling $mainSailFurling
 * @property SailMaterial $raceSailMaterial
 * @property CcFleets[] $ccFleets
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
    protected function afterFind(){
        parent::afterFind();
        if(isset($this->last_minute_date_from)){
            $this->last_minute_date_from = date('d.m.Y',strtotime($this->last_minute_date_from));
        }
        if(isset($this->last_minute_date_to)){
            $this->last_minute_date_to = date('d.m.Y',strtotime($this->last_minute_date_to));
        }
    }

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
			array('type_id, shipyard_id, model_id, _index_id, modification_id, double_cabins, bunk_cabins, twin_cabins, single_cabins, berth_cabin, berth_salon, crew_cabins, crew_berth, WC, shower, main_sail_full_battened, main_sail_furling_id, main_sail_material_id, jib_type_id, jib_automatic, jib_furling_id, jib_material_id, winches, el_winches, spinnaker, gennaker, displacement, no_of_engine, engine_type_id, engine_mark_id, wheel_type_id, wheel_no, rudder, folding_propeller, bow_thruster, auto_pilot, GPS, in_cockpit, wind, speed, depht, compass, VHF, radio, inverter, radar, local_charts, local_pilot, tick_cockpit, tick_deck, sprayhood, bimini, hard_top, flybridge, cockpit_table, moveable, cockpit_speakers, hot_water, heater, aircon, water_maker, generator, media_type_id, aux, usb, TV, water_tank, fuel_tank, grey_tank, fridge, fridge_no, freeser, gas_cooker, microwave, kit_equip, local_skipper, last_cleaning_incl, last_cleaning_obl, race_sail, race_sail_material_id, race_sail_price_incl, race_sail_price_obl, race_sail_deposit_obl, crew_license, water_tank_capacity, fuel_tank_capacity, grey_tank_capacity, last_minute_value, last_minute_duration, last_minute_duration_type_id', 'numerical', 'integerOnly'=>true),
			array('main_sail_area, jib_area, spinnaker_area, spinnaker_price, spinnaker_deposiit, gennaker_area, gennaker_price, gennaker_deposit, engine_power_hp, engine_power_kW, site_discount, last_cleaning_price, race_sail_price, race_sail_deposit, race_preparation, hull_cleaning, deposit, deposit_insurance_price, deposit_insurance_deposit', 'numerical'),
			array('name, other_details, IRC_scan, ORC_scan', 'safe'),
            array('built_date, renovation_date, last_minute_value, last_minute_duration, last_minute_duration_type_id, last_minute_date_from, last_minute_date_to','default','value'=>null),
            array('length_m, beam, draft, mast_draught', 'match', 'pattern'=>'/^\d+(\.\d+)?$/', 'message' => Yii::t("view","Incorrect symbols (0-9.)")),
            array('double_cabins, bunk_cabins, twin_cabins, single_cabins','application.components.validators.Cabins','compareAttributes'=>'double_cabins, bunk_cabins, twin_cabins, single_cabins'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type_id, name, shipyard_id, model_id, _index_id, modification_id, built_date, renovation_date, double_cabins, bunk_cabins, twin_cabins, single_cabins, berth_cabin, berth_salon, crew_cabins, crew_berth, WC, shower, main_sail_area, main_sail_full_battened, main_sail_furling_id, main_sail_material_id, jib_type_id, jib_area, jib_automatic, jib_furling_id, jib_material_id, winches, el_winches, spinnaker, spinnaker_area, spinnaker_price, spinnaker_deposiit, gennaker, gennaker_area, gennaker_price, gennaker_deposit, length_m, beam, draft, mast_draught, displacement, no_of_engine, engine_type_id, engine_mark_id, engine_power_hp, engine_power_kW, wheel_type_id, wheel_no, rudder, folding_propeller, bow_thruster, auto_pilot, GPS, in_cockpit, wind, speed, depht, compass, VHF, radio, inverter, radar, local_charts, local_pilot, tick_cockpit, tick_deck, sprayhood, bimini, hard_top, flybridge, cockpit_table, moveable, cockpit_speakers, hot_water, heater, aircon, water_maker, generator, media_type_id, aux, usb, TV, water_tank, fuel_tank, grey_tank, fridge, fridge_no, freeser, gas_cooker, microwave, kit_equip, local_skipper, other_details, site_discount, last_cleaning_incl, last_cleaning_price, last_cleaning_obl, race_sail, race_sail_material_id, race_sail_price_incl, race_sail_price, race_sail_price_obl, race_sail_deposit, race_sail_deposit_obl, IRC_scan, ORC_scan, race_preparation, hull_cleaning, crew_license, deposit, deposit_insurance_price, deposit_insurance_deposit, last_minute_value, last_minute_duration, last_minute_duration_type_id, last_minute_date_from, last_minute_date_to', 'safe', 'on'=>'search'),
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
            'ccFleets' => array(self::HAS_MANY, 'CcFleets', 'profile_id'),
			'type' => array(self::BELONGS_TO, 'YachtType', 'type_id'),
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
			'type_id' => Yii::t('model','Type'),
			'name' => Yii::t('model','Name'),
			'shipyard_id' => Yii::t('model','Shipyard'),
			'model_id' => Yii::t('model','Model'),
			'_index_id' => Yii::t('model','Index'),
			'modification_id' => Yii::t('model','Modification'),
			'built_date' => Yii::t('model','Built year'),
			'renovation_date' => Yii::t('model','Renovation year'),
			'double_cabins' => Yii::t('model','Double cabins'),
			'bunk_cabins' => Yii::t('model','Bunk cabins'),
			'twin_cabins' => Yii::t('model','Twin cabins'),
			'single_cabins' => Yii::t('model','Single cabins'),
			'berth_cabin' => Yii::t('model','Berth cabin'),
			'berth_salon' => Yii::t('model','Berth salon'),
			'crew_cabins' => Yii::t('model','Crew cabins'),
			'crew_berth' => Yii::t('model','Crew berth'),
			'WC' => Yii::t('model','WC'),
			'shower' => Yii::t('model','Shower'),
			'main_sail_area' => Yii::t('model','Main sail area'),
			'main_sail_full_battened' => Yii::t('model','Main sail full battened'),
			'main_sail_furling_id' => Yii::t('model','Main sail'),
			'main_sail_material_id' => Yii::t('model','Main sail material'),
			'jib_type_id' => Yii::t('model','Jib type'),
			'jib_area' => Yii::t('model','Jib area'),
			'jib_automatic' => Yii::t('model','Jib automatic'),
			'jib_furling_id' => Yii::t('model','Jib'),
			'jib_material_id' => Yii::t('model','Jib material'),
			'winches' => Yii::t('model','Winches'),
			'el_winches' => Yii::t('model','El winches'),
			'spinnaker' => Yii::t('model','Spinnaker'),
			'spinnaker_area' => Yii::t('model','Spinnaker area'),
			'spinnaker_price' => Yii::t('model','Spinnaker price'),
			'spinnaker_deposiit' => Yii::t('model','Spinnaker deposiit'),
			'gennaker' => Yii::t('model','Gennaker'),
			'gennaker_area' => Yii::t('model','Gennaker area'),
			'gennaker_price' => Yii::t('model','Gennaker price'),
			'gennaker_deposit' => Yii::t('model','Gennaker deposit'),
			'length_m' => Yii::t('model','Length m'),
			'beam' => Yii::t('model','Beam'),
			'draft' => Yii::t('model','Draft'),
			'mast_draught' => Yii::t('model','Mast draught'),
			'displacement' => Yii::t('model','Displacement'),
			'no_of_engine' => Yii::t('model','No of engine'),
			'engine_type_id' => Yii::t('model','Engine type'),
			'engine_mark_id' => Yii::t('model','Engine mark'),
			'engine_power_hp' => Yii::t('model','Engine power HP'),
			'engine_power_kW' => Yii::t('model','Engine power kW'),
			'wheel_type_id' => Yii::t('model','Wheel type'),
			'wheel_no' => Yii::t('model','Wheel no'),
			'rudder' => Yii::t('model','Rudder no'),
			'folding_propeller' => Yii::t('model','Folding propeller'),
			'bow_thruster' => Yii::t('model','Bow thruster'),
			'auto_pilot' => Yii::t('model','Auto pilot'),
			'GPS' => Yii::t('model','GPS'),
			'in_cockpit' => Yii::t('model','In cockpit'),
			'wind' => Yii::t('model','Wind'),
			'speed' => Yii::t('model','Speed'),
			'depht' => Yii::t('model','Depht'),
			'compass' => Yii::t('model','Compass'),
			'VHF' => Yii::t('model','VHF'),
			'radio' => Yii::t('model','Radio'),
			'inverter' => Yii::t('model','Inverter'),
			'radar' => Yii::t('model','Radar'),
			'local_charts' => Yii::t('model','Local charts'),
			'local_pilot' => Yii::t('model','Local pilot'),
			'tick_cockpit' => Yii::t('model','Teak cockpit'),
			'tick_deck' => Yii::t('model','Teak deck'),
			'sprayhood' => Yii::t('model','Sprayhood'),
			'bimini' => Yii::t('model','Bimini'),
			'hard_top' => Yii::t('model','Hard top'),
			'flybridge' => Yii::t('model','Flybridge'),
			'cockpit_table' => Yii::t('model','Cockpit table'),
			'moveable' => Yii::t('model','Moveable'),
			'cockpit_speakers' => Yii::t('model','Cockpit speakers'),
			'hot_water' => Yii::t('model','Hot water'),
			'heater' => Yii::t('model','Heater'),
			'aircon' => Yii::t('model','Aircon'),
			'water_maker' => Yii::t('model','Water maker'),
			'generator' => Yii::t('model','Generator'),
			'media_type_id' => Yii::t('model','Media type'),
			'aux' => Yii::t('model','AUX'),
			'usb' => Yii::t('model','USB'),
			'TV' => Yii::t('model','TV'),
			'water_tank' => Yii::t('model','Water tank'),
			'water_tank_capacity' => Yii::t('model','Water tank capacity'),
			'fuel_tank' => Yii::t('model','Fuel tank'),
			'fuel_tank_capacity' => Yii::t('model','Fuel tank capacity'),
			'grey_tank' => Yii::t('model','Grey tank'),
			'grey_tank_capacity' => Yii::t('model','Grey tank capacity'),
			'fridge' => Yii::t('model','Fridge'),
			'fridge_no' => Yii::t('model','Fridge no'),
			'freeser' => Yii::t('model','Freeser'),
			'gas_cooker' => Yii::t('model','Gas cooker'),
			'microwave' => Yii::t('model','Microwave'),
			'kit_equip' => Yii::t('model','Kit equip'),
			'local_skipper' => Yii::t('model','Local skipper only'),
			'other_details' => Yii::t('model','Other details'),
			'site_discount' => Yii::t('model','Site discount'),
			'last_cleaning_incl' => Yii::t('model','Final cleaning incl'),
			'last_cleaning_price' => Yii::t('model','Final cleaning price'),
			'last_cleaning_obl' => Yii::t('model','Final cleaning obl'),
			'race_sail' => Yii::t('model','Race sail'),
			'race_sail_material_id' => Yii::t('model','Race sail material'),
			'race_sail_price_incl' => Yii::t('model','Race sail price incl'),
			'race_sail_price' => Yii::t('model','Race sail price'),
			'race_sail_price_obl' => Yii::t('model','Race sail price obl'),
			'race_sail_deposit' => Yii::t('model','Race sail deposit'),
			'race_sail_deposit_obl' => Yii::t('model','Race sail deposit obl'),
			'IRC_scan' => Yii::t('model','IRC scan'),
			'ORC_scan' => Yii::t('model','ORC scan'),
			'race_preparation' => Yii::t('model','Race preparation'),
			'hull_cleaning' => Yii::t('model','Hull cleaning'),
			'crew_license' => Yii::t('model','Crew license'),
            'deposit' => Yii::t('model','Deposit'),
            'deposit_insurance_price' => Yii::t('model','Deposit insurance price'),
            'deposit_insurance_deposit' => Yii::t('model','Deposit insurance deposit'),
            'last_minute_value' => Yii::t('model','Value'),
            'last_minute_duration' => Yii::t('model','Duration'),
            'last_minute_duration_type_id' => Yii::t('model','Duration Type'),
            'last_minute_date_from' => Yii::t('model','Date from'),
            'last_minute_date_to' => Yii::t('model','Date to'),
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
		$criteria->compare('type_id',$this->type_id);
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
		$criteria->compare('hard_top',$this->hard_top);
		$criteria->compare('flybridge',$this->flybridge);
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
		$criteria->compare('water_tank_capacity',$this->water_tank_capacity);
		$criteria->compare('fuel_tank',$this->fuel_tank);
		$criteria->compare('fuel_tank_capacity',$this->fuel_tank_capacity);
		$criteria->compare('grey_tank',$this->grey_tank);
		$criteria->compare('grey_tank_capacity',$this->grey_tank_capacity);
		$criteria->compare('fridge',$this->fridge);
		$criteria->compare('fridge_no',$this->fridge_no);
		$criteria->compare('freeser',$this->freeser);
		$criteria->compare('gas_cooker',$this->gas_cooker);
		$criteria->compare('microwave',$this->microwave);
		$criteria->compare('kit_equip',$this->kit_equip);
		$criteria->compare('local_skipper',$this->local_skipper);
		$criteria->compare('other_details',$this->other_details,true);
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
        $criteria->compare('deposit',$this->deposit);
        $criteria->compare('deposit_insurance_price',$this->deposit_insurance_price);
        $criteria->compare('deposit_insurance_deposit',$this->deposit_insurance_deposit);
        $criteria->compare('last_minute_value',$this->last_minute_value);
        $criteria->compare('last_minute_duration',$this->last_minute_duration);
        $criteria->compare('last_minute_duration_type_id',$this->last_minute_duration_type_id);
        $criteria->compare('last_minute_date_from',$this->last_minute_date_from,true);
        $criteria->compare('last_minute_date_to',$this->last_minute_date_to,true);

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
