<?php

namespace app\controllers;

use Yii;
use common\models\Events;
use common\models\EventsSearch;
use common\models\EventsNotes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use vova07\imperavi\actions\GetAction as ImperaviGet;
use vova07\imperavi\actions\UploadAction as ImperaviUpload;
use yii\filters\AccessControl;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
                    'delete' => ['GET','POST'],
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
     
	 public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@statics/temp/events'
            ],
			'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => '../statics/web/events/notes',
                'path' => '@statics/web/events/notes'
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/events/notes',
                'path' => '@statics/web/events/notes'
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/events/files',
                'path' => '@statics/web/events/files',
                'uploadOnlyImage' => false
            ],
        ];
    }
 
    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$modelSlot = new EventsNotes();
		$dataProvider = new ActiveDataProvider([
            'query' => EventsNotes::find()->where([
                'event_id' => $id
            ])
        ]);
		
        return $this->render('view', [
            'model' => $this->findModel($id),
			'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Events();

         if ($model->load(Yii::$app->request->post())) {
			
		/*$no=rand(0,1000);
		$image = UploadedFile::getInstance($model, 'image');
		$model->image = 'web/uploads/events/' .$no.$image;
		//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
		if($model->save())      
		{               
			if($image != '')
			{
			$image->saveAs($model->image);
			
			}
		}*/
		$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			
		/*$no=rand(0,1000);
		$image = UploadedFile::getInstance($model, 'image');
		$model->image = 'web/uploads/events/' .$no.$image;
		//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
		if($model->save())      
		{               
		if($image != '')
		{
		$image->saveAs($model->image);
		
		}
		}*/
		$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
	 
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Events model.
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
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
