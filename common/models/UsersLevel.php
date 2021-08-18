<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_level".
 *
 * @property integer $id
 * @property string $level_name
 * @property integer $level_block
 * @property integer $published
 */
class UsersLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level_name', 'level_block'], 'required'],
            [['level_block', 'published'], 'integer'],
            [['level_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level_name' => 'Level Name',
            'level_block' => 'Level Block',
            'published' => 'Published',
        ];
    }
			 public function getBlock()
    {
        return $this->hasOne(UsersBlock::className(), ['id' => 'level_block']);
    }

}
