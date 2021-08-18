<?php

namespace app\controllers;

use Yii;
use common\models\Pages;
use common\models\PagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use vova07\imperavi\actions\GetAction as ImperaviGet;
use vova07\imperavi\actions\UploadAction as ImperaviUpload;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\db\Query;

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
     
	 public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@statics/temp/pages'
            ],
			'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => '../statics/web/pages/notes',
                'path' => '@statics/web/pages/notes'
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/pages/notes',
                'path' => '@statics/web/pages/notes'
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/pages/files',
                'path' => '@statics/web/pages/files',
                'uploadOnlyImage' => false
            ],
        ];
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = new Query;
        $query->select(['category'])	
        ->from('pages');
		$command = $query->createCommand();
		$pages = $command->queryAll();

        return $this->render('index', [
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

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post())) {
			$model->created_on = date('Y-m-d h:i:s');
			$model->category = $_GET['id'];
			$file = UploadedFile::getInstance($model, 'attachment');
			$ext = end((explode(".", $file->name)));
			$new_name = Yii::$app->security->generateRandomString().".{$ext}";
			$path = Yii::$app->params['uploadPath'] . '/' . $new_name;
			$model->attachment = $new_name;
			$model->created_by = Yii::$app->user->getId();
	
			if($model->save(false))      
			{               
				$file->saveAs($path);
			}
			$command = Yii::$app->db->createCommand('UPDATE pages SET attachment="'.$new_name.'" WHERE id='.$model->id);
			$imgup = $command->execute(); 
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
		
		$model->attachment;

        if ($model->load(Yii::$app->request->post())) {
			/*$no=rand(0,1000);
			$image = UploadedFile::getInstance($model, 'attachment');
			echo $model->attachment = 'statics/web/pages/files/' .$no.$image; exit;
			//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
			if($model->save())      
			{               
				if($image != '')
				{
				$image->saveAs($model->attachment);
				
				}
			}*/
			$file = UploadedFile::getInstance($model, 'attachment');
			if($file){
				// store the source file name
				$ext = end((explode(".", $file->name)));
		
				$new_name = Yii::$app->security->generateRandomString().".{$ext}";
			   // echo $new_name; exit;
				$path = Yii::$app->params['uploadPath'] . '/' . $new_name;
				$model->attachment = $new_name;
			} 
	
		   // $file->saveAs($path);
	
			//$model->save();
			if($model->save(false))      
			{               
				if($file){
					$file->saveAs($path);
					$command = Yii::$app->db->createCommand('UPDATE pages SET attachment="'.$new_name.'" WHERE id='.$model->id);
					$imgup = $command->execute(); 
				}
			}
			
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

        return $this->redirect(['index' , 'PagesSearch[category]' =>1 ,'data' =>  1 ]);
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
