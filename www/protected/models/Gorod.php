<?php

/**
 * This is the model class for table "gorod".
 *
 * The followings are the available columns in table 'gorod':
 * @property integer $id
 * @property integer $vkl
 * @property integer $id_gn
 * @property integer $status
 * @property integer $tabl_id
 * @property string $tabl
 * @property string $samonazvanie
 * @property string $mfa
 * @property string $samonazvanie_1
 * @property string $oficialno_1
 * @property string $flag
 * @property string $flag_svg
 * @property string $gerb
 * @property string $gerb_svg
 * @property string $giddom
 * @property integer $tip
 * @property integer $gorod_id
 * @property integer $region_id
 * @property integer $strana_id
 * @property integer $mir_id
 * @property integer $obj_id
 * @property string $ksi1
 * @property string $ksi2
 * @property string $ksi_sort
 * @property string $ksi_lat
 * @property string $ksi_uni
 * @property string $telefon
 * @property string $pochta
 * @property string $avto
 * @property double $naselenie
 * @property string $ploshad
 * @property integer $vysota
 * @property integer $osnovan
 * @property integer $upominanie
 * @property string $kontinent
 * @property double $shirota
 * @property double $dolgota
 * @property integer $shirota_gradus
 * @property integer $shirota_minuta
 * @property double $shirota_sekunda
 * @property integer $dolgota_gradus
 * @property integer $dolgota_minuta
 * @property double $dolgota_sekunda
 * @property string $sozdan
 * @property string $izmenen
 * @property string $vrem_pojas
 * @property string $dop_nazvanie
 * @property string $gn_tip_np
 * @property string $nazvanie_1
 * @property string $opisanie_1
 * @property string $nazvanie_2
 * @property string $opisanie_2
 * @property string $nazvanie_3
 * @property string $opisanie_3
 * @property string $nazvanie_4
 * @property string $opisanie_4
 * @property string $nazvanie_5
 * @property string $opisanie_5
 * @property string $nazvanie_6
 * @property string $opisanie_6
 * @property string $nazvanie_7
 * @property string $opisanie_7
 * @property string $nazvanie_8
 * @property string $opisanie_8
 * @property string $nazvanie_9
 * @property string $opisanie_9
 * @property string $nazvanie_10
 * @property string $opisanie_10
 * @property string $nazvanie_11
 * @property string $opisanie_11
 * @property string $nazvanie_12
 * @property string $opisanie_12
 * @property string $nazvanie_13
 * @property string $opisanie_13
 * @property string $nazvanie_14
 * @property string $opisanie_14
 * @property string $nazvanie_15
 * @property string $opisanie_15
 * @property string $nazvanie_16
 * @property string $opisanie_16
 * @property string $nazvanie_17
 * @property string $opisanie_17
 * @property string $nazvanie_18
 * @property string $opisanie_18
 * @property string $nazvanie_19
 * @property string $opisanie_19
 * @property string $nazvanie_20
 * @property string $opisanie_20
 * @property string $nazvanie_21
 * @property string $opisanie_21
 * @property string $nazvanie_22
 * @property string $opisanie_22
 * @property string $nazvanie_23
 * @property string $opisanie_23
 * @property string $nazvanie_24
 * @property string $opisanie_24
 * @property string $nazvanie_25
 * @property string $opisanie_25
 * @property string $nazvanie_26
 * @property string $opisanie_26
 * @property string $nazvanie_27
 * @property string $opisanie_27
 * @property string $nazvanie_28
 * @property string $opisanie_28
 * @property string $nazvanie_29
 * @property string $opisanie_29
 * @property string $nazvanie_30
 * @property string $opisanie_30
 * @property string $nazvanie_31
 * @property string $opisanie_31
 * @property string $nazvanie_32
 * @property string $opisanie_32
 * @property string $nazvanie_33
 * @property string $opisanie_33
 * @property string $nazvanie_34
 * @property string $opisanie_34
 * @property string $nazvanie_35
 * @property string $opisanie_35
 * @property string $nazvanie_36
 * @property string $opisanie_36
 * @property string $nazvanie_37
 * @property string $opisanie_37
 * @property string $nazvanie_38
 * @property string $opisanie_38
 * @property string $nazvanie_39
 * @property string $opisanie_39
 * @property string $nazvanie_40
 * @property string $opisanie_40
 * @property string $nazvanie_41
 * @property string $opisanie_41
 * @property string $nazvanie_42
 * @property string $opisanie_42
 * @property string $nazvanie_43
 * @property string $opisanie_43
 * @property string $nazvanie_44
 * @property string $opisanie_44
 * @property string $nazvanie_45
 * @property string $opisanie_45
 * @property string $nazvanie_46
 * @property string $opisanie_46
 * @property string $nazvanie_47
 * @property string $opisanie_47
 * @property string $nazvanie_48
 * @property string $opisanie_48
 * @property string $nazvanie_49
 * @property string $opisanie_49
 * @property string $nazvanie_50
 * @property string $opisanie_50
 * @property string $nazvanie_51
 * @property string $opisanie_51
 * @property string $nazvanie_52
 * @property string $opisanie_52
 * @property string $nazvanie_53
 * @property string $opisanie_53
 * @property string $nazvanie_54
 * @property string $opisanie_54
 * @property string $nazvanie_55
 * @property string $opisanie_55
 * @property string $nazvanie_56
 * @property string $opisanie_56
 * @property string $nazvanie_57
 * @property string $opisanie_57
 * @property string $nazvanie_58
 * @property string $opisanie_58
 * @property string $nazvanie_59
 * @property string $opisanie_59
 * @property string $nazvanie_60
 * @property string $opisanie_60
 * @property string $nazvanie_61
 * @property string $opisanie_61
 * @property string $nazvanie_62
 * @property string $opisanie_62
 * @property string $nazvanie_63
 * @property string $opisanie_63
 * @property string $nazvanie_64
 * @property string $opisanie_64
 * @property string $nazvanie_65
 * @property string $opisanie_65
 * @property string $nazvanie_66
 * @property string $opisanie_66
 * @property string $nazvanie_67
 * @property string $opisanie_67
 * @property integer $region_1
 * @property integer $region_2
 * @property integer $region_3
 * @property string $admin_zametka
 * @property string $nazvanie_68
 * @property string $opisanie_68
 * @property string $nazvanie_69
 * @property string $opisanie_69
 * @property string $nazvanie_70
 * @property string $opisanie_70
 */
