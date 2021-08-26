<?php

namespace vova07\users\controllers\frontend;

use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use vova07\users\models\frontend\ActivationForm;
use vova07\users\models\frontend\RecoveryConfirmationForm;
use vova07\users\models\frontend\RecoveryForm;
use vova07\users\models\frontend\ResendForm;
use vova07\users\models\frontend\User;
use vova07\users\models\LoginForm;
use vova07\users\models\Profile;
use vova07\users\Module;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/**
 * Frontend controller for guest users.
 */
class GuestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'allow' => true,
            //             'roles' => ['?']
            //         ]
            //     ]
            // ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => $this->module->avatarsTempPath
            ]
        ];
    }

    /**
     * Sign Up page.
     * If record will be successful created, user will be redirected to home page.
     */
    public function actionSignup()
    {
        $user = new User(['scenario' => 'signup']);
        $profile = new Profile();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            if ($user->validate() && $profile->validate()) {
                $user->populateRelation('profile', $profile);
                if ($user->save(false)) {
                    if ($this->module->requireEmailConfirmation === true) {
                        Yii::$app->session->setFlash(
                            'success',
                            Module::t(
                                'users',
                                'FRONTEND_FLASH_SUCCESS_SIGNUP_WITHOUT_LOGIN',
                                [
                                    'url' => Url::toRoute('resend')
                                ]
                            )
                        );
                    } else {
                        Yii::$app->user->login($user);
                        Yii::$app->session->setFlash(
                            'success',
                            Module::t('users', 'FRONTEND_FLASH_SUCCESS_SIGNUP_WITH_LOGIN')
                        );
                    }
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_SIGNUP'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user);
            }
        }

        return $this->render(
            'signup',
            [
                'user' => $user,
                'profile' => $profile
            ]
        );
    }

    /**
     * Resend email confirmation token page.
     */
    public function actionResend()
    {
        $model = new ResendForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->resend()) {
                    Yii::$app->session->setFlash('success', Module::t('users', 'FRONTEND_FLASH_SUCCESS_RESEND'));
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_RESEND'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'resend',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Sign In page.
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            // $this->goHome();
            echo '<script>console.log("already logged in!");</script>';
            return $this->redirect(['/booking/index']); 
        }
        echo '<script>console.log("Not logged in!");</script>';
        $model = new LoginForm();
		$errMsg = '';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
				 if((isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) || Yii::$app->params['enableCaptcha'] != 1){
					$secret = Yii::$app->params['googleCaptchaSecret'];
					$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.Yii::$app->request->post('g-recaptcha-response'));
					$responseData = json_decode($verifyResponse);
					if($responseData->success || Yii::$app->params['enableCaptcha'] != 1){

						if ($lresult = $model->login()) {
							//return 'true';  
							$user = User::findById(Yii::$app->user->getId());
							if(Yii::$app->request->post('json') || Yii::$app->request->get('json')){
								Yii::$app->response->format = Response::FORMAT_JSON;
								return json_encode($user);
							}
						
							if(Yii::$app->request->post('token') || Yii::$app->request->get('token')){
								return $user['token'];
							}
						
							if(Yii::$app->request->post('imei') || Yii::$app->request->get('imei')){
								return $user['ime_code'];
							}
							//print_r(json_encode($user));
		
							//return $this->redirect(['/pages/index','id'=>1]); 
							//return $this->redirect(['/fb-booking-booked/index']); 
                            //return $this->redirect(['/facilities/index']); 
                            // return $this->redirect(['/facilities/welcome']);
                            return $this->redirect(['/booking/index']); 
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

        //return $this->redirect(['/facilities/index']); 
        return $this->render(
            'login',
            [
                'model' => $model,
				'errMsg' => $errMsg
            ]
        );
    }

    /**
     * Activate a new user page.
     *
     * @param string $token Activation token.
     *
     * @return mixed View
     */
    public function actionActivation($token)
    {
        $model = new ActivationForm(['token' => $token]);

        if ($model->validate() && $model->activation()) {
            Yii::$app->session->setFlash('success', Module::t('users', 'FRONTEND_FLASH_SUCCESS_ACTIVATION'));
        } else {
            Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_ACTIVATION'));
        }

        return $this->goHome();
    }

    /**
     * Request password recovery page.
     */
    public function actionRecovery()
    {
        $model = new RecoveryForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->recovery()) {
                    Yii::$app->session->setFlash('success', Module::t('users', 'FRONTEND_FLASH_SUCCESS_RECOVERY'));
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_RECOVERY'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'recovery',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Confirm password recovery request page.
     *
     * @param string $token Confirmation token
     *
     * @return mixed View
     */
    public function actionRecoveryConfirmation($token)
    {
        $model = new RecoveryConfirmationForm(['token' => $token]);

        if (!$model->isValidToken()) {
            Yii::$app->session->setFlash(
                'danger',
                Module::t('users', 'FRONTEND_FLASH_FAIL_RECOVERY_CONFIRMATION_WITH_INVALID_KEY')
            );
            return $this->goHome();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->recovery()) {
                    Yii::$app->session->setFlash(
                        'success',
                        Module::t('users', 'FRONTEND_FLASH_SUCCESS_RECOVERY_CONFIRMATION')
                    );
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash(
                        'danger',
                        Module::t('users', 'FRONTEND_FLASH_FAIL_RECOVERY_CONFIRMATION')
                    );
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'recovery-confirmation',
            [
                'model' => $model
            ]
        );

    }
}
