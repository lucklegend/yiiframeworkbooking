<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asset".
 *
 * @property integer $id
 * @property string $name
 * @property string $model
 * @property integer $category
 * @property string $brand
 * @property string $code
 * @property integer $purchase_from
 * @property string $purchase_date
 * @property string $warranty_end_date
 * @property integer $amc_by
 * @property string $amc_start
 * @property string $amc_end
 * @property string $notes
 * @property integer $user_unit
 * @property integer $user_id
 * @property integer $status
 */
class Asset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'model', 'brand', 'code', 'purchase_date', 'warranty_end_date', 'amc_start', 'amc_end', 'notes', 'user_unit', 'user_id', 'status'], 'required'],
            [['category', 'purchase_from', 'amc_by', 'user_unit', 'user_id', 'status'], 'integer'],
            [['purchase_date', 'warranty_end_date', 'amc_start', 'amc_end'], 'safe'],
            [['notes'], 'string'],
            [['name', 'model', 'brand', 'code'], 'string', 'max' => 32],
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
            'model' => 'Model',
            'category' => 'Category',
            'brand' => 'Brand',
            'code' => 'Code',
            'purchase_from' => 'Purchase From',
            'purchase_date' => 'Purchase Date',
            'warranty_end_date' => 'Warranty End Date',
            'amc_by' => 'Amc By',
            'amc_start' => 'Amc Start',
            'amc_end' => 'Amc End',
            'notes' => 'Notes',
            'user_unit' => 'User Unit',
            'user_id' => 'User',
            'status' => 'Status',
        ];
    }
	public function getCategory1()
    {
        return $this->hasOne(AssetCategories::className(), ['id' => 'category']);
    }
	public function getProfiles()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'user_id']);
    }
	public function getContacts()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'amc_by']);
    }
    public function getUnit()
    {
        return $this->hasOne(UsersUnit::className(), ['id' => 'user_unit']);
    }


}
