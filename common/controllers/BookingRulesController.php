<?php

namespace app\controllers;

use common\models\FbBookingGroup;
use common\models\FbBookingFacility;

class BookingRulesController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$modelGro = new FbBookingGroup();
		$modelFac = new FbBookingFacility();
		
        return $this->render('index', [
		 'modelGro' => $modelGro, 'modelFac' => $modelFac]);
    }
	
	public function actionRules($user, $facility, $limit)
    {
		$user = Yii::$app->user->getId();
    }
	
	public function actionClosingdate($date, $facility)
    {
		
    }

}
