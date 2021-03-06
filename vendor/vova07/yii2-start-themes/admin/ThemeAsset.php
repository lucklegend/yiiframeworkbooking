<?php

namespace vova07\themes\admin;

use yii\web\AssetBundle;

/**
 * Theme main asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vova07/themes/admin/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        //'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.css',
        'css/custom.css',
		'css/bootstrap-media-lightbox.css'
    ];

    public $js = [
        'js/AdminLTE/app.js',
		'js/bootstrap-media-lightbox.js',
		'js/bootstrap-media-lightbox.min.js',
		'js/html5-canvas-drawing-app.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
