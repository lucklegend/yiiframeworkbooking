<?php

namespace app\controllers;

use Yii;
use common\models\Useful;
use common\models\UsefulSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsefulController implements the CRUD actions for Useful model.
 */
class UsefulController extends Controller
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
     * Lists all Useful models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsefulSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$useful = Useful::find()
					->orderBy([
						'service'=>SORT_ASC,
						'name' => SORT_ASC,
					])->all();
					//])->asArray()->all();
		$services = [];
		foreach($useful as $data){
			//$cat = $data['service'];
			//print_r($data);
			$cat = $data->type0->name;
			//$cat = $data->service;
			$services["$cat"][] = $data;
		}
		ksort($services);
					
        return $this->render('index', [
            'services' => $services,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Useful model.
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
     * Finds the Useful model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Useful the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Useful::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
