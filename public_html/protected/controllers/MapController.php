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
		$this->render('search');
	}
}