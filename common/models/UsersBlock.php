<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_block".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $published
 */
class UsersBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'published'], 'required'],
            [['published'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 128],
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
            'description' => 'Description',
            'published' => 'Status',
        ];
    }
}
