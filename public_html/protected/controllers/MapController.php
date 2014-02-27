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
        $sql = "
        SELECT
          MIN(p.length_m) as l_min,
          MAX(p.length_m) as l_max,
          MIN(p.built_date) as b_date_min,
          MAX(p.built_date) as b_date_max,
          MIN(pr.price) as price_min,
          MAX(pr.price) as price_max
        FROM cc_fleets as f
        JOIN sy_profile as p ON p.id = f.profile_id
        LEFT JOIN price_current_year as pr ON pr.yacht_id = f.id
        WHERE f.isActive=1;
        ";
        $row = Yii::app()->db->createCommand()->setText($sql)->queryRow();
        $length = array(
            'l_min'=>intval($row['l_min']),
            'l_max'=>intval($row['l_max']),
        );
        $date = array(
            'b_date_min'=>intval($row['b_date_min']),
            'b_date_max'=>intval($row['b_date_max']),
        );
        $price = array(
            'price_min'=>intval($row['price_min']),
            'price_max'=>intval($row['price_max']),
        );

		$this->render(
            'search',
            array(
                'length' => $length,
                'date' => $date,
                'price' => $price,
            )
        );
	}
}