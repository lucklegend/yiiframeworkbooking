<?php

namespace app\controllers;

use Yii;
use common\models\Contacts;
use common\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
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
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex() 
    {
        $searchModel = new ContactsSearch();
		$contacts = Contacts::find()->where(["type" => 1])->all();
        // print_r($contacts); 

        $param = Yii::$app->request->queryParams;
       if(!isset($param['ContactsSearch']['type'])){
          $param['ContactsSearch']['type'] = 1;
        } 
        $dataProvider = $searchModel->search($param);

        return $this->render('index', [
            'contacts' => $contacts,
            'dataProvider' => $dataProvider,
        ]);
    
}
   

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
