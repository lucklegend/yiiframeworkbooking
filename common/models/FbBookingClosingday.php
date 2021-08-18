<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_closingday".
 *
 * @property integer $id
 * @property integer $facility
 * @property string $title
 * @property string $notes
 * @property string $date_from
 * @property string $date_to
 * @property string $time_from
 * @property string $time_to
 * @property integer $published
 *
 * @property FbBookingFacility $facility0
 */
class FbBookingClosingday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_closingday';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'date_from', 'date_to'], 'required'],
            [['facility', 'published'], 'integer'],
            [['notes'], 'string'],
            [['date_from', 'date_to', 'time_from', 'time_to'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['facility'], 'exist', 'skipOnError' => true, 'targetClass' => FbBookingFacility::className(), 'targetAttribute' => ['facility' => 'id']],
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
            'title' => 'Title',
            'notes' => 'Notes',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'time_from' => 'Time From',
            'time_to' => 'Time To',
            'published' => 'Published',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacility0()
    {
        return $this->hasOne(FbBookingFacility::className(), ['id' => 'facility']);
    }
}
