<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "events_notes".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $agenda
 * @property string $minutes
 * @property string $resolution
 * @property integer $updated_by
 * @property string $updated_on
 */
class EventsNotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events_notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'updated_by'], 'integer'],
            [['agenda', 'minutes', 'resolution'], 'required'],
            [['minutes', 'resolution'], 'string'],
            [['updated_on'], 'safe'],
            [['agenda'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event',
            'agenda' => 'Agenda',
            'minutes' => 'Minutes',
            'resolution' => 'Resolution',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }
	public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
    }
	public function getProfiles()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

}
