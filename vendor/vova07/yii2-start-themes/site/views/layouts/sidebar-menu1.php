
<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use vova07\themes\admin\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            [
                'label' => Yii::t('vova07/themes/site', 'Facility Booking'),
                'url' => '',
                'icon' => 'fa fa-clone',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
				    [
                        'label' => Yii::t('vova07/themes/site', 'Place Booking'),
                        'url' => ['/booking/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'My Bookings'),
                        'url' => ['/fb-booking-booked/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ]
            ],
		
			[
                'label' => Yii::t('vova07/themes/site', 'User '),
                'url' => '#',
                'icon' => 'fa fa-ticket',
                'class' => 'list',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
				     [
                        'label' => Yii::t('vova07/themes/site', 'My Profile'),
                        'url' => ['/profile/view'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'Change Password'),
                        'url' => ['/users/user/password'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ]
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'Useful Info'),
                'url' => '#',
                'icon' => 'fa fa-ticket',
                'class' => 'list',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    // [
                    //     'label' => Yii::t('vova07/themes/site', 'Appication Forms'),
                    //     'url' => ['/pages/index', 'id' => 11],
                    //     'visible' => !Yii::$app->user->isGuest
                    // ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'News/Circulars'),
                        'url' => ['/pages/index', 'id' => 1],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'Amenities Near Ardmore Park'),
                        'url' => ['/useful/nearme'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    // [
                    //     'label' => Yii::t('vova07/themes/site', 'Amenities'),
                    //     'url' => ['/contacts'],
                    //     'visible' => !Yii::$app->user->isGuest
                    // ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'Contractors/Suppliers'),
                        'url' => ['/useful/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
				     [
                        'label' => Yii::t('vova07/themes/site', 'Events'),
                        'url' => ['/events/calendar'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ]
            ],
			
            [
                'label' => Yii::t('vova07/themes/site', 'Application Forms'),
                'url' => '#',
                'icon' => 'fa fa-book',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    [
                        'label' => Yii::t('vova07/themes/site', 'Forms'),
                        'url' => ['/pages/index', 'id' => 11],
                        'visible' => !Yii::$app->user->isGuest
                    ], 
                ]
            ],
            [
                'label' => Yii::t('vova07/themes/site', 'By-Laws'),
                'url' => '#',
                'icon' => 'fa fa-plus-square',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    [
                        'label' => Yii::t('vova07/themes/site', 'By-Laws'),
                        'url' => ['/pages/index', 'id' => 6],
                        'visible' => !Yii::$app->user->isGuest
                    ], 
                ]
            ],
//            [
//                'label' => Yii::t('vova07/themes/site', 'Reports'),
//                'url' => '#',
//                'icon' => 'fa fa-pencil-square',
//                'visible' => !Yii::$app->user->isGuest,
//                'items' => [
//				    [
//                        'label' => Yii::t('vova07/themes/site', 'Booking Report'),
//                        'url' => ['/fb-booking-booked/index'],
//                        'visible' => !Yii::$app->user->isGuest
//                    ],
//                ]
//            ],
            
			
			/*[
                'label' => Yii::t('vova07/themes/site', 'News & Activities'),
                'url' => '#',
                'icon' => 'fa fa-calendar',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
				    [
                        'label' => Yii::t('vova07/themes/site', 'Notices / Circulars'),
                        'url' => ['/pages/index', 'id' => 1],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'Community News'),
                        'url' => ['/pages/index', 'id' => 13],
                        'visible' => !Yii::$app->user->isGuest
                    ],
				     [
                        'label' => Yii::t('vova07/themes/site', 'Social Events'),
                        'url' => ['/events/index'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'AGM / EOGM'),
                        'url' => ['/pages/index', 'id' => 3],
                        'visible' => !Yii::$app->user->isGuest
                    ],
					[
                        'label' => Yii::t('vova07/themes/site', 'Council Meetings'),
                        'url' => ['/pages/index', 'id' => 4],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ]
            ],
			
			[
                'label' => Yii::t('vova07/themes/site', 'Resources'),
                'url' => '#',
                'icon' => 'fa fa-info-circle',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
				    [
                        'label' => Yii::t('vova07/themes/site', 'Council Minutes'),
                        'url' => ['/pages/index', 'id' => 5],
                        'visible' => !Yii::$app->user->isGuest
                    ],
				     [
                        'label' => Yii::t('vova07/themes/site', 'By Laws / House Rules'),
                        'url' => ['/pages/index', 'id' => 6],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('vova07/themes/site', 'Residents Guide'),
                        'url' => ['/pages/index', 'id' => 7],
                        'visible' => !Yii::$app->user->isGuest
                    ],
//					[
//                        'label' => Yii::t('vova07/themes/site', 'Useful Information'),
//                        'url' => ['/contacts/index', 'id' => 8],
//                        'visible' => !Yii::$app->user->isGuest
//                    ],
					[
                        'label' => Yii::t('vova07/themes/site', 'Useful Links'),
                        'url' => ['/contacts/index', 'id' => 8],
                        'visible' => !Yii::$app->user->isGuest
                    ],
//					[
//                        'label' => Yii::t('vova07/themes/site', 'Nearby Amenities'),
//                        'url' => ['/pages/nearby'],
//                        'visible' => !Yii::$app->user->isGuest
//                    ],
//					[
//                        'label' => Yii::t('vova07/themes/site', 'Neighbourhood Events'),
//                        'url' => ['/pages/index', 'id' => 10],
//                        'visible' => !Yii::$app->user->isGuest
//                    ],
					[
                        'label' => Yii::t('vova07/themes/site', 'Application Forms'),
                        'url' => ['/pages/index', 'id' => 11],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                   
                     [
                        'label' => Yii::t('vova07/themes/site', 'Useful Info'),
                        'url' => ['/userful/index' ],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ]
            ],*/


        ]
    ]
);