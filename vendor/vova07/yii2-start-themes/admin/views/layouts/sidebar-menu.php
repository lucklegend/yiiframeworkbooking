
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
                'label' => Yii::t('vova07/themes/admin', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
						//facility booking  
			[
                'label' => Yii::t('vova07/themes/admin', 'Facility Booking'),
                'url' => '#',
                'icon' => 'fa fa-ticket',
                'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin'  ||  Yii::$app->user->identity->role == 'admin'  ||Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions'),
                'items' => [
				    
				     [
                        'label' => Yii::t('vova07/themes/admin', 'Place Booking'),
                        'url' => ['/fb-booking-booked/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')  ||  Yii::$app->user->identity->role == 'admin'  
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Booking Report'),
                        'url' => ['/fb-booking-booked/report'],
                        'visible' =>  Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')  ||  Yii::$app->user->identity->role == 'admin'  
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Facility Barring'),
                        'url' => ['/fb-barring/index'],
                        'visible' =>  Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')  ||  Yii::$app->user->identity->role == 'admin'  
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Facilities'),
                        'url' => ['/fb-booking-facility/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Closing Days'),
                        'url' => ['/fb-booking-closingday/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ], 
					 [
                        'label' => Yii::t('vova07/themes/admin', 'Facilities group'),
                        'url' => ['/fb-booking-group/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ],
                ]
            ],
            [
                'label' => Yii::t('vova07/themes/admin', 'Gallery'),
                'url' => '#',
                'icon' => 'fa fa-picture-o',
                'visible' =>  Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions'),
                'items' => [
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Create Gallery'),
                        'url' => ['/gallery/gallery/create'],
                        'visible' =>  Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Gallery List'),
                        'url' => ['/gallery/gallery/index1'],
                        'visible' =>  Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ],

                ]
            ],
            [
                'label' => Yii::t('vova07/themes/admin', 'Users'),
                'url' => ['/users/default/index'],
                'icon' => 'fa-group',
                'visible' =>  Yii::$app->user->identity->role == 'superadmin',
				// 'items' => [
				//    [
                //         'label' => Yii::t('vova07/themes/admin', 'Users'),
                //         'url' => ['/users/default/index'],
                //         'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
                //     ],
                // ]
            ],
            [
                'label' => Yii::t('vova07/themes/admin', 'Resident Pages'),
                'url' => '#',
                'icon' => 'fa-file',
                'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions') ||  Yii::$app->user->identity->role == 'superadmin',
                'items' => [
                    [
                        'label' => Yii::t('vova07/themes/admin', 'News/Circulars'),
                        'url' => ['pages/index','PagesSearch[category]' => 1, 'data' => 1],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ], 
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Applications Form'),
                        'url' => ['/pages/index','PagesSearch[category]' => 11 , 'data' => 11],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'By Laws'),
                        'url' => ['/pages/index','PagesSearch[category]' => 6 , 'data' => 6],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ], 
					
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Contractor / Supplier'),
                        'url' => ['/useful/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions') ||  Yii::$app->user->identity->role == 'superadmin'
                    ], 
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Contractor Type'),
                        'url' => ['/useful-type/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions') ||  Yii::$app->user->identity->role == 'superadmin'
                    ], 
//                    [
//                        'label' => Yii::t('vova07/themes/admin', 'Useful Links'),
//                        'url' => ['/contacts/index'],
//                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
//                    ],

                    

                ]
            ],  

            
           /* [
                'label' => Yii::t('vova07/themes/admin', 'Social Events'),
                'url' => '#',
                'icon' => 'fa-calendar',
                'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions'),
                'items' => [
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Social Events'),
                        'url' => ['/events/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Social Events category'),
                        'url' => ['/events-category/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ], 
                ]
            ],

            [
                'label' => Yii::t('vova07/themes/admin', 'Useful Links'),
                'url' => '#',
                'icon' => 'fa-user',
                'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions'),
                'items' => [
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Useful Links'),
                        'url' => ['/contacts/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Useful Links Type'),
                        'url' => ['/contacts-type/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ],
                ]
            ], */
   
                      
            //pages
			/*[
                'label' => Yii::t('vova07/themes/admin', 'Pages'),
                'url' => '#',
                'icon' => 'fa fa-bell',
                'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles') || Yii::$app->user->can('BViewPermissions'),
                'items' => [
                    /*[
                        'label' => Yii::t('vova07/themes/admin', 'Pages'),
                        'url' => ['/pages/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewPermissions')
                    ],
                    [
                        'label' => Yii::t('vova07/themes/admin', 'Categories'),
                        'url' => ['/pages-categories/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ],
					 [
                        'label' => Yii::t('vova07/themes/admin', 'Type'),
                        'url' => ['/pages-type/index'],
                        'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
                    ], 
                   
                ]
            ], */
        ]
    ]
);