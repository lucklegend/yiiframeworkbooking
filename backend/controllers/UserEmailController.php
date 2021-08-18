<?php

namespace app\controllers;

use Yii;
use common\models\UserEmail;
use common\models\UserEmailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserEmailController implements the CRUD actions for UserEmail model.
 */
class UserEmailController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
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
     * Lists all UserEmail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserEmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserEmail model.
     * @param integer $user_id
     * @param string $token
     * @return mixed
     */
    public function actionView($user_id, $token)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $token),
        ]);
    }

    /**
     * Creates a new UserEmail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserEmail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'token' => $model->token]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserEmail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param string $token
     * @return mixed
     */
    public function actionUpdate($user_id, $token)
    {
        $model = $this->findModel($user_id, $token);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'token' => $model->token]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserEmail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param string $token
     * @return mixed
     */
    public function actionDelete($user_id, $token)
    {
        $this->findModel($user_id, $token)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserEmail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param string $token
     * @return UserEmail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $token)
    {
        if (($model = UserEmail::findOne(['user_id' => $user_id, 'token' => $token])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
