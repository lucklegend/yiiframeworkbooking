<?php

namespace vova07\users\controllers\frontend;

use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use vova07\users\models\frontend\Email;
use vova07\users\models\frontend\PasswordForm;
use vova07\users\models\Profile;
//use vova07\users\models\User;
use vova07\users\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

use yii\filters\VerbFilter;
use yii\web\HttpException;
use common\models\Users;
use common\models\UsersSearch;

/**
 * Frontend controller for authenticated users.
 */
class UserController extends Controller
{
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
                        'roles' => ['@']
                    ]
                ]
            ]
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
     * Log Out page.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

       return $this->redirect(['/booking/index']); 
    }

    /**
     * Change password page.
     */
    public function actionPassword()
    {
        $model = new PasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->password()) {
                    Yii::$app->session->setFlash(
                        'success',
                        Module::t('users', 'FRONTEND_FLASH_SUCCESS_PASSWORD_CHANGE')
                    );
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_PASSWORD_CHANGE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'password',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Request email change page.
     */
    public function actionEmail()
    {
        $model = new Email();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', Module::t('users', 'FRONTEND_FLASH_SUCCES_EMAIL_CHANGE'));
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_EMAIL_CHANGE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'email',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Profile updating page.
     */
    public function actionUpdate111111111111111111111111111111111111()
    {
        $model = User::findByUserId(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', Module::t('users', 'FRONTEND_FLASH_SUCCES_UPDATE'));
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'FRONTEND_FLASH_FAIL_UPDATE'));
                }
                return $this->refresh();
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'update',
            [
                'model' => $model
            ]
        );
    }
	
    public function actionUpdate()
    {
        //$model = new Users();
		$user = Users::findOne(Yii::$app->user->id);
//        $profile = $user->profile;
//        $statusArray = User::getStatusArray();
//        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()  ) { 
				$user->user_unit=$_POST['User']['user_unit'];
				$user->address=$_POST['User']['address'];
				$user->city=$_POST['User']['city'];
				$user->zip=$_POST['User']['zip']; 
				$user->contact_no=$_POST['User']['contact_no'];
				$user->fname = $_POST['User']['fname'];  
                $user->lname = $_POST['User']['lname'];  
                
                 $user->save();
                if (!$user->save(false)) {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                }
                //return $this->refresh();
				return $this->redirect(['index']);
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render('update', [
                'user' => $user,
            ]);
    }
	
}
