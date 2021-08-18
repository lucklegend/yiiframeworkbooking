<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingRules;
use common\models\FbBookingFacility;
use common\models\FbBookingGroup;
use common\models\FbBookingRulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * FbBookingRulesController implements the CRUD actions for FbBookingRules model.
 */
class FbBookingRulesController extends Controller
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
     * Lists all FbBookingRules models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FbBookingRulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FbBookingRules model.
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
     * Creates a new FbBookingRules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
		 
        $model = new FbBookingRules();
		
		/*$modelGro = new FbBookingGroup();
		$group = ArrayHelper::map($modelGro->find()->where(['id'=>$id])->all(),'id','name');*/
		$group = NULL;
		
		$modelFac = new FbBookingFacility();
		$facility = ArrayHelper::map($modelFac->find()->where(['id'=>$id])->all(),'id','name');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'id' => $id, 'group' =>$group, 'facility' =>$facility,
            ]);
        }
    }
	
	 public function actionCreate1($id)
    {
        $model = new FbBookingRules();
		
		$modelGro = new FbBookingGroup();
		$group = ArrayHelper::map($modelGro->find()->where(['id'=>$id])->all(),'id','name');
		
		$facility = NULL;
		/*$modelFac = new FbBookingFacility();
		$facility = ArrayHelper::map($modelFac->find()->where(['id'=>$id])->all(),'id','name');
*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create1', [
                'model' => $model, 'id' => $id, 'group' =>$group, 'facility' =>$facility,
            ]);
        }
    }

    /**
     * Updates an existing FbBookingRules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		/*$modelGro = new FbBookingGroup();
		$group = ArrayHelper::map($modelGro->find()->where(['id'=>$id])->all(),'id','name');*/
		$group = NULL;
		
		$modelFac = new FbBookingFacility();
		$facility = ArrayHelper::map($modelFac->find()->where(['id'=>$model->group])->all(),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'id' => $id, 'group' =>$group, 'facility' =>$facility,
            ]);
        }
    }
	 public function actionUpdate1($id)
    {
        $model = $this->findModel($id);
		
		$modelGro = new FbBookingGroup();
		$group = ArrayHelper::map($modelGro->find()->where(['id'=>$model->group])->all(),'id','name');
		
		/*$modelFac = new FbBookingFacility();
		$facility = ArrayHelper::map($modelFac->find()->where(['id'=>$id])->all(),'id','name');*/
		
		$facility = NULL;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update1', [
                'model' => $model, 'id' => $id, 'group' =>$group, 'facility' =>$facility,
            ]);
        }
    }

    /**
     * Deletes an existing FbBookingRules model.
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
     * Finds the FbBookingRules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FbBookingRules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FbBookingRules::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
