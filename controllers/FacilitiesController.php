<?php

namespace app\controllers;
use Yii;
use vova07\users\models\LoginForm;
use vova07\users\models\frontend\User;

class FacilitiesController extends \yii\web\Controller
{
     public function actionIndex()
    {
		if (!Yii::$app->user->isGuest) {
            //$this->goHome();
			//return $this->redirect(['/fb-booking-group/index']);

        }

        $model = new LoginForm();
		 
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
				 
				if ($lresult = $model->login()) {
					//return 'true';  
					$user = User::findById(Yii::$app->user->getId());
					if(Yii::$app->request->post('json') || Yii::$app->request->get('json')){
						Yii::$app->response->format = Response::FORMAT_JSON;
						return json_encode($user);
					}		
				}	
				
          } elseif (Yii::$app->request->isAjax) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              return ActiveForm::validate($model);
          }
        }
        return $this->render('index',[
			'model' => $model
		]);
    }
	
	public function actionFacilities()
    {
      if(\Yii::$app->user->isGuest){
          return $this->render('facilities1');
      } else {
        return $this->render('facilities');
      }
    }
	
	public function actionWelcome()
    {
      if(\Yii::$app->user->isGuest){
        //not logged user
        return $this->render('welcome');
       }else{
        //loggedin user
        return $this->redirect(['booking/index']);
       }  
		
    }

	public function actionWalkthrough()
    {
		return $this->render('walkthrough');
    }

	public function actionFloorplan()
    {
		return $this->render('floorplan');
    }

}
