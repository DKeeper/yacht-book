<?php

class MapController extends Controller
{
    public $layout='//layouts/map';

    public function filters()
    {
        return array(
            'rights',
        );
    }

	public function actionSearch()
	{
        // Ограничения фильтров для поиска
        $command = Yii::app()->db->createCommand();
        $command
            ->select("
                    MIN(p.length_m) as l_min,
                    MAX(p.length_m) as l_max,
                    MIN(p.built_date) as b_date_min,
                    MAX(p.built_date) as b_date_max,
                    MIN(pr.price) as price_min,
                    MAX(pr.price) as price_max,
                    MIN(
                        ( CASE WHEN p.single_cabins IS NULL THEN 0 ELSE p.single_cabins END ) +
	                    ( CASE WHEN p.double_cabins IS NULL THEN 0 ELSE p.double_cabins END ) +
	                    ( CASE WHEN p.bunk_cabins IS NULL THEN 0 ELSE p.bunk_cabins END ) +
	                    ( CASE WHEN p.twin_cabins IS NULL THEN 0 ELSE p.twin_cabins END )
	                ) AS cabins_min,
                    MAX(
                        ( CASE WHEN p.single_cabins IS NULL THEN 0 ELSE p.single_cabins END ) +
	                    ( CASE WHEN p.double_cabins IS NULL THEN 0 ELSE p.double_cabins END ) +
	                    ( CASE WHEN p.bunk_cabins IS NULL THEN 0 ELSE p.bunk_cabins END ) +
	                    ( CASE WHEN p.twin_cabins IS NULL THEN 0 ELSE p.twin_cabins END )
	                ) AS cabins_max
                ")
            ->from('cc_fleets as f')
            ->join('sy_profile as p','p.id = f.profile_id')
            ->leftJoin('price_current_year as pr','pr.yacht_id = f.id')
            ->andWhere('f.isActive=1');
        $debugSQL = $command->getText();
        $debugParam = $command->params;
        $row = $command->queryRow();
        $length = array(
            'l_min'=>floor($row['l_min']),
            'l_max'=>ceil($row['l_max']),
        );
        $date = array(
            'b_date_min'=>intval($row['b_date_min']),
            'b_date_max'=>intval($row['b_date_max']),
        );
        $price = array(
            'price_min'=>intval($row['price_min']),
            'price_max'=>intval($row['price_max']),
        );
        $cabins = array(
            'cabins_min'=>intval($row['cabins_min']),
            'cabins_max'=>intval($row['cabins_max']),
        );

		$this->render(
            'search',
            array(
                'length' => $length,
                'date' => $date,
                'price' => $price,
                'cabins' => $cabins,
                'debug'=>array(
                    'sql'=>$debugSQL,
                    'param'=>$debugParam,
                ),
            )
        );
	}
}