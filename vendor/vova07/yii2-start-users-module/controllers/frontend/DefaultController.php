<?php

namespace vova07\users\controllers\frontend;

use vova07\users\models\frontend\Email;
use vova07\users\Module;
use yii\web\Controller;
use vova07\users\models\backend\User;
use vova07\users\models\Profile;
use Yii;
use common\models\UsersUnit;

/**
 * Default frontend controller.
 */
class DefaultController extends Controller
{
    /**
     * Confirm new e-mail address.
     *
     * @param string $key Confirmation token
     *
     * @return mixed View
     */
    public function actionEmail($key)
    {
        $model = new Email(['token' => $key]);

        if ($model->isValidToken() === false) {
            Yii::$app->session->setFlash(
                'danger',
                Module::t('users', 'FRONTEND_FLASH_FAIL_NEW_EMAIL_CONFIRMATION_WITH_INVALID_KEY')
            );
        } else {
            if ($model->confirm()) {
                Yii::$app->session->setFlash(
                    'success',
                    Module::t('users', 'FRONTEND_FLASH_SUCCESS_NEW_EMAIL_CONFIRMATION')
                );
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    Module::t('users', 'FRONTEND_FLASH_FAIL_NEW_EMAIL_CONFIRMATION')
                );
            }
        }

        return $this->goHome();
    }
	
	public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $user->setScenario('admin-update');
        $profile = $user->profile;
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post())  ) {
            if ($user->validate() ) {
                $user->populateRelation('profile', $profile);
				$user->contact_no=$_POST['User']['contact_no'];  
				
                 $user->save();
                if (!$user->save(false)) {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                }
                //return $this->refresh();
				return $this->redirect(['update', 'id' => $user->id]);
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render('update', [
                'user' => $user, 
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]);
    }
	
	protected function findModel($id)
    {
        if (is_array($id)) {
            /** @var User $user */
            $model = User::findIdentities($id);
        } else {
            /** @var User $user */
            $model = User::findIdentity($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }
	public function actionQuery($id = NULL)
    {
		//echo $id; exit;
		Yii::$app->response->format = 'json';

		//if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->get();
			//print_r($data);
		    $id = explode(":", $data['id']);
			if (($model = UsersUnit::findOne($id)) != null) {
				return $model;
			}	  
		//}
    }


}
