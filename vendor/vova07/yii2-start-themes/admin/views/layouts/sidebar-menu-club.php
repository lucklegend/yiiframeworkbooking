
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
                'url' => ['/fb-booking-booked/dashboard'],
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
			
			//facility booking  
			[
				'label' => Yii::t('vova07/themes/admin', 'Today Booking'),
				'url' => ['/fb-booking-booked/today'],
				'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')  ||  Yii::$app->user->identity->role == 'admin'  
			],
			[
				'label' => Yii::t('vova07/themes/admin', 'Online Booking'),
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
				'label' => Yii::t('vova07/themes/admin', 'Closing Days'),
				'url' => ['/fb-booking-closingday/index'],
				'visible' => Yii::$app->user->can('administrateRbac') ||  Yii::$app->user->identity->role == 'superadmin' || Yii::$app->user->can('BViewRoles')
			], 
        ]
    ]
);