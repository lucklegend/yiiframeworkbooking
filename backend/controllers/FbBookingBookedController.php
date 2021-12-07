<?php

namespace app\controllers;

use Yii;
use common\models\FbBookingBooked;
use common\models\Users;
use common\models\Profiles;
use common\models\FbBookingBookedSearch;
use common\models\FbBookingFacility;
use common\models\FbBookingSlot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use common\models\BookingRules;
use vova07\imperavi\actions\GetAction as ImperaviGet;
use vova07\imperavi\actions\UploadAction as ImperaviUpload;
use yii\filters\AccessControl;

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
		 $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['imperavi-get', 'imperavi-image-upload', 'imperavi-file-upload'],
            //'roles' => ['BCreateBlogs', 'BUpdateBlogs']
        ];
    }
	
	    public function actions()
    {
        return [
            'imperavi-get' => [
                'class' => ImperaviGet::className(),
                'url' => '../statics/web/booking/notes',
                'path' => '@statics/web/booking/notes'
            ],
            'imperavi-image-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/booking/notes',
                'path' => '@statics/web/booking/notes'
            ],
            'imperavi-file-upload' => [
                'class' => ImperaviUpload::className(),
                'url' => '../statics/web/booking/files',
                'path' => '@statics/web/booking/files',
                'uploadOnlyImage' => false
            ],
        ];
    }


    /**
     * Lists all FbBookingBooked models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FbBookingBookedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionReport()
    {
        $model = new FbBookingBooked();

        if ($model->load(Yii::$app->request->post())) {
            $userid = $model->user_id;
			$fac =$model->facility_id;
			$from = $model->slot_from;
            $to = $model->slot_to;
            $stat = $model->status;
            return $this->redirect(['search',
			 'userid' => $userid ,
			 'fac' => $fac ,
			 'from' => $from ,
             'to' => $to ,
             'stat' => $stat,
			]);
        } else {
            return $this->render('book_create', [
                'model' => $model,
            ]);
        }
    } 


    
    public function actionSearch($userid, $fac, $from, $to, $stat)
    {
		$model = new FbBookingBooked();
		
		$user = array();
		if($fac >0){
			$user['facility_id'] = $fac;
		}
		if($userid >0){
			$user['user_id'] = $userid;
		}
		if($from ==''){
			$from = '0000-00-00';
		}
		if($to ==''){
			$to = date('Y-m-d');
        }
        if($stat >0){
            $user['status'] = $stat;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => FbBookingBooked::find()
			->where($user)->andwhere(['between','DATE_FORMAT(`slot_from`, "%Y-%m-%d")', $from, $to])
			//->orderby(['id'=> 'DESC'])
        ]); 
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
         

        return $this->render('book', [
            'dataProvider' => $dataProvider,
			'model' => $model,
			'fac' => $fac,
			'userid' => $userid,
			'from' => $from,
            'to' => $to,
            'stat' => $stat,
			]);	
	
   }
    
      
   public function actionSearchpdf($userid, $fac, $from, $to , $stat) {
    $model = new FbBookingBooked();
    
    \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    
    $user = array();
    if($fac >0){
        $user['facility_id'] = $fac;
    }
    if($userid >0){
        $user['user_id'] = $userid;
    }
    if($from ==''){
        $from = '0000-00-00';
    }
    if($to ==''){
        $to = date('Y-m-d');
    } 
    if($stat >0){
        $user['status'] = $stat;
    }
    
    $dataProvider = new ActiveDataProvider([
        'query' => FbBookingBooked::find()
        ->where($user)->andwhere(['between','DATE_FORMAT(`slot_from`, "%Y-%m-%d")', $from, $to]),
        //->orderby(['id'=> 'DESC'])
        'pagination' => [
            'pageSize' => 0,
        ],
    ]);
    $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
   
    $pdf = new Pdf([
        'mode' => Pdf::MODE_BLANK, // leaner size using standard fonts
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER,
        'content' => $this->renderPartial('searchpdf', ['dataProvider' => $dataProvider,
        'model' => $model,
        'fac' => $fac,
        'userid' => $userid,
        'from' => $from,
        'to' => $to,        
        'stat' => $stat,
        ]),
        'options' => [
            'title' => 'Booking Report',
            'subject' => 'List',
        ],
        'methods' => [
            'SetHeader'=>['Booking Report'],
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    return $pdf->render();
    }

    
	public function actionPending($facility_id)
    {
        $where = ['status' => 1];
		if($facility_id) $where['facility_id'] = $facility_id;
		$dataProvider = new ActiveDataProvider([
            'query' => FbBookingBooked::find()->where($where)
        ]);
		
		$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('pending', [
            'dataProvider' => $dataProvider,
        ]);
    }

    

    public function actionCan($id , $userid, $fac, $from, $to , $stat)
    {
        $model = $this->findModel($id); 
        $model->status = 3;
        $model->save(false); 
        
            return $this->redirect(['search',
            'userid' => $userid ,
            'fac' => $fac ,
            'from' => $from ,
            'to' => $to ,
            'stat' => $stat,
            ]); 
       

    }

    public function actionAbs($id , $userid, $fac, $from, $to , $stat)
    {
        $model = $this->findModel($id); 
        $model->status = 5;
        $model->save(false); 

        
        $chk = new FbBookingBooked();
		$allSlots = $chk->getChecked($model); 
         

        
            return $this->redirect(['search',
            'userid' => $userid ,
            'fac' => $fac ,
            'from' => $from ,
            'to' => $to ,
            'stat' => $stat,
            ]); 
       

    }


    public function actionRain($id , $userid, $fac, $from, $to , $stat)
    {
        $model = $this->findModel($id); 
        $model->status = 7;
        $model->save(false); 
        
            return $this->redirect(['search',
            'userid' => $userid ,
            'fac' => $fac ,
            'from' => $from ,
            'to' => $to ,
            'stat' => $stat,
            ]); 
       

    }

    
	
	public function actionConfirm($facility_id)
    {
        $where = ['status' => 2];
		if($facility_id) $where['facility_id'] = $facility_id;
		$dataProvider = new ActiveDataProvider([
            'query' => FbBookingBooked::find()->where($where)
        ]);
		
		$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('confirm', [
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionCancel($facility_id){
		$where = ['status' => 3];
		if($facility_id) $where['facility_id'] = $facility_id;
		
		$dataProvider = new ActiveDataProvider([
			'query' => FbBookingBooked::find()->where($where)
		]);
		
		$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

		return $this->render('cancel', [
			'dataProvider' => $dataProvider,
		]);
	}
	public function actionLapsed($facility_id)
    {
		$where = ['status' => 4];
		if($facility_id) $where['facility_id'] = $facility_id;
		
		$dataProvider = new ActiveDataProvider([
			'query' => FbBookingBooked::find()->where($where)
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
        echo '<script>
            console.log("dito oh :");
            console.log('.json_encode($this->findModel($id)).');
            </script>';
            // var_dump($this->findModel($id));
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
		
		$query = new Query;
		$query->select(['title'])
			->from('fb_booking_status')
			->orderby(['id' => 'ASC'])
			->limit(4);
		$command = $query->createCommand();
        $status = $command->queryAll();
        
//        if( Yii::$app->user->identity->role == 'admin'){
//            return $this->redirect(['today' ]);
//        }
        return $this->render('dashboard',[
		'facilities' => $facilities,
		'status' => $status,
		]);
    }

    public function actionToday() {

        $today =  date("Y-m-d");
        $searchModel = new FbBookingBookedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->andWhere([ '=', 'date(slot_from)', $today  ]);
        $dataProvider->query->andWhere(['status'=> 2 ]);
        return $this->render('today', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
				'format' => \kartik\mpdf\Pdf::FORMAT_A4,
				'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
				'destination' => \kartik\mpdf\Pdf::DEST_DOWNLOAD,
				'content' => $this->renderPartial('print',[
				'model' => $this->findModel($id),
				'user' =>  $this->findUser($userid), 
			]),
            'filename' => 'Facility_Booking_' . $id . '.pdf', 
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			'cssInline' => '.kv-heading-1{font-size:18mm}',
			'options' => [
				'title' => 'Facility Booking',
				'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
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
		$userId = Yii::$app->request->get('uid');

        if ($model->load(Yii::$app->request->post())) {
			$model->created = date('Y-m-d H:i:s');
			 $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } elseif (Yii::$app->request->get('hash')) {
			$data = Yii::$app->request->get();
			
			if($data['hash'] == md5($data['facid'].$data['tid'])){
				$slotFrom = date('Y-m-d H:i:s', $data['tid']);
				//print_r($data); 
				$brules = new BookingRules();
				$checkSave = $brules->checkSave($data['facid'],$userId, $slotFrom);
				//$_POST = $checkSave;
				 //print_r($checkSave); 
				//exit;
				if(Yii::$app->user->identity->role == 'superadmin')
				{
					$checkSave['can'] =1;
				} 
				if($checkSave['can'] == 1){
					//$model->loadMultiple($checkSave);
					/*foreach($checkSave as $key => $value){
						if($model->hasProperty($key)){
							$model->$key = $value;
							echo $model->$key;
						}
					}*/
					$model->user_id = $checkSave['user_id'];
					$model->facility_id = $checkSave['facility_id'];
					$fa = FbBookingFacility::find()->where(['id'=>$checkSave['facility_id']])->one();
					$dep = $fa->deposit;
					
					$pr = FbBookingSlot::find()->where(['facility'=>$checkSave['facility_id']])->one();
					$pri = $pr->price;
					
					$model->slot_from = $checkSave['slot_from'];
					$model->slot_to = $checkSave['slot_to'];
					$model->deposit = $dep;
					$model->price = $pri;
					$model->lapse_date = $checkSave['lapse_date'];
					$model->lasttime_book = $checkSave['lasttime_book'];
					$model->peak = $checkSave['peak'];
					$model->created = $checkSave['created'];
					$model->created_by = $checkSave['created_by'];
					$model->status = $checkSave['status'];
					
					$model->save();
					//print_r($model); 
					//exit;
					return $this->redirect(['view', 'id' => $model->id]);
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
