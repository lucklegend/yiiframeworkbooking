<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fb_booking_group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $calendars
 * @property integer $published
 * @property string $image
 * @property integer $album_id
 * @property string $description
 * @property string $bookable
 */
class FbBookingGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bookable'], 'required'],
            [['calendars', 'published', 'album_id', 'bookable'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 32],
            [['image'], 'string', 'max' => 128],
        ];
    }
	
	    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@statics/web/groups',
                        'tempPath' => '@statics/temp/groups',
                        'url' => '/statics/groups'
                    ]
                ]
            ]
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
            'calendars' => 'Calendars',
            'published' => 'Published',
            'image' => 'Image',
            'album_id' => 'Album',
            'description' => 'Description',
            'bookable' => 'Bookable',
        ];
    }
	
	     public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'album_id']);
    }

 public function getCalendar1(){
		 	if($this->calendars == 0 ){
				return 'Day Calendar';
			}
			if($this->calendars == 1 ){
			 return 'Week Calendar';
			}
			if($this->calendars == 2 ){
				return 'Month Calendar';
			}
}
}
