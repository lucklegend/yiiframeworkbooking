<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_rules".
 *
 * @property integer $id
 * @property integer $facility
 * @property integer $group
 * @property integer $peak
 * @property string $range_type
 * @property integer $range_limit
 * @property integer $rules_order
 * @property string $condition
 */
class FbBookingRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['facility', 'group', 'peak', 'range_limit', 'rules_order'], 'integer'],
            [['peak', 'range_type', 'range_limit', 'rules_order', 'condition'], 'required'],
            [['range_type', 'condition'], 'string'],
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
            'group' => 'Group',
            'peak' => 'Peak',
            'range_type' => 'Range Type',
            'range_limit' => 'Range Limit',
            'rules_order' => 'Rules Order',
            'condition' => 'Condition',
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
 public function getRangetype1(){
		 	if($this->range_type == 1 ){
				return 'Days';
			}
			if($this->range_type == 2 ){
			 return 'Weeks';
			}
			if($this->range_type == 3 ){
				return 'Months';
			}
}

}
