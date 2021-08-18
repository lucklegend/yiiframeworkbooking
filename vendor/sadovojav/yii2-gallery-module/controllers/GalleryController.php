<?php

namespace sadovojav\gallery\controllers;

use Yii;
use sadovojav\gallery\models\GalleryFile;
use sadovojav\gallery\models\Gallery;
use sadovojav\gallery\models\GallerySearch;
use sadovojav\gallery\Module;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * Class GalleryController
 * @package sadovojav\gallery\controllers
 */
class GalleryController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete', 'update', 'upload', 'remove', 'caption'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                    'upload' => ['post'],
                    'remove' => ['post'],
                    'caption' => ['post'],
                ],
            ],
        ];
    }

    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException();
        }

        $files = UploadedFile::getInstancesByName('files');

        $baseDir = Yii::getAlias(Module::getInstance()->basePath);

        if (!is_dir($baseDir)) {
            mkdir($baseDir);
        }

        $dir = $baseDir . DIRECTORY_SEPARATOR . $_POST['galleryId'];

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $response = [];

        foreach ($files as $key => $file) {
            if (Module::getInstance()->uniqueName) {
                $name = $this->getUniqueName($file);
            } else {
                $name = $file->name;
            }

            $file->saveAs($dir . DIRECTORY_SEPARATOR . $name);

            $model = new GalleryFile();
            $model->galleryId = $_POST['galleryId'];
            $model->file = $name;

            if ($model->save()) {
                $response = [
                    'status' => true,
                    'message' => 'Success',
                    'html' => $this->renderAjax('_image', [
                        'model' => $model
                    ])
                ];
            }

            break;
        }

        return $response;
    }

    /**
     * Deletes an existing gallery fle model.
     * @param integer $id
     * @return mixed
     */
    public function actionRemove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = false;

        if (!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException();
        }

        $model = GalleryFile::findOne(Yii::$app->request->post('id'));

        if (file_exists($model->path)) {
            unlink($model->path);
        }

        if ($model->delete()) {
            $response = [
                'status' => true,
                'message' => 'Success',
            ];
        }

        return $response;
    }

    public function actionCaption()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException();
        }

        $response = false;

        $model = GalleryFile::findOne(Yii::$app->request->post('id'));
        $model->caption = Yii::$app->request->post('caption');

        if ($model->save()) {
            $response = [
                'status' => true,
                'message' => 'Success',
            ];
        }

        return $response;
    }

    /**
     * Get unique name
     * @param $file
     * @return string
     */
    private function getUniqueName($file)
    {
        $explodeName = explode('.', $file->name);

        $ext = end($explodeName);

        return Yii::$app->security->generateRandomString(16) . ".{$ext}";
    }

    /**
     * Lists all gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
     
		 $query = new Query;
	     $query->select(['*'])
		   ->from('gallery')
		    ->orderby(['created' => SORT_DESC]);
		  $command = $query->createCommand();
		  $dataProvider = $command->queryAll();
		  
		 // $dataProvider->sort = ['defaultOrder' => ['created' => 'DESC']];

      if(\Yii::$app->user->isGuest){
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            //'searchModel' => $searchModel
        ]);
	  }else {
		 return $this->render('index-admin', [
            'dataProvider' => $dataProvider,
            //'searchModel' => $searchModel
        ]);

	  }
    }
	
	/**
     * Lists all gallery models.
     * @return mixed
     */
    public function actionIndex1()
    {
      		
		 $query = new Query;
	     $query->select(['*'])
		   ->from('gallery')
		    ->orderby(['created' => SORT_DESC]);
		  $command = $query->createCommand();
		  $dataProvider = $command->queryAll();
		  
		 // $dataProvider->sort = ['defaultOrder' => ['created' => 'DESC']];

      
        return $this->render('index1', [
            'dataProvider' => $dataProvider,
            //'searchModel' => $searchModel
        ]);
	 
    }

    /**
     * Displays a single gallery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
			'gallery' => $this->findGallery($id),
        ]);
    }
	
	 public function actionGallery($id)
    { 
	   $query = new Query;
	     $query->select(['*'])
		   ->from('gallery_file')
		  ->where(['galleryId' => $id]);
		  //->groupby('galleryId');
		  $command = $query->createCommand();
		  $images = $command->queryAll();
		//print_r($images);  exit;
        return $this->render('gallery', [
		'images' => $images,
		'id' => $id,
		]);
    }
	
	public function actionGallery1($id)
    { 
	   $query = new Query;
	     $query->select(['*'])
		   ->from('gallery_file')
		  ->where(['galleryId' => $id]);
		  //->groupby('galleryId');
		  $command = $query->createCommand();
		  $images = $command->queryAll();
		// print_r($images);  exit;
        return $this->render('gallery1', [
		'images' => $images,
		'id' => $id,
		]);
    }
	
	 public function actionGallerysite($id)
    { 
	   $query = new Query;
	     $query->select(['*'])
		   ->from('gallery_file')
		  ->where(['galleryId' => $id]);
		  //->groupby('galleryId');
		  $command = $query->createCommand();
		  $images = $command->queryAll();
		// print_r($images);  exit;
        return $this->render('gallerysite', [
		'images' => $images,
		'id' => $id,
		]);
    }


    /**
     * Creates a new gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['gallery1', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index1']);
    }

    /**
     * Finds the gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findGallery($id)
    {
        if (($model = GalleryFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}