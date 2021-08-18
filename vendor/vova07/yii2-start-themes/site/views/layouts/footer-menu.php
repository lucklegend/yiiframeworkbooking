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
            'class' => isset($footer) ? 'pull-right' : 'nav navbar-nav navbar-right'
        ],

        'items' => [
            [
                'label' => Yii::t('vova07/themes/site', 'Administrator'),
                'url' => ['/users/guest/login'],
                'visible' => Yii::$app->user->isGuest
            ],
        ]
    ]
);