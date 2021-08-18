<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_cancel_reasons".
 *
 * @property integer $id
 * @property string $title
 */
class FbBookingCancelReasons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_cancel_reasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
        ];
    }
}
