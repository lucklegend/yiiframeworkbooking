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
            'class' => 'nav navbar-nav defect-menu'
        ],
        'items' => [
		    [
                'label' => Yii::t('vova07/themes/site', 'By Cases'),
                'url' => ['/admin/default/index'],
				'visible' => !Yii::$app->user->isGuest,
            ],
			[
                'label' => Yii::t('vova07/themes/site', 'By Defect'),
                'url' => ['/admin/default/defect'],
				'visible' => !Yii::$app->user->isGuest,
            ],
			[
                'label' => Yii::t('vova07/themes/site', 'By Unit'),
                'url' => ['/admin/default/unit'],
				'visible' => !Yii::$app->user->isGuest,
            ],
			[
                'label' => Yii::t('vova07/themes/site', 'By Block'),
                'url' => ['/admin/default/block'],
				'visible' => !Yii::$app->user->isGuest,
            ],
			[
                'label' => Yii::t('vova07/themes/site', 'By Priority'),
                'url' => ['/admin/default/priority'],
				'visible' => !Yii::$app->user->isGuest,
            ],
			
    ]
	]
);