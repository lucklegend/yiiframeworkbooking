<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asset_categories".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_serviceable
 */
class AssetCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'is_serviceable'], 'required'],
            [['is_serviceable'], 'integer'],
            [['name'], 'string', 'max' => 32],
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
            'is_serviceable' => 'Is Serviceable',
        ];
    }
}
