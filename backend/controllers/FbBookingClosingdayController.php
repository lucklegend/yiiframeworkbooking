<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingClosingday;
use common\models\FbBookingClosingdaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\imperavi\actions\GetAction as ImperaviGet;
use vova07\imperavi\actions\UploadAction as ImperaviUpload;
use yii\filters\AccessControl;
/**
 * FbBookingClosingdayController implements the CRUD actions for FbBookingClosingday model.
 */
class FbBookingClosingdayController extends Controller
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
			'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => '../statics/web/closingday/notes',
                'path' => '@statics/web/closingday/notes'
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/closingday/notes',
                'path' => '@statics/web/closingday/notes'
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/closingday/files',
                'path' => '@statics/web/closingday/files',
                'uploadOnlyImage' => false
            ],
        ];
    }


    /**
     * Lists all FbBookingClosingday models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FbBookingClosingdaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FbBookingClosingday model.
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
     * Creates a new FbBookingClosingday model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FbBookingClosingday();

        if ($model->load(Yii::$app->request->post())) {
			//$model->facility = implode(',', $_POST['FbBookingClosingday']['facility']); 
			$model->id;
			 /*foreach($_POST['FbBookingClosingday']['facility'] as $value){

				$model->facility = $value; 
				//$model->additional_muscles;
				$model->id;
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
     * Updates an existing FbBookingClosingday model.
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
     * Deletes an existing FbBookingClosingday model.
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
     * Finds the FbBookingClosingday model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FbBookingClosingday the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FbBookingClosingday::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
