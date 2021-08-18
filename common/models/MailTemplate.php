<?php

namespace common\models;

use Yii;
use vova07\fileapi\behaviors\UploadBehavior;
use vova07\users\Module;
use vova07\users\traits\ModuleTrait;
use yii\db\ActiveRecord;
use yii\db\Query;
use zyx\phpmailer\Mailer;

/**
 * This is the model class for table "mail_template".
 *
 * @property integer $id
 * @property string $mail_for
 * @property string $subject
 * @property string $message
 * @property string $attachment
 * @property integer $updated_by
 * @property string $updated_on
 *
 * @property Users $updatedBy
 */

class MailTemplate extends \yii\db\ActiveRecord

{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail_template';
    }

   public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
					 'attachment' => [
                        'path' => '@statics/web/mail',
                        'tempPath' => '@statics/temp/mail',
                        'url' => '/statics/mail'
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
            [['mail_for', 'subject', 'message', 'updated_by'], 'required'],
            [['message'], 'string'],
            [['updated_by'], 'integer'],
            [['updated_on'], 'safe'],
            [['mail_for', 'subject', 'attachment'], 'string', 'max' => 128],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mail_for' => 'Mail For',
            'subject' => 'Subject',
            'message' => 'Message',
            'attachment' => 'Attachment',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedby()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'updated_by']);
    }

	function sendMail($mail = '', $user = '', $data = array()){
		//echo $user; exit;
		$sql = "SELECT * FROM `users` WHERE id = ". $user;
		$userData = Yii::$app->db->createCommand($sql);
		$user_data = $userData->queryOne();
		//echo $user_data; exit();
		
		$sql = "SELECT * FROM `profiles` WHERE user_id = ". $user;
		$profiles = Yii::$app->db->createCommand($sql);
		$profileData = $profiles->queryOne();
		
		
		$sql = "SELECT * FROM `mail_template` WHERE id = ". $mail;
		$mail_data = Yii::$app->db->createCommand($sql);
		$mailData = $mail_data->queryOne();
		
		$sql = "SELECT * FROM `fb_booking_facility` WHERE id = ". $data[0];
		$facility = Yii::$app->db->createCommand($sql);
		$FacData = $facility->queryOne();
		$depfee =  Yii::$app->formatter->asDecimal($data[4]);
		$content_key = array('User', 'timefrom', 'timeto', 'facnam', 'refno', 'datefrom','depfee');
		$content_value = array($profileData['name'], date('d M Y h:ia', strtotime($data[1])), date('h:ia', strtotime($data[2])), $FacData['name'],$data[3], date('d M Y', strtotime($data[1])), $depfee);
		$bodytag  =strip_tags( str_replace($content_key, $content_value, $mailData['message']));
		/*return  Yii::$app->mailer->compose()
		 ->setFrom('noreply@booking.com')
		 ->setTo($user_data['email'])
		 ->setSubject($mailData['subject'])
		 ->setTextBody($bodytag)
		 ->send();
*/
		/* echo ($mailSend);
		if(!$mailSend->send()){
			return 'Mail not Sent';
		}
		 */
		 $mail1 = Yii::$app->params['adminMail1'];
		 $mail2 = Yii::$app->params['adminMail2'];
		 
		  mail($user_data['email'], $mailData['subject'], $bodytag, Yii::$app->params['adminMail']);
		  mail($mail1, $mailData['subject'], $bodytag, Yii::$app->params['adminMail']);
		  mail($mail2, $mailData['subject'], $bodytag, Yii::$app->params['adminMail']);
		  
		  return true;	
		  
	}
}

