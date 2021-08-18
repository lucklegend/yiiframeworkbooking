<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $meet_whom
 * @property string $meet_for
 * @property string $relationship
 * @property string $entry_time
 * @property string $exit_time
 * @property integer $gate_no
 * @property integer $updated_by
 */
class Visitors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visitors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'meet_for', 'relationship', 'entry_time', 'exit_time', 'gate_no'], 'required'],
            [['meet_whom', 'gate_no', 'updated_by'], 'integer'],
            [['entry_time', 'exit_time'], 'safe'],
            [['name', 'meet_for', 'relationship'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 16],
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
            'phone' => 'Phone',
            'meet_whom' => 'Meet Whom',
            'meet_for' => 'Meet For',
            'relationship' => 'Relationship',
            'entry_time' => 'Entry Time',
            'exit_time' => 'Exit Time',
            'gate_no' => 'Gate No',
            'updated_by' => 'Updated By',
        ];
    }
	    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'meet_whom']);
    }
  	 public function getProfiles()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'updated_by']);
    }
}
