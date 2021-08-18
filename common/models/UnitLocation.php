<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unit_location".
 *
 * @property integer $id
 * @property string $name
 * @property integer $unit_type
 * @property integer $published
 */
class UnitLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unit_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['unit_type', 'published'], 'integer'],
            [['name'], 'string', 'max' => 32],
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
            'unit_type' => 'Unit Type',
            'published' => 'Status',
        ];
    }
	    public function getType()
    {
        return $this->hasOne(UnitType::className(), ['id' => 'unit_type']);
    }
}
