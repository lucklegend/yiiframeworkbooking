<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pages_categories".
 *
 * @property integer $id
 * @property string $category
 * @property integer $type
 * @property integer $status
 */
class PagesCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'type', 'status'], 'required'],
            [['type', 'status'], 'integer'],
            [['category'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
	public function getType0()
    {
        return $this->hasOne(PagesType::className(), ['id' => 'type']);
    }
}
