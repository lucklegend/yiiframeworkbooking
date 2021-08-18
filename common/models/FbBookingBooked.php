<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_booked".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $facility_id
 * @property string $slot_from
 * @property string $slot_to
 * @property double $price
 * @property double $deposit
 * @property double $total_amount
 * @property double $paid_amount
 * @property integer $payment_method_id
 * @property string $payment_details
 * @property integer $payment_status
 * @property double $returned_amount
 * @property integer $returned_by
 * @property string $returned_date
 * @property string $returned_details
 * @property string $cancelled_time
 * @property integer $cancelled_by
 * @property integer $cancelled_reason
 * @property string $lapse_date
 * @property integer $lasttime_book
 * @property integer $peak
 * @property string $notes
 * @property string $created
 * @property integer $created_by
 * @property integer $status
 */
class FbBookingBooked extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_booked';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'facility_id', 'payment_method_id', 'payment_status', 'returned_by', 'cancelled_by', 'lasttime_book', 'peak', 'created_by', 'status'], 'integer'],
            [['slot_from', 'slot_to'], 'required'],
            [['slot_from', 'slot_to', 'returned_date', 'cancelled_time', 'lapse_date', 'created'], 'safe'],
            [['price', 'deposit', 'total_amount', 'paid_amount', 'returned_amount'], 'number'],
            [['notes', 'cancelled_reason'], 'string'],
            [['payment_details', 'returned_details'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'facility_id' => 'Facility',
            'slot_from' => 'Slot From',
            'slot_to' => 'Slot To',
            'price' => 'Price',
            'deposit' => 'Deposit',
            'total_amount' => 'Total Amount',
            'paid_amount' => 'Paid Amount',
            'payment_method_id' => 'Payment Method',
            'payment_details' => 'Payment Details',
            'payment_status' => 'Payment Status',
            'returned_amount' => 'Returned Amount',
            'returned_by' => 'Returned By',
            'returned_date' => 'Returned Date',
            'returned_details' => 'Returned Details',
            'cancelled_time' => 'Cancelled Time',
            'cancelled_by' => 'Cancelled By',
            'cancelled_reason' => 'Cancelled Reason',
            'lapse_date' => 'Lapse Date',
            'lasttime_book' => 'Lasttime Book',
            'peak' => 'Peak',
            'notes' => 'Notes',
            'created' => 'Created',
            'created_by' => 'Created By',
            'status' => 'Status',
        ];
    }  

    // Checking of barring
    // Booked data of user passed as array. Table fb booking booked
    // Coding by Vignesh

    public function getChecked($model){

        $modelFacility = FbBookingFacility::find()->where(['id' => $model->facility_id, 'published' => 1])->one();

        $d = $modelFacility->b_period; 
        $fm = $modelFacility->b_facmon; 


        $start = date('Y-m-d', strtotime(date('Y-m-d')." -".$d." month"));
        $end   = date('Y-m-d'); 

        $book = FbBookingBooked::find()               
                ->where([ 'facility_id' => $modelFacility->id , 'user_id' => $model->user_id ,'status' => 5])
                ->andwhere(['between', 'date(slot_from)', $start, $end])
                ->all(); 

        $last = FbBookingBooked::find()->where([ 'facility_id' => $modelFacility->id , 'user_id' => $model->user_id])->orderBy(['id'=> SORT_DESC])->one();        
      
        $expr = date('Y-m-d', strtotime('+'.$fm.' month', strtotime($last->created)));
        if($book  >  $modelFacility->b_absent){
        
                $modelbar               = new FbBarring(); 
                $modelbar->user_id      = $model->user_id;
                $modelbar->group_id      = $modelFacility->group;
                $modelbar->facility_id  =  $model->facility_id;
                $modelbar->last_book    = date('Y-m-d', strtotime($last->created)); 
                $modelbar->expiry       = $expr; 
                $modelbar->save(false);
      
        }

        return true;
    }


	public function getFacility0()
    {
        return $this->hasOne(FbBookingFacility::className(), ['id' => 'facility_id']);
    }
	public function getProfiles()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
	public function getProfile()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'user_id']);
    }
	public function getCancel()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'cancelled_by']);
    }
		public function getMethod()
    {
        return $this->hasOne(FbBookingPaymentMethod::className(), ['id' => 'payment_method_id']);
    }
	public function getStatus1()
    {
        return $this->hasOne(FbBookingPaymentStatus::className(), ['id' => 'payment_status']);
    }
	public function getStatus2()
    {
        return $this->hasOne(FbBookingStatus::className(), ['id' => 'status']);
    }

}
