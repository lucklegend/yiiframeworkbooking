<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $published
 */
class FilesCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'published'], 'required'],
            [['published'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'published' => 'Published',
        ];
    }
}
