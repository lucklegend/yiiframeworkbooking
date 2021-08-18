<?php

namespace vova07\themes\site;

use yii\web\AssetBundle;

/**
 * Theme main asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vova07/themes/site/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        //'css/font-awesome.min.css',
        'css/main.css',
        'css/custom.css',
        // 'css/custom1.css',
		'css/bootstrap-media-lightbox.css'
    ];

    public $js = [
		'js/bootstrap-media-lightbox.js',
		'js/bootstrap-media-lightbox.min.js',
		'js/html5-canvas-drawing-app.js'
	];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
