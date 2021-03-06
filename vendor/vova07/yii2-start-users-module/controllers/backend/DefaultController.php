<?php

namespace vova07\users\controllers\backend;

use vova07\admin\components\Controller;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use vova07\users\models\backend\User;
use vova07\users\models\backend\UserSearch;
use vova07\users\models\Profile;
use vova07\users\Module;
use Yii;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Default backend controller.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['rules'] = [
            [
                'allow' => true,
                'actions' => ['index'], 
            ]
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['create'], 
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['update'], 
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['delete', 'batch-delete'], 
        ];
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['fileapi-upload'], 
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['get','post'],
                'create' => ['get', 'post'],
                'update' => ['get', 'put', 'post'],
                'delete' => ['post', 'delete'],
                'batch-delete' => ['post', 'delete']
            ]
        ];

        return $behaviors;
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
     * Users list page.
     */
    function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]);
    }

    /**
     * Create user page.
     */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'admin-create']);
        $profile = new Profile();
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post()) ) {
            if ($user->validate() ) {
                $user->populateRelation('profile', $profile);   
				$user->user_unit=$_POST['User']['user_unit'];
				$user->fname = $_POST['User']['fname'];  
				$user->lname = $_POST['User']['lname'];  
				$user->type=$_POST['User']['type']; 
				
                 $user->save(false);
                if ($user->save(false)) {
                    return $this->redirect(['index', 'id' => $user->id]);
                } else {
                    Yii::$app->session->setFlash('danger', Module::t('users', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                    //return $this->refresh();
					return $this->redirect(['index']);
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render('create', [
                'user' => $user,
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]);
    }

    /**
     * Update user page.
     *
     * @param integer $id User ID
     *
     * @return mixed View
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $user->setScenario('admin-update');
        $profile = $user->profile;
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

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
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]);
    }

    /**
     * Delete user page.
     *
     * @param integer $id User ID
     *
     * @return mixed View
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Delete multiple users page.
     */
    public function actionBatchDelete()
    {
        if (($ids = Yii::$app->request->post('ids')) !== null) {
            $models = $this->findModel($ids);
            foreach ($models as $model) {
                $model->delete();
            }
            return $this->redirect(['index']);
        } else {
            throw new HttpException(400);
        }
    }

    /**
     * Find model by ID
     *
     * @param integer|array $id User ID
     *
     * @return \vova07\users\models\backend\User User
     * @throws HttpException 404 error if user was not found
     */
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
}
