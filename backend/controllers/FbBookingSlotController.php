<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingSlot;
use common\models\FbBookingFacility;
use common\models\FbBookingGroup;
use common\models\FbBookingSlotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * FbBookingSlotController implements the CRUD actions for FbBookingSlot model.
 */
class FbBookingSlotController extends Controller
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
     * Lists all FbBookingSlot models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FbBookingSlotSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FbBookingSlot model.
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
     * Creates a new FbBookingSlot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new FbBookingSlot();
		$modelFac = new FbBookingFacility();
		$facility = ArrayHelper::map($modelFac->find()->where(['id'=>$id])->all(),'id','name');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'id' => $id, 'facility' =>$facility,
            ]);
        }
    }


    public function actionCreate1($id)
    {
        $model = new FbBookingSlot();
		$modelFac = new FbBookingGroup();
		$group = ArrayHelper::map($modelFac->find()->where(['id'=>$id])->all(),'id','name');


        if ($model->load(Yii::$app->request->post()) ) { 
            $model->group = Yii::$app->request->post('FbBookingSlot')['group']; 
            $model->save(false); 
            return $this->redirect(['view1', 'id' => $model->id]);
        } else {
            return $this->render('create1', [
                'model' => $model, 'id' => $id, 'group' =>$group,
            ]);
        }
    }

      /**
     * Updates an existing FbBookingSlot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate1($id)
    {
        $model = $this->findModel($id);
        
		$modelFac = new FbBookingGroup();
		$group = ArrayHelper::map($modelFac->find()->where(['id'=> $model->group])->all(),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view1', 'id' => $model->id]);
        } else {
            return $this->render('update1', [
                'model' => $model, 'id' => $id, 'group' =>$group,
            ]);
        }
    }

       /**
     * Displays a single FbBookingSlot model.
     * @param integer $id
     * @return mixed
     */
    public function actionView1($id)
    {
        return $this->render('view1', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Updates an existing FbBookingSlot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$modelFac = new FbBookingFacility();
		$facility = ArrayHelper::map($modelFac->find()->where(['id' => $model->id])->all(),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'id' => $id, 'facility' =>$facility,
            ]);
        }
    }

    /**
     * Deletes an existing FbBookingSlot model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
          $this->findModel($id)->delete();


          return $this->redirect(['/fb-booking-group/index']);
    }


     /**
     * Deletes an existing FbBookingSlot model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete1($id)
    {
          $this->findModel($id)->delete();


        return $this->redirect(['/fb-booking-group/index']);
    }


    /**
     * Finds the FbBookingSlot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FbBookingSlot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FbBookingSlot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
