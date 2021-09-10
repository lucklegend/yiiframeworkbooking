<?php

namespace app\controllers;

use Yii;
use common\models\Pages;
use common\models\PagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\web\UploadedFile;
/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex($id)
    {
       $query = new Query;
		$query->select(['*'])
			->from('pages')
			->where(['category' => $id])
            ->orderBy(['id'=>SORT_DESC]);
		$command = $query->createCommand();
		$pages = $command->queryAll(); 
		
		$query = new Query;
		$query->select(['*'])
			->from('pages_categories')
			->where(['id' => $id]);
		$command = $query->createCommand();
		$cats = $command->queryAll(); 
		
		foreach ($cats as $cat){
        if($cat['type'] == 1){
			return $this->render('index3', [
				'pages' => $pages, 'cat' => $cat,
			]);
		}
		else{
			return $this->render('index', [
				'pages' => $pages, 'cat' => $cat,
			]);

		}
		}

    }
	 public function actionIndex3($id)
    {
       $query = new Query;
		$query->select(['*'])
			->from('pages')
			->where(['category' => $id]);
		$command = $query->createCommand();
		$pages = $command->queryAll(); 

		return $this->render('index3', [
            'pages' => $pages,
        ]);
    }
    public function actionCommunity($id)
    {
            $searchModel = new pagesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            $query = new Query;
            $query->select(['*'])
                ->from('pages')->where(['category' => $id]);
            $command = $query->createCommand();
            $pages = $command->queryAll(); 
            
            return $this->render('community', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'pages' => $pages,
            ]);
        
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    
    public function actionNearby()
    {	
		$model = new Pages();
		
        return $this->render('nearby_amenities', [
            'model' => $model,
        ]);
    }



    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post())) {
		
		$no=rand(0,1000);
		$image = UploadedFile::getInstance($model, 'attachment');
		$model->attachment = 'backend/web/uploads/pages/' .$no.$image;
		//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
		if($model->save())      
		{               
			if($image != '')
			{
			$image->saveAs($model->attachment);
			
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
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
