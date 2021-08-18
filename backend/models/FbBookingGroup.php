<?php

namespace app\models;

use Yii;

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
            [['name', 'calendars', 'published', 'image', 'album_id', 'description', 'bookable'], 'required'],
            [['calendars', 'published', 'album_id'], 'integer'],
            [['description', 'bookable'], 'string'],
            [['name'], 'string', 'max' => 32],
            [['image'], 'string', 'max' => 128],
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
            'album_id' => 'Album ID',
            'description' => 'Description',
            'bookable' => 'Bookable',
        ];
    }
}
