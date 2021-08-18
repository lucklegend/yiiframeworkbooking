<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_file".
 *
 * @property integer $id
 * @property integer $galleryId
 * @property string $file
 * @property string $caption
 * @property integer $position
 *
 * @property Gallery $gallery
 */
class GalleryFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['galleryId', 'file'], 'required'],
            [['galleryId', 'position'], 'integer'],
            [['file', 'caption'], 'string', 'max' => 255],
            [['galleryId'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['galleryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'galleryId' => 'Gallery ID',
            'file' => 'File',
            'caption' => 'Caption',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'galleryId']);
    }
}
