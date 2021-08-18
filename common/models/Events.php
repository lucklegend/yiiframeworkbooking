<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category
 * @property string $start_date
 * @property string $end_date
 * @property string $start_time
 * @property string $end_time
 * @property string $description
 * @property string $image
 * @property string $attachment
 * @property string $location
 * @property integer $album_id
 * @property string $album_url
 * @property string $event_for
 * @property integer $status
 * @property integer $publish
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }
 
  public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@statics/web/events',
                        'tempPath' => '@statics/temp/events',
                        'url' => '/statics/events'
                    ],
					 'attachment' => [
                        'path' => '@statics/web/events',
                        'tempPath' => '@statics/temp/events',
                        'url' => '/statics/events'
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
            [['title', 'start_date', 'end_date', 'start_time', 'end_time', 'location'], 'required'],
            [['category', 'album_id', 'status', 'publish'], 'integer'],
            [['start_date', 'end_date', 'start_time', 'end_time'], 'safe'],
            [['description'], 'string'],
            [['title', 'image', 'attachment', 'location', 'album_url'], 'string', 'max' => 128],
            [['event_for'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'category' => 'Category',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'description' => 'Description',
            'image' => 'Image',
            'attachment' => 'Attachment',
            'location' => 'Location',
            'album_id' => 'Album',
            'album_url' => 'Album Url',
            'event_for' => 'Event For',
            'status' => 'Status',
            'publish' => 'Publish',
        ];
    }
	public function getEvent()
    {
        return $this->hasOne(EventsCategory::className(), ['id' => 'category']);
    }
     public static function getGallery()
    {
       // return $this->hasOne(Gallery::className(), ['id' => 'album_id']);
    }
     public static function getName($id)
    {
		$user = Users::find()->where(['id'=> $id])->one();
        return $user->fname .' - '. $user->user_unit;
    }

}
