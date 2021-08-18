<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_email".
 *
 * @property integer $user_id
 * @property string $email
 * @property string $token
 */
class UserEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'email', 'token'], 'required'],
            [['user_id'], 'integer'],
            [['email'], 'string', 'max' => 100],
            [['token'], 'string', 'max' => 53],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User',
            'email' => 'Email',
            'token' => 'Token',
        ];
    }
}
