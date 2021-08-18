<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_status".
 *
 * @property integer $id
 * @property string $title
 * @property string $can_book
 */
class FbBookingStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['can_book'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['title'], 'unique'],
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
            'can_book' => 'Can Book',
        ];
    }
}
