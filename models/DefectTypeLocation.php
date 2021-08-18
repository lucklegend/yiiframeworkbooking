<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "defect_type_location".
 *
 * @property integer $id
 * @property integer $defect_id
 * @property integer $location_id
 */
class DefectTypeLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'defect_type_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['defect_id', 'location_id'], 'required'],
            [['defect_id', 'location_id'], 'integer'],
            [['defect_id', 'location_id'], 'unique', 'targetAttribute' => ['defect_id', 'location_id'], 'message' => 'The combination of Defect ID and Location ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'defect_id' => 'Defect ID',
            'location_id' => 'Location ID',
        ];
    }
}
