<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users_unit".
 *
 * @property integer $id
 * @property string $unit_name
 * @property integer $unit_block
 * @property integer $unit_level
 * @property integer $unit_type
 * @property integer $bookable
 * @property integer $published
 */
class UsersUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_name', 'unit_block', 'unit_level', 'unit_type'], 'required'],
            [['unit_block', 'unit_level', 'unit_type', 'bookable', 'published'], 'integer'],
            [['unit_name'], 'string', 'max' => 32],
            [['unit_name'], 'unique'],
        ];
    }
   public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@statics/web/unit',
                        'tempPath' => '@statics/temp/unit',
                        'url' => '/statics/unit'
                    ],
					 'attachment' => [
                        'path' => '@statics/web/unit',
                        'tempPath' => '@statics/temp/unit',
                        'url' => '/statics/unit'
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_name' => 'Unit Name',
            'unit_block' => 'Unit Block',
            'unit_level' => 'Unit Level',
            'unit_type' => 'Unit Type',
            'bookable' => 'Bookable',
            'published' => 'Status',
        ];
    }
		public function getBlock1()
    {
        return $this->hasOne(UsersBlock::className(), ['id' => 'unit_block']);
    }

	 public function getLevel1()
    {
        return $this->hasOne(UsersLevel::className(), ['id' => 'unit_level']);
    }

	 public function getType1()
    {
        return $this->hasOne(UnitType::className(), ['id' => 'unit_type']);
    }

}
