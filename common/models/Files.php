<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $title
 * @property string $file_name
 * @property integer $file_type
 * @property string $file_icon
 * @property integer $category
 * @property string $notes
 * @property integer $uploaded_by
 * @property integer $uploaded_for
 * @property string $access
 * @property integer $published
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'file_name', 'file_type', 'category', 'notes', 'access', 'published'], 'required'],
            [['file_type', 'category', 'uploaded_by', 'uploaded_for', 'published'], 'integer'],
            [['notes'], 'string'],
            [['title', 'file_name'], 'string', 'max' => 128],
            [['file_icon', 'access'], 'string', 'max' => 64],
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
            'file_name' => 'File Name',
            'file_type' => 'File Type',
            'file_icon' => 'File Icon',
            'category' => 'Category',
            'notes' => 'Notes',
            'uploaded_by' => 'Uploaded By',
            'uploaded_for' => 'Uploaded For',
            'access' => 'Access',
            'published' => 'Status',
        ];
    }
	public function getType()
    {
        return $this->hasOne(FilesType::className(), ['id' => 'file_type']);
    }
	public function getCategory1()
    {
        return $this->hasOne(FilesCategory::className(), ['id' => 'category']);
    }
	public function getProfiles()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'uploaded_by']);
    }
	public function getAccess1()
    {
        return $this->hasOne(UsersType::className(), ['id' => 'access']);
    }

}
