<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property integer $type
 * @property string $fname
 * @property string $lname
 * @property string $cname
 * @property string $email
 * @property string $mobile
 * @property string $fax
 * @property string $address
 * @property string $city
 * @property integer $zip
 * @property string $service_start
 * @property string $service_end
 * @property string $bank_account_name
 * @property string $bank_account_no
 * @property string $bank_name
 * @property string $bank_ifsc
 * @property string $notes
 * @property string $image
 * @property string $created
 * @property integer $active
 * @property integer $status
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

   	    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@statics/web/contacts',
                        'tempPath' => '@statics/temp/contacts',
                        'url' => '/statics/contacts'
                    ]
                ]
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'zip', 'active', 'status'], 'integer'],
            [['cname','address','email','mobile'], 'required'],
            [['service_start', 'service_end', 'created'], 'safe'],
            [['notes'], 'string'],
            [['fname', 'lname','fax', 'bank_ifsc'], 'string', 'max' => 16],
            [['cname', 'image'], 'string', 'max' => 128],
            [[ 'bank_account_no', 'bank_name'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 255],
            [['city', 'bank_account_name'], 'string', 'max' => 64],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'fname' => 'First name',
            'lname' => 'Last name',
            'cname' => 'Company name',
            'email' => 'Email',
            'mobile' => 'Tel',
            'fax' => 'Fax',
            'address' => 'Address',
            'city' => 'City',
            'zip' => 'Emergency',
            'service_start' => 'Service Start',
            'service_end' => 'Service End',
            'bank_account_name' => 'Type of Service',
            'bank_account_no' => 'Url',
            'bank_name' => 'Display Name',
            'bank_ifsc' => 'Bank Ifsc',
            'notes' => 'Notes',
            'image' => 'Image',
            'created' => 'Created',
            'active' => 'Active',
            'status' => 'Status',
        ];
    }
	 public function getType1()
    {
        return $this->hasOne(ContactsType::className(), ['id' => 'type']);
    }

}
