<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_barring".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $facility_id
 * @property integer $group_id
 * @property string $last_book
 * @property string $expiry
 */
class FbBarring extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_barring';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'facility_id', 'last_book', 'expiry' ,'group_id'], 'required'],
            [['id', 'user_id', 'facility_id' , 'group_id'], 'integer'],
            [['last_book', 'expiry'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'facility_id' => Yii::t('app', 'Facility ID'),
            'last_book' => Yii::t('app', 'Last Book'),
            'expiry' => Yii::t('app', 'Expiry'),
        ];
    }

    
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    
    public function getFac()
    {
        return $this->hasOne(FbBookingFacility::className(), ['id' => 'facility_id']);
    }

    
    public function getGrp()
    {
        return $this->hasOne(FbBookingGroup::className(), ['id' => 'group_id']);
    }

    

}
