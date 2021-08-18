<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "events_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $published
 */
class EventsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'published'], 'required'],
            [['published'], 'integer'],
            [['name'], 'string', 'max' => 128],
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
            'published' => 'Status',
        ];
    }
}
