<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "fb_booking_facility".
 *
 * @property integer $id
 * @property string $name
 * @property integer $group
 * @property integer $bookday_start
 * @property integer $bookday_end
 * @property integer $cancel_date
 * @property integer $unit_time
 * @property string $rulestype
 * @property string $rulescondition
 * @property integer $deposit
 * @property integer $b_facmon
 * @property integer $b_absent
 * @property integer $b_period
 * @property string $notes
 * @property string $attachment
 * @property string $image
 * @property integer $album_id
 * @property string $album_url
 * @property integer $published
 */
class FbBookingFacility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_facility';
    }
	
	   	    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@statics/web/facility',
                        'tempPath' => '@statics/temp/facility',
                        'url' => '/statics/facility'
                    ]
                ]
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bookday_start', 'bookday_end', 'rulestype', 'slottype', 'deposit' ,'b_facmon','b_absent','b_period'], 'required'],
            [['group', 'bookday_start', 'bookday_end', 'b_facmon','b_absent','b_period', 'cancel_date', 'lapse_date', 'unit_time', 'deposit', 'album_id', 'published', 'default_status',], 'integer'],
            [['rulestype', 'slottype', 'notes'], 'string'],
            [['name'], 'string', 'max' => 32],
            [['rulescondition', 'attachment', 'image'], 'string', 'max' => 64],
            [['album_url'], 'string', 'max' => 128],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'group' => 'Group',
            'bookday_start' => 'Bookday Start',
            'bookday_end' => 'Bookday End',
            'cancel_date' => 'Cancel Hours',
			'lapse_date' => 'Lapse Time',
            'unit_time' => 'Unit Time',
            'rulestype' => 'Rules Type',
            'slottype' => 'Slot Type',
            'rulescondition' => 'Rules Condition',
            'deposit' => 'Deposit',
            'b_facmon' => 'Facility Barred Month',
            'b_absent' => 'Absent',
            'b_period' => 'Time Period',
            'notes' => 'Notes',
            'attachment' => 'Attachment',
            'image' => 'Image',
            'album_id' => 'Album',
            'album_url' => 'Album Url',
            'published' => 'Status',
			'default_status' => 'Default Booking Status',
        ];
    }
		    public function getGroup1()
    {
        return $this->hasOne(FbBookingGroup::className(), ['id' => 'group']);
    }
       public function getStatus1()
    {
        return $this->hasOne(FbBookingStatus::className(), ['id' => 'default_status']);
    }
	  public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'album_id']);
    }


}
