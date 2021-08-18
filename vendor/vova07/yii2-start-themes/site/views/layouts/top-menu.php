<?php

/**
 * Top menu view.
 *
 * @var \yii\web\View $this View
 */

use vova07\themes\site\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'class' => isset($footer) ? 'pull-left' : 'nav navbar-nav navbar-left',
            'id' => 'topnavbar'
        ],
        'items' => [
		    [
                'label' => Yii::t('vova07/themes/site', 'HOME'),
                // 'url' => ['/facilities/index'],
                'url' => 'https://ardmorepark.com.sg/site/',
				'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'ABOUT US'),
                // 'url' => ['/fb-booking-group/site'], 
                'url' => 'https://ardmorepark.com.sg/site/about/',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'SITE PLAN'),
                // 'url' => ['/fb-booking-group/site'], 
                'url' => 'https://ardmorepark.com.sg/site/site-plan/',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'FLOOR PLAN'),
                // 'url' => ['/fb-booking-group/site'], 
                'url' => 'https://ardmorepark.com.sg/site/floor-plan/',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'VIRTUAL TOUR'),
                // 'url' => ['/fb-booking-group/site'], 
                'url' => 'https://ardmorepark.com.sg/site/virtual-tour/',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'USEFUL LINK'),
                // 'url' => ['/fb-booking-group/site'], 
                'url' => 'https://ardmorepark.com.sg/site/useful-links/',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'GALLERY'),
                // 'url' => ['/fb-booking-group/site'], 
                'url' => 'https://ardmorepark.com.sg/site/gallery/',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],

            // [
            //     'label' => Yii::t('vova07/themes/site', 'LOCATION'),
            //     'url' => ['/fb-booking-group/site'], 
            //     'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            // ],
			// [
            //     'label' => Yii::t('vova07/themes/site', 'FACILITY'),
            //     'url' => ['/fb-booking-group/index'],
			// 	'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            // ],

						//Facility

			/*[
                'label' => Yii::t('vova07/themes/site', 'Facility'),
                'url' => '#',
                'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
                'items' => [

					 [
						'label' => Yii::t('vova07/themes/site', 'Facility List'),
						'url' => ['/fb-booking-group/index'],
					],

                    [
						'label' => Yii::t('vova07/themes/site', 'Site Plan'),
						'url' => ['/fb-booking-group/site'],
					],

					[
						'label' => Yii::t('vova07/themes/site', 'Location Map'),
						'url' => ['/fb-booking-group/map'],
					],
                ]
            ],
*/
            //booking

			// [
            //     'label' => Yii::t('vova07/themes/site', 'Bookings'),
            //     'url' => '#',
            //     'template' => '<a href="{url}" class="dropdown-toggle dropdown" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',
            //     'visible' => !Yii::$app->user->isGuest,
            //     'items' => [
            //         [
            //             'label' => Yii::t('vova07/themes/site', 'Facility List'),
            //             'url' => ['/fb-booking-group/index'],
            //         ],
            //         [
			// 			'label' => Yii::t('vova07/themes/site', 'Online Booking'),
			// 			'url' => ['/booking/index'],
			// 		],
			// 		[
			// 			'label' => Yii::t('vova07/themes/site', 'My Booking'),
			// 			'url' => ['/fb-booking-booked/index'],
			// 		],
            //     ]

            // ],
            //Events

			  /* [
                'label' => Yii::t('vova07/themes/site', 'Events'),
                'url' => ['/events/index'],
                'visible' => !Yii::$app->user->isGuest,
            ],*/
			/*[
                'label' => Yii::t('vova07/themes/site', 'Facilities'),
                'url' => ['/fb-booking-group/index'],
				'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],*/
			// [
   //              'label' => Yii::t('vova07/themes/site', 'Useful Links'),
   //              'url' => ['/contacts/index'],
			// 	'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            // ],
			// [
   //              'label' => Yii::t('vova07/themes/site', 'Application Forms'),
   //              'url' => ['/pages/index','id'=>11], 
			// 	'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
   //          ],
			//  [
   //              'label' => Yii::t('vova07/themes/site', 'By-laws'),
   //              'url' => ['/pages/index','id'=>6],
			// 	'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
   //          ],

			//defect

			/*[
                'label' => Yii::t('vova07/themes/site', 'Defect'),
                'url' => ['/defect/index'],
                'visible' => !Yii::$app->user->isGuest,
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'Blogs'),
                'url' => ['/blogs/default/index'],
				'visible' => !Yii::$app->user->isGuest,
            ],*/
            [
                'label' => Yii::t('vova07/themes/site', 'SITE MAP'),
                'url' => ['/fb-booking-group/map1'],
                'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],

            [
                'label' => Yii::t('vova07/themes/site', 'CONTACT US'),
                'url' => 'https://ardmorepark.com.sg/site/contact/',
                // 'url' => ['/site/default/contacts'],
				'visible' => Yii::$app->user->isGuest || !Yii::$app->user->isGuest,
            ],

           /* [

                'label' => Yii::t('vova07/themes/site', 'Sign Up'),

                'url' => ['/users/guest/signup'],

                'visible' => !Yii::$app->user->isGuest

            ],

            */


                [

                'label' => Yii::t('vova07/themes/site', 'LOGOUT'),
        
                'url' => ['/users/user/logout'],

                // 'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',

                'visible' => !Yii::$app->user->isGuest,

                'items' => [

                    // [

                    //     'label' => Yii::t('vova07/themes/site', 'Edit profile'),

                    //     'url' => ['/users/default/update', 'id' => Yii::$app->user->getId()]

                    // ],

                   /* [

                        'label' => Yii::t('vova07/themes/site', 'Change email'),

                        'url' => ['/users/user/email']

                    ],*/

                    // [

                    //     'label' => Yii::t('vova07/themes/site', 'Change password'),

                    //     'url' => ['/users/user/password']

                    // ],
                    // [
        
                    //  'label' => Yii::t('vova07/themes/site', 'Sign Out'),
        
                    //  'url' => ['/users/user/logout'],
        
                    //  'visible' => !Yii::$app->user->isGuest
        
                    // ]

                ]

                 ],
            [

                'label' => Yii::t('vova07/themes/site', 'LOGIN'),

                'url' => ['/users/guest/login'],

                'visible' => Yii::$app->user->isGuest

            ]






			// [

   //              'label' => Yii::t('vova07/themes/site', 'My Account'),

   //              'url' => '#',

   //              'template' => '<a href="{url}" class="dropdown-toggle" data-toggle="dropdown">{label} <i class="icon-angle-down"></i></a>',

   //              'visible' => !Yii::$app->user->isGuest,

   //              'items' => [

   //                  [

   //                      'label' => Yii::t('vova07/themes/site', 'Edit profile'),

   //                      'url' => ['/users/default/update', 'id' => Yii::$app->user->getId()]

   //                  ],

   //                  [

   //                      'label' => Yii::t('vova07/themes/site', 'Change email'),

   //                      'url' => ['/users/user/email']

   //                  ],

   //                  [

   //                      'label' => Yii::t('vova07/themes/site', 'Change password'),

   //                      'url' => ['/users/user/password']

   //                  ],
			// 		[
		
			// 			'label' => Yii::t('vova07/themes/site', 'Sign Out'),
		
			// 			'url' => ['/users/user/logout'],
		
			// 			'visible' => !Yii::$app->user->isGuest
		
			// 		]

   //              ]

   //          ],
   //          [

   //              'label' => Yii::t('vova07/themes/site', 'Sign In'),

   //              'url' => ['/users/guest/login'],

   //              'visible' => Yii::$app->user->isGuest

            // ]



        ]

    ]

);