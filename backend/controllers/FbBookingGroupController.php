<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingGroup;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use common\models\FbBookingGroupSearch;
use common\models\FbBookingRules;
use common\models\FbBookingSlot;
use common\models\FbBookingRulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use vova07\imperavi\actions\GetAction as ImperaviGet;
use vova07\imperavi\actions\UploadAction as ImperaviUpload;
use yii\filters\AccessControl;

/**
 * FbBookingGroupController implements the CRUD actions for FbBookingGroup model.
 */
class FbBookingGroupController extends Controller
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
                'path' => '@statics/temp/groups'
            ],
			'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => '../statics/web/groups/notes',
                'path' => '@statics/web/groups/notes'
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/groups/notes',
                'path' => '@statics/web/groups/notes'
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/groups/files',
                'path' => '@statics/web/groups/files',
                'uploadOnlyImage' => false
            ],
        ];
    }

    /**
     * Lists all FbBookingGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FbBookingGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FbBookingGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		/*$searchModel = new FbBookingRulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/
		
		$dataProvider = new ActiveDataProvider([
            'query' => FbBookingRules::find()->where([
                'group' => $id
            ])
        ]);

		
		$dataProvider1 = new ActiveDataProvider([
            'query' => FbBookingSlot::find()->where([
                'group' => $id
            ])
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
			//'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'dataProvider1' => $dataProvider1,

        ]);
    }

    /**
     * Creates a new FbBookingGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FbBookingGroup();

         if ($model->load(Yii::$app->request->post())) {
			 
			 $model->save();
			
			/*$no=rand(0,1000);
			if($model->image == '') {
			$image = UploadedFile::getInstance($model, 'image');
			$model->image = 'web/uploads/groups/' .$no.$image;
			}
			//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
			if($model->save())      
			{               
				if($image != '')
				{
					$image->saveAs($model->image);
				
				}*/
	            return $this->redirect(['view', 'id' => $model->id]);
		 } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FbBookingGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post())) {
       /* $no=rand(0,1000); 
			if(!empty($model->image)) {
			$model->image = $img;
			} else {
				$image = UploadedFile::getInstance($model, 'image');
				$model->image =$no.$image;
			}
			//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
			if($model->save())      
			{               
				if($image != '')
				{
					$image->saveAs('web/uploads/groups/' .$model->image);
				
				}*/
				$model->save();
	            return $this->redirect(['view', 'id' => $model->id]);
		 } 
		else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FbBookingGroup model.
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
     * Finds the FbBookingGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FbBookingGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FbBookingGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
