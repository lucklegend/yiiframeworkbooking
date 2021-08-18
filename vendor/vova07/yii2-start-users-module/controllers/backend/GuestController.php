<?php

namespace vova07\users\controllers\backend;

use vova07\users\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/**
 * Backend controller for guest users.
 */
class GuestController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = '//guest';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    /**
     * Login user.
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = new LoginForm();
        $errMsg = '';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
				if((isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) || Yii::$app->params['enableCaptcha'] != 1){
				$secret = Yii::$app->params['googleCaptchaSecret'];
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.Yii::$app->request->post('g-recaptcha-response'));
				$responseData = json_decode($verifyResponse);
				if($responseData->success || Yii::$app->params['enableCaptcha'] != 1){
					if ($model->login()) {
						if(Yii::$app->user->identity->role == 'admin'){
							$this->redirect(['/fb-booking-booked/today']);
						} else {
							return $this->goHome();
						}
					}
				} else{
					$errMsg = 'Robot verification failed, please try again.';
				}
			}else{
				$errMsg = 'Please click on the reCAPTCHA box.';
			}

            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'login',
            [
                'model' => $model,
				'errMsg' => $errMsg
            ]
        );
    }
}
