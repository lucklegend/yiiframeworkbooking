<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $category
 * @property string $image
 * @property string $attachment
 * @property integer $type
 * @property integer $created_by
 * @property string $created_on
 * @property integer $status
 *
 * @property PagesCategories $category0
 * @property PagesType $type0
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }
	
	  public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'image' => [
                        'path' => '@statics/web/pages',
                        'tempPath' => '@statics/temp/pages',
                        'url' => '/statics/pages'
                    ],
					 'attachment' => [
                        'path' => '@statics/web/pages',
                        'tempPath' => '@statics/temp/pages',
                        'url' => '/statics/pages'
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
            [['title', 'category', 'type', 'attachment'], 'required'],
            [['content'], 'string'],
            [['category', 'type', 'created_by', 'status'], 'integer'],
            [['created_on'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['image', 'attachment'], 'string', 'max' => 255],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => PagesCategories::className(), 'targetAttribute' => ['category' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => PagesType::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'category' => 'Category',
            'image' => 'Image',
            'attachment' => 'Attachment',
            'type' => 'Type',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(PagesCategories::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(PagesType::className(), ['id' => 'type']);
    }
	public function getUserid()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'created_by']);
    }
}
