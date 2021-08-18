<?php

namespace vova07\users\models;

use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;
use Yii;

/**
 * Class Profile
 * @package vova07\users\models
 * User profile model.
 *
 * @property integer $user_id User ID
 * @property string $name Name
 * @property string $surname Surname
 *
 * @property User $user User
 */
class Profile extends ActiveRecord
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'avatar_url' => [
                        'path' => $this->module->avatarPath,
                        'tempPath' => $this->module->avatarsTempPath,
                        'url' => $this->module->avatarUrl
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findByUserId($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * @return string User full name
     */
    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Name
            ['name', 'match', 'pattern' => '/^[a-zа-яё]+$/iu'],
            // Surname
            ['surname', 'match', 'pattern' => '/^[a-zа-яё]+(-[a-zа-яё]+)?$/iu']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Module::t('users', 'ATTR_NAME'),
            'surname' => Module::t('users', 'ATTR_SURNAME'),
			'no_adults' => Module::t('users', 'ATTR_ADULTS'),
			'no_child' => Module::t('users', 'ATTR_CHILD'),
			'no_residentcard' => Module::t('users', 'ATTR_RESIDENT'),
			'no_accesscard' => Module::t('users', 'ATTR_ACCESS'),
			'car_rgno1' => Module::t('users', 'ATTR_RGNO1'),
			'car_rgno2' => Module::t('users', 'ATTR_RGNO2'),
			'car_rgno3' => Module::t('users', 'ATTR_RGNO3'),
			'car_rgno4' => Module::t('users', 'ATTR_RGNO4'),
			'dog_pets' => Module::t('users', 'ATTR_DOG'),
			'cat_pets' => Module::t('users', 'ATTR_CAT'),
			'any_pets' => Module::t('users', 'ATTR_ANYOTHER'),
			'no_bicycle' => Module::t('users', 'ATTR_BICYCLE')
        ];
    }

    /**
     * @return Profile|null Profile user
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('profile');
    }
}
