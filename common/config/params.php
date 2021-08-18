<?php
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

//$config = array('name' => 'abc');

return [
		'runtimeWidgets' => [
				'sadovojav\gallery\widgets\Gallery'
			],

    'dateControlDisplay' => [
        Module::FORMAT_DATE => 'dd-MM-yyyy',
        Module::FORMAT_TIME => 'hh:mm:ss a',
        Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a', 
    ],
    
    // format settings for saving each date attribute (PHP format example)
    'dateControlSave' => [
        Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],
	        // set your display timezone
        //'displayTimezone' => 'Asia/Kolkata',
 
        // set your timezone for date saved to db
       // 'saveTimezone' => 'Asia/Kolkata',
        
        // automatically use kartik\widgets for each of the above formats
		/*'fromMail' => [
       'from' => 'kani@jovetech.in', 
	   'adminMail' => 'elam@jove.in', 
    ],*/
		'adminMail'  => 'elam@jovetech.in', 
		'adminEmail' => 'shalini@axon.com.sg', 
		'adminMail1' => 'karthi@axon.com.sg', 
		'adminMail2' => 'ida@axon.com.sg', 
		'googleCaptchaSecret' => '6LffVSMTAAAAAOQX2PeUu6alwOGah5IVTf3HzrKi',
        'googleCaptchaKey' => '6LffVSMTAAAAALk1VFBfRmOF0WzA1OdwrNM6WjGv',
        'enableCaptcha' => 0,
		
		'uploadPath' => Yii::getAlias("@frontend") .'/statics/web/pages/files',

 
        // default settings for each widget from kartik\widgets used when autoWidget is true
        'autoWidgetSettings' => [
            Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
            Module::FORMAT_DATETIME => [], // setup if needed
            Module::FORMAT_TIME => [], // setup if needed
        ],
        
        // custom widget settings that will be used to render the date input instead of kartik\widgets,
        // this will be used when autoWidget is set to false at module or widget level.
        'widgetSettings' => [
            Module::FORMAT_DATE => [
                'class' => 'yii\jui\DatePicker', // example
                'options' => [
                    'dateFormat' => 'php:d-M-Y',
                    'options' => ['class'=>'form-control'],
                ]
            ]
        ],
        // other settings
    //]
	//'license' => ['key1' => '54UL9G7QQ6', 'key2' => '1625368568', 'serial' => '8223c948d71c693eb6046dabdf21fa71'],
	
	//demo.facilitybooking.com.sg
	 //'license' => ['key1' => 'MRJ67U2H6R', 'key2' => '1655962569', 'serial' => '3fcbdcc9ad2f9f1d0d0624488050140e'],
	 
	//f1.jove.in
	// 'license' => ['key1' => 'QVP5JEPK2V', 'key2' => '1656478597', 'serial' => 'a182b6eef75ab1981d4037955c1bd825'],
	 
	//ardmorepark.com.sg
	 'license' => ['key1' => '6PFL6EUW57', 'key2' => '1711701160', 'serial' => 'bf211d11596915dc2826e72952166bfc'],
	 
	//54.251.222.156
	//'license' => ['key1' => '0N2CQ9YN25', 'key2' => '169134324100', 'serial' => 'f444e8bccffead381ad733fed64d3ed4'],
	 
			 
	//Localhost
	// 'license' => ['key1' => 'UB2ZE5PHAB', 'key2' => '1596197311', 'serial' => '64d70d8168afafac65b2a59106f3b48b'],
];
