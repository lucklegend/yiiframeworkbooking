<?php

namespace app\controllers;

use Yii;
use common\models\EventsNotes;
use common\models\EventsNotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Events;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * EventsNotesController implements the CRUD actions for EventsNotes model.
 */
class EventsNotesController extends Controller
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
     * Lists all EventsNotes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventsNotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EventsNotes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EventsNotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new EventsNotes();
		
		$modelEve = new Events();
		$events = ArrayHelper::map($modelEve->find()->where(['id' => $id])->all(),'id','title');


        if ($model->load(Yii::$app->request->post())) {
			$model->updated_on = date('Y-m-d h:i:s');
			 $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'id' => $id, 'events' =>$events,
            ]);
        }
    }

    /**
     * Updates an existing EventsNotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$modelEve = new Events();
		$events = ArrayHelper::map($modelEve->find()->where(['id' => $model->id])->all(),'id','title');

        if ($model->load(Yii::$app->request->post())) {
			$model->updated_on = date('Y-m-d h:i:s');
			$model->updated_by = Yii::$app->user->getId();
			 $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'id' => $id, 'events' =>$events,
            ]);
        }
    }

    /**
     * Deletes an existing EventsNotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EventsNotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventsNotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventsNotes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
