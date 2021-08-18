<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "useful_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $published
 *
 * @property Userful[] $userfuls
 */
class UsefulType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'useful_type';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserfuls()
    {
        return $this->hasMany(Userful::className(), ['type' => 'id']);
    }
}
