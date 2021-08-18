<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingFacility;
use common\models\FbBookingFacilitySearch;
use common\models\FbBookingSlot;
use common\models\FbBookingSlotSearch;
use common\models\FbBookingRules;
use common\models\FbBookingRulesSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use vova07\imperavi\actions\GetAction as ImperaviGet;
use vova07\imperavi\actions\UploadAction as ImperaviUpload;
use yii\filters\AccessControl;


/**
 * FbBookingFacilityController implements the CRUD actions for FbBookingFacility model.
 */
class FbBookingFacilityController extends Controller
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
                'path' => '@statics/temp/facility'
            ],
			'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => '../statics/web/facility/notes',
                'path' => '@statics/web/facility/notes'
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/facility/notes',
                'path' => '@statics/web/facility/notes'
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/facility/files',
                'path' => '@statics/web/facility/files',
                'uploadOnlyImage' => false
            ],
        ];
    }
    /**
     * Lists all FbBookingFacility models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FbBookingFacilitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FbBookingFacility model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		/*$searchModel = new FbBookingSlotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/
		$dataProvider1 = new ActiveDataProvider([
            'query' => FbBookingRules::find()->where([
                'facility' => $id
            ])
        ]);
		$modelSlot = new FbBookingSlot();
		$modelRule = new FbBookingRules();
		$dataProvider = new ActiveDataProvider([
            'query' => FbBookingSlot::find()->where([
                'facility' => $id
            ])
        ]);
		
		/*$searchModel1 = new FbBookingRulesSearch();
        $dataProvider1 = $searchModel->search(Yii::$app->request->queryParams);
*/
		
        return $this->render('view', [
            'model' => $this->findModel($id),
			//'searchModel' => $searchModel,
            'dataProvider1' => $dataProvider1,
			'dataProvider' => $dataProvider,
			'modelSlot' => $modelSlot,
			'modelRule' => $modelRule,
/*			'searchModel1' => $searchModel1,
            'dataProvider1' => $dataProvider1,
*/        ]);
    }

    /**
     * Creates a new FbBookingFacility model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FbBookingFacility();

        if ($model->load(Yii::$app->request->post())) {
			
			$post = Yii::$app->request->post();
			$postModel = $post['FbBookingFacility'];
			$block = $postModel['block_days'];
		    /*if(!empty($block)){
			$model->block_days = implode(",", $block); 
			}
			else
			{   
			$model->block_days = 'None';
			}*/
			$model->save(); 
			//$model->created = date('Y-m-d h:i:s');
			/*$no=rand(0,1000);
			$image = UploadedFile::getInstance($model, 'image');
			$model->image = 'web/uploads/facility/' .$no.$image;
			//$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
			if($model->save()) {               
				if($image != ''){
					$image->saveAs($model->image);
				}
			}*/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FbBookingFacility model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->block_days = explode(',', $model->block_days);   

        if ($model->load(Yii::$app->request->post())) {
			
		   $post = Yii::$app->request->post();
			$postModel = $post['FbBookingFacility'];
			$block = $postModel['block_days'];
			/*if(!empty($block)){
			$model->block_days = implode(",", $block); 
			}
			else
			{
			$model->block_days = 'None';
			}*/
			$model->save();
            /*$no=rand(0,1000);
            $image = UploadedFile::getInstance($model, 'image');
            //echo $image; exit;
            $model->image = 'web/uploads/facility/' .$no.$image;
            //$path = \Yii::$app->basePath.'/web/uploads/' . $model->image;  ///  $model->varImage
            if($model->save())      
            {               
            if($image != '')
            {
            $image->saveAs($model->image);
            
            }
            }*/
            return $this->redirect(['view', 'id' => $model->id]);
	 
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FbBookingFacility model.
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
     * Finds the FbBookingFacility model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FbBookingFacility the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FbBookingFacility::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
