<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "data_log".
 *
 * @property integer $id
 * @property integer $table_id
 * @property string $table_name
 * @property string $modified_on
 * @property integer $modified_by
 */
class DataLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'table_id', 'table_name', 'modified_by'], 'required'],
            [['id', 'table_id', 'modified_by'], 'integer'],
            [['modified_on'], 'safe'],
            [['table_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_id' => 'Table ID',
            'table_name' => 'Table Name',
            'modified_on' => 'Modified On',
            'modified_by' => 'Modified By',
        ];
    }
}
