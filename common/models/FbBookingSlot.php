<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_slot".
 *
 * @property integer $id
 * @property integer $facility
 * @property double $price
 * @property string $time_from
 * @property string $time_to
 * @property string $monday
 * @property string $tuesday
 * @property string $wednesday
 * @property string $thursday
 * @property string $friday
 * @property string $saturday
 * @property string $sunday
 * @property string $peak
 */
class FbBookingSlot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_slot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peak'], 'required'],
            [['facility'], 'integer'],
            [['price'], 'number'],
            [['time_from', 'time_to'], 'safe'],
            [['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'peak'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'facility' => 'Facility',
            'price' => 'Price',
            'time_from' => 'Time From',
            'time_to' => 'Time To',
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
            'peak' => 'Peak',
        ];
    }
		    public function getFacility1()
    {
        return $this->hasOne(FbBookingFacility::className(), ['id' => 'facility']);
    }
	    public function getGroup1()
    {
        return $this->hasOne(FbBookingGroup::className(), ['id' => 'group']);
    }
		
	 public function getPeak1(){
		 	if($this->peak == 0 ){
				return 'Non-Peak';
			}
			if($this->peak == 1 ){
			 return 'Peak';
			}
			if($this->peak == 2 ){
				return 'Both';
			}
}


}
