<?php

namespace app\controllers;

use common\models\FbBookingGroup;
use common\models\FbBookingFacility;
use yii\filters\AccessControl;
class FacilityBookingController extends \yii\web\Controller
{
	    public function behaviors()
    {
        return [
			 'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]

        ];
    }

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
		
			$query = new Query;
		$query->select(['group'])
			->from('fb_booking_facility')
			->where(['facility' => $facility]);
		$command = $query->createCommand();
		$group = $command->queryScalar();
		
		$query = new Query;
		$query->select('*')
			->from('fb_booking_rules')
			->where(['group' => $group]);
		$command = $query->createCommand();
		$rules = $command->queryAll();
		
		return $this->render('index', [
		 'modelGro' => $modelGro, 'modelFac' => $modelFac]);
    }
	
	public function actionClosingdate($date, $facility)
    {
		
    }

}