class Gorod extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gorod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vkl, id_gn, status, samonazvanie, tip, gorod_id, region_id, strana_id, mir_id, obj_id, ksi1, ksi2, ksi_lat, ksi_uni, telefon, naselenie, ploshad, vysota, osnovan, upominanie, shirota_gradus, shirota_minuta, shirota_sekunda, dolgota_gradus, dolgota_minuta, dolgota_sekunda, gn_tip_np, nazvanie_1, nazvanie_2, nazvanie_3, nazvanie_4, nazvanie_5, nazvanie_6, nazvanie_7, nazvanie_8, nazvanie_9, nazvanie_10, nazvanie_11, nazvanie_12, nazvanie_13, nazvanie_14, nazvanie_15, nazvanie_16, nazvanie_17, nazvanie_18, nazvanie_19, nazvanie_20, nazvanie_21, nazvanie_22, nazvanie_23, nazvanie_24, nazvanie_25, nazvanie_26, nazvanie_27, nazvanie_28, nazvanie_29, nazvanie_30, nazvanie_31, nazvanie_32, nazvanie_33, nazvanie_34, nazvanie_35, nazvanie_36, nazvanie_37, nazvanie_38, nazvanie_39, nazvanie_40, nazvanie_41, nazvanie_42, nazvanie_43, nazvanie_44, nazvanie_45, nazvanie_46, nazvanie_47, nazvanie_48, nazvanie_49, nazvanie_50, nazvanie_51, nazvanie_52, nazvanie_53, nazvanie_54, nazvanie_55, nazvanie_56, nazvanie_57, nazvanie_58, nazvanie_59, nazvanie_60, nazvanie_61, nazvanie_62, nazvanie_63, nazvanie_64, nazvanie_65, nazvanie_66, nazvanie_67, region_1, region_2, region_3, nazvanie_68, opisanie_68, nazvanie_69, opisanie_69, nazvanie_70, opisanie_70', 'required'),
			array('vkl, id_gn, status, tabl_id, tip, gorod_id, region_id, strana_id, mir_id, obj_id, vysota, osnovan, upominanie, shirota_gradus, shirota_minuta, dolgota_gradus, dolgota_minuta, region_1, region_2, region_3', 'numerical', 'integerOnly'=>true),
			array('naselenie, shirota, dolgota, shirota_sekunda, dolgota_sekunda', 'numerical'),
			array('tabl, ksi_uni, avto', 'length', 'max'=>32),
			array('samonazvanie, mfa, samonazvanie_1, oficialno_1, flag, flag_svg, gerb, gerb_svg, giddom', 'length', 'max'=>255),
			array('ksi1, kontinent, vrem_pojas', 'length', 'max'=>8),
			array('ksi2, ksi_sort, ksi_lat, telefon, ploshad, gn_tip_np', 'length', 'max'=>16),
			array('pochta', 'length', 'max'=>64),
			array('nazvanie_1, nazvanie_12', 'length', 'max'=>130),
			array('nazvanie_2, nazvanie_3, nazvanie_4, nazvanie_5, nazvanie_6, nazvanie_7, nazvanie_8, nazvanie_9, nazvanie_10, nazvanie_11, nazvanie_14, nazvanie_15, nazvanie_16, nazvanie_17, nazvanie_19, nazvanie_21, nazvanie_22, nazvanie_23, nazvanie_24, nazvanie_25, nazvanie_26, nazvanie_27, nazvanie_28, nazvanie_29, nazvanie_30, nazvanie_31, nazvanie_32, nazvanie_33, nazvanie_34, nazvanie_35, nazvanie_36, nazvanie_37, nazvanie_38, nazvanie_39, nazvanie_40, nazvanie_41, nazvanie_42, nazvanie_43, nazvanie_44, nazvanie_45, nazvanie_46, nazvanie_47, nazvanie_48, nazvanie_49, nazvanie_50, nazvanie_51, nazvanie_52, nazvanie_53, nazvanie_54, nazvanie_55, nazvanie_56, nazvanie_57, nazvanie_58, nazvanie_59, nazvanie_60, nazvanie_61, nazvanie_62, nazvanie_63, nazvanie_64, nazvanie_65, nazvanie_66, nazvanie_67', 'length', 'max'=>100),
			array('nazvanie_13, nazvanie_18, nazvanie_20', 'length', 'max'=>110),
			array('nazvanie_68, opisanie_68, nazvanie_69, opisanie_69, nazvanie_70, opisanie_70', 'length', 'max'=>127),
			array('sozdan, izmenen, dop_nazvanie, opisanie_1, opisanie_2, opisanie_3, opisanie_4, opisanie_5, opisanie_6, opisanie_7, opisanie_8, opisanie_9, opisanie_10, opisanie_11, opisanie_12, opisanie_13, opisanie_14, opisanie_15, opisanie_16, opisanie_17, opisanie_18, opisanie_19, opisanie_20, opisanie_21, opisanie_22, opisanie_23, opisanie_24, opisanie_25, opisanie_26, opisanie_27, opisanie_28, opisanie_29, opisanie_30, opisanie_31, opisanie_32, opisanie_33, opisanie_34, opisanie_35, opisanie_36, opisanie_37, opisanie_38, opisanie_39, opisanie_40, opisanie_41, opisanie_42, opisanie_43, opisanie_44, opisanie_45, opisanie_46, opisanie_47, opisanie_48, opisanie_49, opisanie_50, opisanie_51, opisanie_52, opisanie_53, opisanie_54, opisanie_55, opisanie_56, opisanie_57, opisanie_58, opisanie_59, opisanie_60, opisanie_61, opisanie_62, opisanie_63, opisanie_64, opisanie_65, opisanie_66, opisanie_67, admin_zametka', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vkl, id_gn, status, tabl_id, tabl, samonazvanie, mfa, samonazvanie_1, oficialno_1, flag, flag_svg, gerb, gerb_svg, giddom, tip, gorod_id, region_id, strana_id, mir_id, obj_id, ksi1, ksi2, ksi_sort, ksi_lat, ksi_uni, telefon, pochta, avto, naselenie, ploshad, vysota, osnovan, upominanie, kontinent, shirota, dolgota, shirota_gradus, shirota_minuta, shirota_sekunda, dolgota_gradus, dolgota_minuta, dolgota_sekunda, sozdan, izmenen, vrem_pojas, dop_nazvanie, gn_tip_np, nazvanie_1, opisanie_1, nazvanie_2, opisanie_2, nazvanie_3, opisanie_3, nazvanie_4, opisanie_4, nazvanie_5, opisanie_5, nazvanie_6, opisanie_6, nazvanie_7, opisanie_7, nazvanie_8, opisanie_8, nazvanie_9, opisanie_9, nazvanie_10, opisanie_10, nazvanie_11, opisanie_11, nazvanie_12, opisanie_12, nazvanie_13, opisanie_13, nazvanie_14, opisanie_14, nazvanie_15, opisanie_15, nazvanie_16, opisanie_16, nazvanie_17, opisanie_17, nazvanie_18, opisanie_18, nazvanie_19, opisanie_19, nazvanie_20, opisanie_20, nazvanie_21, opisanie_21, nazvanie_22, opisanie_22, nazvanie_23, opisanie_23, nazvanie_24, opisanie_24, nazvanie_25, opisanie_25, nazvanie_26, opisanie_26, nazvanie_27, opisanie_27, nazvanie_28, opisanie_28, nazvanie_29, opisanie_29, nazvanie_30, opisanie_30, nazvanie_31, opisanie_31, nazvanie_32, opisanie_32, nazvanie_33, opisanie_33, nazvanie_34, opisanie_34, nazvanie_35, opisanie_35, nazvanie_36, opisanie_36, nazvanie_37, opisanie_37, nazvanie_38, opisanie_38, nazvanie_39, opisanie_39, nazvanie_40, opisanie_40, nazvanie_41, opisanie_41, nazvanie_42, opisanie_42, nazvanie_43, opisanie_43, nazvanie_44, opisanie_44, nazvanie_45, opisanie_45, nazvanie_46, opisanie_46, nazvanie_47, opisanie_47, nazvanie_48, opisanie_48, nazvanie_49, opisanie_49, nazvanie_50, opisanie_50, nazvanie_51, opisanie_51, nazvanie_52, opisanie_52, nazvanie_53, opisanie_53, nazvanie_54, opisanie_54, nazvanie_55, opisanie_55, nazvanie_56, opisanie_56, nazvanie_57, opisanie_57, nazvanie_58, opisanie_58, nazvanie_59, opisanie_59, nazvanie_60, opisanie_60, nazvanie_61, opisanie_61, nazvanie_62, opisanie_62, nazvanie_63, opisanie_63, nazvanie_64, opisanie_64, nazvanie_65, opisanie_65, nazvanie_66, opisanie_66, nazvanie_67, opisanie_67, region_1, region_2, region_3, admin_zametka, nazvanie_68, opisanie_68, nazvanie_69, opisanie_69, nazvanie_70, opisanie_70', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('model','ID'),
			'vkl' => 'Vkl',
			'id_gn' => 'Id Gn',
			'status' => 'Status',
			'tabl_id' => 'Tabl',
			'tabl' => 'Tabl',
			'samonazvanie' => 'Samonazvanie',
			'mfa' => 'Mfa',
			'samonazvanie_1' => 'Samonazvanie 1',
			'oficialno_1' => 'Oficialno 1',
			'flag' => 'Flag',
			'flag_svg' => 'Flag Svg',
			'gerb' => 'Gerb',
			'gerb_svg' => 'Gerb Svg',
			'giddom' => 'Giddom',
			'tip' => 'Tip',
			'gorod_id' => 'Gorod',
			'region_id' => 'Region',
			'strana_id' => 'Strana',
			'mir_id' => 'Mir',
			'obj_id' => 'Obj',
			'ksi1' => 'Ksi1',
			'ksi2' => 'Ksi2',
			'ksi_sort' => 'Ksi Sort',
			'ksi_lat' => 'Ksi Lat',
			'ksi_uni' => 'Ksi Uni',
			'telefon' => 'Telefon',
			'pochta' => 'Pochta',
			'avto' => 'Avto',
			'naselenie' => 'Naselenie',
			'ploshad' => 'Ploshad',
			'vysota' => 'Vysota',
			'osnovan' => 'Osnovan',
			'upominanie' => 'Upominanie',
			'kontinent' => 'Kontinent',
			'shirota' => 'Shirota',
			'dolgota' => 'Dolgota',
			'shirota_gradus' => 'Shirota Gradus',
			'shirota_minuta' => 'Shirota Minuta',
			'shirota_sekunda' => 'Shirota Sekunda',
			'dolgota_gradus' => 'Dolgota Gradus',
			'dolgota_minuta' => 'Dolgota Minuta',
			'dolgota_sekunda' => 'Dolgota Sekunda',
			'sozdan' => 'Sozdan',
			'izmenen' => 'Izmenen',
			'vrem_pojas' => 'Vrem Pojas',
			'dop_nazvanie' => 'Dop Nazvanie',
			'gn_tip_np' => 'Gn Tip Np',
			'nazvanie_1' => 'Nazvanie 1',
			'opisanie_1' => 'Opisanie 1',
			'nazvanie_2' => 'Nazvanie 2',
			'opisanie_2' => 'Opisanie 2',
			'nazvanie_3' => 'Nazvanie 3',
			'opisanie_3' => 'Opisanie 3',
			'nazvanie_4' => 'Nazvanie 4',
			'opisanie_4' => 'Opisanie 4',
			'nazvanie_5' => 'Nazvanie 5',
			'opisanie_5' => 'Opisanie 5',
			'nazvanie_6' => 'Nazvanie 6',
			'opisanie_6' => 'Opisanie 6',
			'nazvanie_7' => 'Nazvanie 7',
			'opisanie_7' => 'Opisanie 7',
			'nazvanie_8' => 'Nazvanie 8',
			'opisanie_8' => 'Opisanie 8',
			'nazvanie_9' => 'Nazvanie 9',
			'opisanie_9' => 'Opisanie 9',
			'nazvanie_10' => 'Nazvanie 10',
			'opisanie_10' => 'Opisanie 10',
			'nazvanie_11' => 'Nazvanie 11',
			'opisanie_11' => 'Opisanie 11',
			'nazvanie_12' => 'Nazvanie 12',
			'opisanie_12' => 'Opisanie 12',
			'nazvanie_13' => 'Nazvanie 13',
			'opisanie_13' => 'Opisanie 13',
			'nazvanie_14' => 'Nazvanie 14',
			'opisanie_14' => 'Opisanie 14',
			'nazvanie_15' => 'Nazvanie 15',
			'opisanie_15' => 'Opisanie 15',
			'nazvanie_16' => 'Nazvanie 16',
			'opisanie_16' => 'Opisanie 16',
			'nazvanie_17' => 'Nazvanie 17',
			'opisanie_17' => 'Opisanie 17',
			'nazvanie_18' => 'Nazvanie 18',
			'opisanie_18' => 'Opisanie 18',
			'nazvanie_19' => 'Nazvanie 19',
			'opisanie_19' => 'Opisanie 19',
			'nazvanie_20' => 'Nazvanie 20',
			'opisanie_20' => 'Opisanie 20',
			'nazvanie_21' => 'Nazvanie 21',
			'opisanie_21' => 'Opisanie 21',
			'nazvanie_22' => 'Nazvanie 22',
			'opisanie_22' => 'Opisanie 22',
			'nazvanie_23' => 'Nazvanie 23',
			'opisanie_23' => 'Opisanie 23',
			'nazvanie_24' => 'Nazvanie 24',
			'opisanie_24' => 'Opisanie 24',
			'nazvanie_25' => 'Nazvanie 25',
			'opisanie_25' => 'Opisanie 25',
			'nazvanie_26' => 'Nazvanie 26',
			'opisanie_26' => 'Opisanie 26',
			'nazvanie_27' => 'Nazvanie 27',
			'opisanie_27' => 'Opisanie 27',
			'nazvanie_28' => 'Nazvanie 28',
			'opisanie_28' => 'Opisanie 28',
			'nazvanie_29' => 'Nazvanie 29',
			'opisanie_29' => 'Opisanie 29',
			'nazvanie_30' => 'Nazvanie 30',
			'opisanie_30' => 'Opisanie 30',
			'nazvanie_31' => 'Nazvanie 31',
			'opisanie_31' => 'Opisanie 31',
			'nazvanie_32' => 'Nazvanie 32',
			'opisanie_32' => 'Opisanie 32',
			'nazvanie_33' => 'Nazvanie 33',
			'opisanie_33' => 'Opisanie 33',
			'nazvanie_34' => 'Nazvanie 34',
			'opisanie_34' => 'Opisanie 34',
			'nazvanie_35' => 'Nazvanie 35',
			'opisanie_35' => 'Opisanie 35',
			'nazvanie_36' => 'Nazvanie 36',
			'opisanie_36' => 'Opisanie 36',
			'nazvanie_37' => 'Nazvanie 37',
			'opisanie_37' => 'Opisanie 37',
			'nazvanie_38' => 'Nazvanie 38',
			'opisanie_38' => 'Opisanie 38',
			'nazvanie_39' => 'Nazvanie 39',
			'opisanie_39' => 'Opisanie 39',
			'nazvanie_40' => 'Nazvanie 40',
			'opisanie_40' => 'Opisanie 40',
			'nazvanie_41' => 'Nazvanie 41',
			'opisanie_41' => 'Opisanie 41',
			'nazvanie_42' => 'Nazvanie 42',
			'opisanie_42' => 'Opisanie 42',
			'nazvanie_43' => 'Nazvanie 43',
			'opisanie_43' => 'Opisanie 43',
			'nazvanie_44' => 'Nazvanie 44',
			'opisanie_44' => 'Opisanie 44',
			'nazvanie_45' => 'Nazvanie 45',
			'opisanie_45' => 'Opisanie 45',
			'nazvanie_46' => 'Nazvanie 46',
			'opisanie_46' => 'Opisanie 46',
			'nazvanie_47' => 'Nazvanie 47',
			'opisanie_47' => 'Opisanie 47',
			'nazvanie_48' => 'Nazvanie 48',
			'opisanie_48' => 'Opisanie 48',
			'nazvanie_49' => 'Nazvanie 49',
			'opisanie_49' => 'Opisanie 49',
			'nazvanie_50' => 'Nazvanie 50',
			'opisanie_50' => 'Opisanie 50',
			'nazvanie_51' => 'Nazvanie 51',
			'opisanie_51' => 'Opisanie 51',
			'nazvanie_52' => 'Nazvanie 52',
			'opisanie_52' => 'Opisanie 52',
			'nazvanie_53' => 'Nazvanie 53',
			'opisanie_53' => 'Opisanie 53',
			'nazvanie_54' => 'Nazvanie 54',
			'opisanie_54' => 'Opisanie 54',
			'nazvanie_55' => 'Nazvanie 55',
			'opisanie_55' => 'Opisanie 55',
			'nazvanie_56' => 'Nazvanie 56',
			'opisanie_56' => 'Opisanie 56',
			'nazvanie_57' => 'Nazvanie 57',
			'opisanie_57' => 'Opisanie 57',
			'nazvanie_58' => 'Nazvanie 58',
			'opisanie_58' => 'Opisanie 58',
			'nazvanie_59' => 'Nazvanie 59',
			'opisanie_59' => 'Opisanie 59',
			'nazvanie_60' => 'Nazvanie 60',
			'opisanie_60' => 'Opisanie 60',
			'nazvanie_61' => 'Nazvanie 61',
			'opisanie_61' => 'Opisanie 61',
			'nazvanie_62' => 'Nazvanie 62',
			'opisanie_62' => 'Opisanie 62',
			'nazvanie_63' => 'Nazvanie 63',
			'opisanie_63' => 'Opisanie 63',
			'nazvanie_64' => 'Nazvanie 64',
			'opisanie_64' => 'Opisanie 64',
			'nazvanie_65' => 'Nazvanie 65',
			'opisanie_65' => 'Opisanie 65',
			'nazvanie_66' => 'Nazvanie 66',
			'opisanie_66' => 'Opisanie 66',
			'nazvanie_67' => 'Nazvanie 67',
			'opisanie_67' => 'Opisanie 67',
			'region_1' => 'Region 1',
			'region_2' => 'Region 2',
			'region_3' => 'Region 3',
			'admin_zametka' => 'Admin Zametka',
			'nazvanie_68' => 'Nazvanie 68',
			'opisanie_68' => 'Opisanie 68',
			'nazvanie_69' => 'Nazvanie 69',
			'opisanie_69' => 'Opisanie 69',
			'nazvanie_70' => 'Nazvanie 70',
			'opisanie_70' => 'Opisanie 70',
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
		$criteria->compare('vkl',$this->vkl);
		$criteria->compare('id_gn',$this->id_gn);
		$criteria->compare('status',$this->status);
		$criteria->compare('tabl_id',$this->tabl_id);
		$criteria->compare('tabl',$this->tabl,true);
		$criteria->compare('samonazvanie',$this->samonazvanie,true);
		$criteria->compare('mfa',$this->mfa,true);
		$criteria->compare('samonazvanie_1',$this->samonazvanie_1,true);
		$criteria->compare('oficialno_1',$this->oficialno_1,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('flag_svg',$this->flag_svg,true);
		$criteria->compare('gerb',$this->gerb,true);
		$criteria->compare('gerb_svg',$this->gerb_svg,true);
		$criteria->compare('giddom',$this->giddom,true);
		$criteria->compare('tip',$this->tip);
		$criteria->compare('gorod_id',$this->gorod_id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('strana_id',$this->strana_id);
		$criteria->compare('mir_id',$this->mir_id);
		$criteria->compare('obj_id',$this->obj_id);
		$criteria->compare('ksi1',$this->ksi1,true);
		$criteria->compare('ksi2',$this->ksi2,true);
		$criteria->compare('ksi_sort',$this->ksi_sort,true);
		$criteria->compare('ksi_lat',$this->ksi_lat,true);
		$criteria->compare('ksi_uni',$this->ksi_uni,true);
		$criteria->compare('telefon',$this->telefon,true);
		$criteria->compare('pochta',$this->pochta,true);
		$criteria->compare('avto',$this->avto,true);
		$criteria->compare('naselenie',$this->naselenie);
		$criteria->compare('ploshad',$this->ploshad,true);
		$criteria->compare('vysota',$this->vysota);
		$criteria->compare('osnovan',$this->osnovan);
		$criteria->compare('upominanie',$this->upominanie);
		$criteria->compare('kontinent',$this->kontinent,true);
		$criteria->compare('shirota',$this->shirota);
		$criteria->compare('dolgota',$this->dolgota);
		$criteria->compare('shirota_gradus',$this->shirota_gradus);
		$criteria->compare('shirota_minuta',$this->shirota_minuta);
		$criteria->compare('shirota_sekunda',$this->shirota_sekunda);
		$criteria->compare('dolgota_gradus',$this->dolgota_gradus);
		$criteria->compare('dolgota_minuta',$this->dolgota_minuta);
		$criteria->compare('dolgota_sekunda',$this->dolgota_sekunda);
		$criteria->compare('sozdan',$this->sozdan,true);
		$criteria->compare('izmenen',$this->izmenen,true);
		$criteria->compare('vrem_pojas',$this->vrem_pojas,true);
		$criteria->compare('dop_nazvanie',$this->dop_nazvanie,true);
		$criteria->compare('gn_tip_np',$this->gn_tip_np,true);
		$criteria->compare('nazvanie_1',$this->nazvanie_1,true);
		$criteria->compare('opisanie_1',$this->opisanie_1,true);
		$criteria->compare('nazvanie_2',$this->nazvanie_2,true);
		$criteria->compare('opisanie_2',$this->opisanie_2,true);
		$criteria->compare('nazvanie_3',$this->nazvanie_3,true);
		$criteria->compare('opisanie_3',$this->opisanie_3,true);
		$criteria->compare('nazvanie_4',$this->nazvanie_4,true);
		$criteria->compare('opisanie_4',$this->opisanie_4,true);
		$criteria->compare('nazvanie_5',$this->nazvanie_5,true);
		$criteria->compare('opisanie_5',$this->opisanie_5,true);
		$criteria->compare('nazvanie_6',$this->nazvanie_6,true);
		$criteria->compare('opisanie_6',$this->opisanie_6,true);
		$criteria->compare('nazvanie_7',$this->nazvanie_7,true);
		$criteria->compare('opisanie_7',$this->opisanie_7,true);
		$criteria->compare('nazvanie_8',$this->nazvanie_8,true);
		$criteria->compare('opisanie_8',$this->opisanie_8,true);
		$criteria->compare('nazvanie_9',$this->nazvanie_9,true);
		$criteria->compare('opisanie_9',$this->opisanie_9,true);
		$criteria->compare('nazvanie_10',$this->nazvanie_10,true);
		$criteria->compare('opisanie_10',$this->opisanie_10,true);
		$criteria->compare('nazvanie_11',$this->nazvanie_11,true);
		$criteria->compare('opisanie_11',$this->opisanie_11,true);
		$criteria->compare('nazvanie_12',$this->nazvanie_12,true);
		$criteria->compare('opisanie_12',$this->opisanie_12,true);
		$criteria->compare('nazvanie_13',$this->nazvanie_13,true);
		$criteria->compare('opisanie_13',$this->opisanie_13,true);
		$criteria->compare('nazvanie_14',$this->nazvanie_14,true);
		$criteria->compare('opisanie_14',$this->opisanie_14,true);
		$criteria->compare('nazvanie_15',$this->nazvanie_15,true);
		$criteria->compare('opisanie_15',$this->opisanie_15,true);
		$criteria->compare('nazvanie_16',$this->nazvanie_16,true);
		$criteria->compare('opisanie_16',$this->opisanie_16,true);
		$criteria->compare('nazvanie_17',$this->nazvanie_17,true);
		$criteria->compare('opisanie_17',$this->opisanie_17,true);
		$criteria->compare('nazvanie_18',$this->nazvanie_18,true);
		$criteria->compare('opisanie_18',$this->opisanie_18,true);
		$criteria->compare('nazvanie_19',$this->nazvanie_19,true);
		$criteria->compare('opisanie_19',$this->opisanie_19,true);
		$criteria->compare('nazvanie_20',$this->nazvanie_20,true);
		$criteria->compare('opisanie_20',$this->opisanie_20,true);
		$criteria->compare('nazvanie_21',$this->nazvanie_21,true);
		$criteria->compare('opisanie_21',$this->opisanie_21,true);
		$criteria->compare('nazvanie_22',$this->nazvanie_22,true);
		$criteria->compare('opisanie_22',$this->opisanie_22,true);
		$criteria->compare('nazvanie_23',$this->nazvanie_23,true);
		$criteria->compare('opisanie_23',$this->opisanie_23,true);
		$criteria->compare('nazvanie_24',$this->nazvanie_24,true);
		$criteria->compare('opisanie_24',$this->opisanie_24,true);
		$criteria->compare('nazvanie_25',$this->nazvanie_25,true);
		$criteria->compare('opisanie_25',$this->opisanie_25,true);
		$criteria->compare('nazvanie_26',$this->nazvanie_26,true);
		$criteria->compare('opisanie_26',$this->opisanie_26,true);
		$criteria->compare('nazvanie_27',$this->nazvanie_27,true);
		$criteria->compare('opisanie_27',$this->opisanie_27,true);
		$criteria->compare('nazvanie_28',$this->nazvanie_28,true);
		$criteria->compare('opisanie_28',$this->opisanie_28,true);
		$criteria->compare('nazvanie_29',$this->nazvanie_29,true);
		$criteria->compare('opisanie_29',$this->opisanie_29,true);
		$criteria->compare('nazvanie_30',$this->nazvanie_30,true);
		$criteria->compare('opisanie_30',$this->opisanie_30,true);
		$criteria->compare('nazvanie_31',$this->nazvanie_31,true);
		$criteria->compare('opisanie_31',$this->opisanie_31,true);
		$criteria->compare('nazvanie_32',$this->nazvanie_32,true);
		$criteria->compare('opisanie_32',$this->opisanie_32,true);
		$criteria->compare('nazvanie_33',$this->nazvanie_33,true);
		$criteria->compare('opisanie_33',$this->opisanie_33,true);
		$criteria->compare('nazvanie_34',$this->nazvanie_34,true);
		$criteria->compare('opisanie_34',$this->opisanie_34,true);
		$criteria->compare('nazvanie_35',$this->nazvanie_35,true);
		$criteria->compare('opisanie_35',$this->opisanie_35,true);
		$criteria->compare('nazvanie_36',$this->nazvanie_36,true);
		$criteria->compare('opisanie_36',$this->opisanie_36,true);
		$criteria->compare('nazvanie_37',$this->nazvanie_37,true);
		$criteria->compare('opisanie_37',$this->opisanie_37,true);
		$criteria->compare('nazvanie_38',$this->nazvanie_38,true);
		$criteria->compare('opisanie_38',$this->opisanie_38,true);
		$criteria->compare('nazvanie_39',$this->nazvanie_39,true);
		$criteria->compare('opisanie_39',$this->opisanie_39,true);
		$criteria->compare('nazvanie_40',$this->nazvanie_40,true);
		$criteria->compare('opisanie_40',$this->opisanie_40,true);
		$criteria->compare('nazvanie_41',$this->nazvanie_41,true);
		$criteria->compare('opisanie_41',$this->opisanie_41,true);
		$criteria->compare('nazvanie_42',$this->nazvanie_42,true);
		$criteria->compare('opisanie_42',$this->opisanie_42,true);
		$criteria->compare('nazvanie_43',$this->nazvanie_43,true);
		$criteria->compare('opisanie_43',$this->opisanie_43,true);
		$criteria->compare('nazvanie_44',$this->nazvanie_44,true);
		$criteria->compare('opisanie_44',$this->opisanie_44,true);
		$criteria->compare('nazvanie_45',$this->nazvanie_45,true);
		$criteria->compare('opisanie_45',$this->opisanie_45,true);
		$criteria->compare('nazvanie_46',$this->nazvanie_46,true);
		$criteria->compare('opisanie_46',$this->opisanie_46,true);
		$criteria->compare('nazvanie_47',$this->nazvanie_47,true);
		$criteria->compare('opisanie_47',$this->opisanie_47,true);
		$criteria->compare('nazvanie_48',$this->nazvanie_48,true);
		$criteria->compare('opisanie_48',$this->opisanie_48,true);
		$criteria->compare('nazvanie_49',$this->nazvanie_49,true);
		$criteria->compare('opisanie_49',$this->opisanie_49,true);
		$criteria->compare('nazvanie_50',$this->nazvanie_50,true);
		$criteria->compare('opisanie_50',$this->opisanie_50,true);
		$criteria->compare('nazvanie_51',$this->nazvanie_51,true);
		$criteria->compare('opisanie_51',$this->opisanie_51,true);
		$criteria->compare('nazvanie_52',$this->nazvanie_52,true);
		$criteria->compare('opisanie_52',$this->opisanie_52,true);
		$criteria->compare('nazvanie_53',$this->nazvanie_53,true);
		$criteria->compare('opisanie_53',$this->opisanie_53,true);
		$criteria->compare('nazvanie_54',$this->nazvanie_54,true);
		$criteria->compare('opisanie_54',$this->opisanie_54,true);
		$criteria->compare('nazvanie_55',$this->nazvanie_55,true);
		$criteria->compare('opisanie_55',$this->opisanie_55,true);
		$criteria->compare('nazvanie_56',$this->nazvanie_56,true);
		$criteria->compare('opisanie_56',$this->opisanie_56,true);
		$criteria->compare('nazvanie_57',$this->nazvanie_57,true);
		$criteria->compare('opisanie_57',$this->opisanie_57,true);
		$criteria->compare('nazvanie_58',$this->nazvanie_58,true);
		$criteria->compare('opisanie_58',$this->opisanie_58,true);
		$criteria->compare('nazvanie_59',$this->nazvanie_59,true);
		$criteria->compare('opisanie_59',$this->opisanie_59,true);
		$criteria->compare('nazvanie_60',$this->nazvanie_60,true);
		$criteria->compare('opisanie_60',$this->opisanie_60,true);
		$criteria->compare('nazvanie_61',$this->nazvanie_61,true);
		$criteria->compare('opisanie_61',$this->opisanie_61,true);
		$criteria->compare('nazvanie_62',$this->nazvanie_62,true);
		$criteria->compare('opisanie_62',$this->opisanie_62,true);
		$criteria->compare('nazvanie_63',$this->nazvanie_63,true);
		$criteria->compare('opisanie_63',$this->opisanie_63,true);
		$criteria->compare('nazvanie_64',$this->nazvanie_64,true);
		$criteria->compare('opisanie_64',$this->opisanie_64,true);
		$criteria->compare('nazvanie_65',$this->nazvanie_65,true);
		$criteria->compare('opisanie_65',$this->opisanie_65,true);
		$criteria->compare('nazvanie_66',$this->nazvanie_66,true);
		$criteria->compare('opisanie_66',$this->opisanie_66,true);
		$criteria->compare('nazvanie_67',$this->nazvanie_67,true);
		$criteria->compare('opisanie_67',$this->opisanie_67,true);
		$criteria->compare('region_1',$this->region_1);
		$criteria->compare('region_2',$this->region_2);
		$criteria->compare('region_3',$this->region_3);
		$criteria->compare('admin_zametka',$this->admin_zametka,true);
		$criteria->compare('nazvanie_68',$this->nazvanie_68,true);
		$criteria->compare('opisanie_68',$this->opisanie_68,true);
		$criteria->compare('nazvanie_69',$this->nazvanie_69,true);
		$criteria->compare('opisanie_69',$this->opisanie_69,true);
		$criteria->compare('nazvanie_70',$this->nazvanie_70,true);
		$criteria->compare('opisanie_70',$this->opisanie_70,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gorod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
