<?php

namespace app\controllers;

use Yii;
use common\models\Events;
use common\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
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
                    'delete' => ['POST'],
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
     * Lists all Events models.
     * @return mixed
     */
    public function actionCalendar()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $calendarData = Events::find()
							->where("'start_date' >= '" .  date("Y-m-d") . "'")
							->andWhere(['publish' => 1])
							->all();
					
					
		$events = array();
					
		if(count($calendarData)){
			foreach ($calendarData as $item){
				
				$Event = new \yii2fullcalendar\models\Event();
				$Event->id = $item->id;
				$Event->title = $item->title;
				$Event->start = date('Y-m-d\TH:i:s\Z', strtotime($item->start_date . ' ' . $item->start_time));
				$url = 'index.php?r=events/view&id=' . $item->id;
				$Event->url = $url;
				$events[] = $Event;
				
			}
			
		}
		

        return $this->render('calendar', [
            'events' => $events,
           // 'dataProvider' => $dataProvider,
			
        ]);
    }
	

    /**
     * Displays a single Events model.
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
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Events();

         if ($model->load(Yii::$app->request->post())) {
			
		$no=rand(0,1000);
		$image = UploadedFile::getInstance($model, 'image');
		$model->image = 'backend/web/uploads/events/' .$no.$image;
		//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
		if($model->save())      
		{               
			if($image != '')
			{
			$image->saveAs($model->image);
			
			}
		}
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
//     public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post())) {
//			
//		$no=rand(0,1000);
//		$image = UploadedFile::getInstance($model, 'image');
//		$model->image = 'backend/web/uploads/events/' .$no.$image;
//		//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
//		if($model->save())      
//		{               
//		if($image != '')
//		{
//		$image->saveAs($model->image);
//		
//		}
//		}
//            return $this->redirect(['view', 'id' => $model->id]);
//	 
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }


    /**
     * Deletes an existing Events model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

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
