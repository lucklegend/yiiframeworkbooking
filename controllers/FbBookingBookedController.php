<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingBooked;
use common\models\Users;
use common\models\ICS;
use common\models\Iceve;
use common\models\Profiles;
use common\models\FbBookingBookedSearch;
use common\models\MailTemplate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use common\models\BookingRules;
use yii\filters\AccessControl;
use yii\helpers\Json;
/**
 * FbBookingBookedController implements the CRUD actions for FbBookingBooked model.
 */
class FbBookingBookedController extends Controller
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
     * Lists all FbBookingBooked models.
     * @return mixed
     */
    public function actionIndex()
    { 
        $today =  date("Y-m-d");
        $searchModel = new FbBookingBookedSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['FbBookingBookedSearch']['user_id'] = Yii::$app->user->getId();
        $dataProvider = $searchModel->search($queryParams);
       
        $dataProvider->query->andWhere([ '>=', 'date(slot_from)', $today  ]);
        $dataProvider->sort = ['defaultOrder' => ['id' => 'ASC']];
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        //return $this->render('index');
    }

    public function actionOld(){
        
        $today =  date("Y-m-d");
        $searchModel = new FbBookingBookedSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['FbBookingBookedSearch']['user_id'] = Yii::$app->user->getId();
        $dataProvider = $searchModel->search($queryParams);
       
        $dataProvider->query->andWhere([ '<', 'date(slot_from)', $today  ]);
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']]; 

        return $this->render('old', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        //return Json::encode($html);
    }

    public function actionCurr(){
        
        $today =  date("Y-m-d");
        $searchModel = new FbBookingBookedSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['FbBookingBookedSearch']['user_id'] = Yii::$app->user->getId();
        $dataProvider = $searchModel->search($queryParams);
       
        $dataProvider->query->andWhere([ '>', 'date(slot_from)', $today  ]);
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
       
        $html =$this->renderPartial('curr', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        return Json::encode($html);

    }
    
	public function actionIcs($id){  
        $diff = '<=';
        if($id == 2){
            $diff = '>';
        }
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename=invite.ics');
        $today =  date("Y-m-d");
        $bookings = FbBookingBooked::find()
        ->Where(['user_id' => Yii::$app->user->identity->id ])
        ->andWhere([$diff, 'date(slot_from)', $today])
        ->all(); 
        $data = [];
        foreach($bookings as $book){
            $dt = new \DateTime($book->slot_from);
            $dt1 =  new \DateTime($book->slot_to);

        $data[] = ['location' => 'Garden', 'description' => $book->facility0->name , 'dtstart' => $dt->format('Ymd\THis\Z'), 'dtend' => $dt1->format('Ymd\THis\Z'),'summary' =>  $book->facility0->name,
        'url' => '',
        'alarm' => '']; 

         }

        $ics = new Iceve($data);
        echo $ics->prepare(); 
    }

	public function actionPending($facility_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FbBookingBooked::find()->where([
                'status' => 1,
				'facility_id' => $facility_id,
            ])
        ]);
		
		$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('pending', [
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionConfirm($facility_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FbBookingBooked::find()->where([
                'status' => 2,
				'facility_id' => $facility_id,
            ])
        ]);
		
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
		
        return $this->render('confirm', [
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionCancel($facility_id)
		{
			$dataProvider = new ActiveDataProvider([
				'query' => FbBookingBooked::find()->where([
					'status' => 3,
					'facility_id' => $facility_id,
				])
			]);
			
	        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
			
			return $this->render('cancel', [
				'dataProvider' => $dataProvider,
			]);
		}
		
		public function actionLapsed($facility_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FbBookingBooked::find()->where([
                'status' => 4,
				'facility_id' => $facility_id,
            ])
        ]);
		
		$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('lapsed', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FbBookingBooked model.
     * @param integer $id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/
	
	public function actionView($id)
	{
		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('view', [
				'model' => $this->findModel($id),
			]);
		} else {
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}
	}
	
	public function actionPayment($id)
	{
		 $model = $this->findModel($id);
		 return $this->render('payment', [
                'model' => $model,
            ]);
	}
	
	 public function actionUsercancel($id) 
    {
		$command = Yii::$app->db->createCommand('UPDATE `fb_booking_booked` SET `cancelled_time`="'.date('Y-m-d h:i:s'). '", `cancelled_by`='.Yii::$app->user->getId(). ' WHERE id='.$id);
		$status = $command->execute(); 


        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionCancelupdate($id)
    {
        $model = $this->findModel($id);
  	
        $model->cancelled_time = date('Y-m-d h:i:s');
        $model->cancelled_by = Yii::$app->user->getId();
        $model->status = 3;
        $model->cancelled_reason = '';
        $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
    }
	
		public function actionConfirmbooking($id, $pid)
    {
        $model = $this->findModel($id);
		
		$query = new Query;
		$query->select(['title'])
			->from('fb_booking_payment_method')
			->where(['id' => $pid])
			->limit(1);
		$command = $query->createCommand();
		$pay = $command->queryScalar();

  		$post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
			$model->payment_method_id = $post['FbBookingBooked']['payment_method_id'];
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->redirect(['view', 'id' => $id]); 
            /* return $this->render('confirmbooking', [
                'model' => $model, 'pid' => $pid, 'pay' => $pay, 
            ]); */
        }
    }


	
	public function actionReview($id)
    {
	$query = new Query;
	$query->select(['created_by'])
	    ->from('fb_booking_booked')
	    ->where(['id' => $id]);
	$command = $query->createCommand();
	$userid = $command->queryScalar();
	
	$query = new Query;
	$query->select(['user_unit'])
	    ->from('users')
	    ->where(['id' => $userid]);
	$command = $query->createCommand();
	$userunit = $command->queryScalar();
	//echo $userunit; 
	$query = new Query;
	$query->select(['unit_name'])
	    ->from('users_unit')
	    ->where(['id' => $userunit]);
	$command = $query->createCommand();
	$unit = $command->queryScalar();
	
	$query = new Query;
	$query->select(['unit_level'])
	    ->from('users_unit')
	    ->where(['id' => $userunit]);
	$command = $query->createCommand();
	$level = $command->queryScalar();

        return $this->renderAjax('review', [
            'model' => $this->findModel($id),
			'user' =>  $this->findUser($userid), 
			'level' => $level,
			'unit' => $unit,
			//'id' => $id,
        ]);
    }
	
	public function actionDashboard()
    {
	   $query = new Query;
	$query->select(['*'])
	    ->from('fb_booking_facility');
	    //->where(['id' => $id]);
	$command = $query->createCommand();
	$facilities = $command->queryAll();
	//print_r($facilities); exit;
	$query = new Query;
	$query->select(['title'])
	    ->from('fb_booking_status')
		->orderby(['id' => 'ASC'])
		->limit(4);
	$command = $query->createCommand();
	$status = $command->queryAll();

        return $this->render('dashboard',[
		'facilities' => $facilities,
		'status' => $status,
		]);
    }
	
	public function actionPrint($id) {
		
		$query = new Query;
	$query->select(['created_by'])
	    ->from('fb_booking_booked')
	    ->where(['id' => $id]);
	$command = $query->createCommand();
	$userid = $command->queryScalar();
	
    $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        'content' => $this->renderPartial('print',[
            'model' => $this->findModel($id),
			'user' =>  $this->findUser($userid), 
        ]),
		'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
		'cssInline' => '.kv-heading-1{font-size:18mm}',
        'options' => [
            'title' => 'Facility Booking',
            'subject' => 'Facility Booking - JT'
        ],
        'methods' => [
            'SetHeader' => ['Generated By: Facility Booking||Generated On: ' . date("r")],
            'SetFooter' => ['|Page {PAGENO}|'],
        ]
    ]);
    return $pdf->render();
}

    /**
     * Creates a new FbBookingBooked model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FbBookingBooked();
		$userId = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
			$model->created = date('Y-m-d H:i:s');
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } elseif (Yii::$app->request->get('hash')) {
			$data = Yii::$app->request->get();
			if($data['hash'] == md5($data['facid'].$data['tid'])){
				$slotFrom = date('Y-m-d H:i:s', $data['tid']);
				
				$brules = new BookingRules();
				$checkSave = $brules->checkSave($data['facid'],$userId, $slotFrom);
				$_POST = $checkSave;

				if($checkSave['can'] == 1){

					$model->user_id = $checkSave['user_id'];
					$model->facility_id = $checkSave['facility_id'];
					$model->slot_from = $checkSave['slot_from'];
					$model->slot_to = $checkSave['slot_to'];
					$model->lapse_date = $checkSave['lapse_date'];
					$model->lasttime_book = $checkSave['lasttime_book'];
					$model->peak = $checkSave['peak'];
					$model->created = $checkSave['created'];
					$model->created_by = $checkSave['created_by'];
					$model->status = $checkSave['status'];

					if($model->save()){
						$mail = new MailTemplate();
						$mailtemp = $mail->sendMail(1, $userId, array($model->facility_id, $model->slot_from, $model->slot_to));
					}

                    if($model->facility0->group == '18' || $model->facility0->group == '41'){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
					return $this->redirect(['payment', 'id' => $model->id]);
				}
                

			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FbBookingBooked model.
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
     * Deletes an existing FbBookingBooked model.
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
     * Finds the FbBookingBooked model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FbBookingBooked the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FbBookingBooked::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function findUser($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function findProfile($id)
    {
        if (($model = Profiles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
