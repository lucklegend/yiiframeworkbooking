<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $token
 * @property string $role
 * @property string $mobile
 * @property integer $user_unit
 * @property integer $type
 * @property string $lives_here
 * @property string $address
 * @property string $city
 * @property integer $zip
 * @property string $notes
 * @property string $image
 * @property integer $status_id
 * @property string $created_at
 * @property string $updated_at
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'username', 'email'], 'required'],
            [['user_unit', 'type', 'zip', 'status_id'], 'integer'],
            [['lives_here', 'notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['fname', 'lname'], 'string', 'max' => 16],
            [['username'], 'string', 'max' => 30],
            [['email'], 'email'],
            [['password_hash', 'address'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['token'], 'string', 'max' => 53],
            [['role', 'city'], 'string', 'max' => 64],
            [['image'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'username' => 'Username',
            'email' => 'E-mail',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'token' => 'Token',
            'role' => 'Role',
            'user_unit' => 'User Unit',
            'type' => 'Type',
            'lives_here' => 'Lives Here',
            'address' => 'Address',
            'city' => 'City',
            'zip' => 'Zip',
            'notes' => 'Notes',
            'image' => 'Image',
            'status_id' => 'Status ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
