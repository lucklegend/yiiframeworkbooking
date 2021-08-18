<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fb_booking_closingday_facility".
 *
 * @property integer $id
 * @property integer $closingday_id
 * @property integer $facility_id
 */
class FbBookingClosingdayFacility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fb_booking_closingday_facility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['closingday_id', 'facility_id'], 'integer'],
            [['closingday_id', 'facility_id'], 'unique', 'targetAttribute' => ['closingday_id', 'facility_id'], 'message' => 'The combination of Closingday ID and Facility ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'closingday_id' => 'Closingday ID',
            'facility_id' => 'Facility ID',
        ];
    }
		    public function getClosingday()
    {
        return $this->hasOne(FbBookingClosingday::className(), ['id' => 'closingday_id']);
    }

    public function getFacility()
    {
        return $this->hasOne(FbBookingFacility::className(), ['id' => 'facility_id']);
    }
	public function behaviors()
	{
		return [
			 'galleryBehavior' => [
				 'class' => FbBookingClosingdayFacility::className(),
				 'type' => 'product',
				 'extension' => 'jpg',
				 'directory' => Yii::getAlias('@webroot') . '/images/product/gallery',
				 'url' => Yii::getAlias('@web') . '/images/product/gallery',
				 'versions' => [
					 'small' => function ($img) {
						 /** @var \Imagine\Image\ImageInterface $img */
						 return $img
							 ->copy()
							 ->thumbnail(new \Imagine\Image\Box(200, 200));
					 },
					 'medium' => function ($img) {
						 /** @var Imagine\Image\ImageInterface $img */
						 $dstSize = $img->getSize();
						 $maxWidth = 800;
						 if ($dstSize->getWidth() > $maxWidth) {
							 $dstSize = $dstSize->widen($maxWidth);
						 }
						 return $img
							 ->copy()
							 ->resize($dstSize);
					 },
				 ]
			 ]
		];
	}

}
