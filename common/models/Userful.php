<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userful".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $service
 * @property string $address
 * @property string $tel
 * @property string $email
 * @property string $url
 * @property string $status
 *
 * @property UsefulType $type0
 */
class Userful extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'useful';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'name','service'], 'required'],
			[['type'], 'integer'],
            [['status'], 'string'],
            [['name', 'service', 'address', 'tel'], 'string', 'max' => 255],
            [['email', 'url'], 'string', 'max' => 128],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => UsefulType::className(), 'targetAttribute' => ['type' => 'id']],
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
            'type' => 'Type',
            'service' => 'Service',
            'address' => 'Address',
            'tel' => 'Mobile',
            'email' => 'Email',
            'url' => 'URL',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(UsefulType::className(), ['id' => 'type']);
    }
}
