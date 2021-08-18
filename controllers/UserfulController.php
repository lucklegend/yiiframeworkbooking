<?php

namespace app\controllers;

use Yii;
use common\models\Userful;
use common\models\UserfulSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserfulController implements the CRUD actions for Userful model.
 */
class UserfulController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Userful models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserfulSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pages = Userful::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => $pages
        ]);
    }
    public function actionIndex1()
    {
        $searchModel = new UserfulSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pages = Userful::find()->all();

        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => $pages
        ]);
    }

    /**
     * Displays a single Userful model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionNearme()
    {
        return $this->render('nearme');
    }


    /**
     * Finds the Userful model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Userful the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userful::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
