<?php

namespace common\widgets\ArtMinScrollUp;

use yii\web\AssetBundle;

class ArtMinScrollUpAsset extends AssetBundle
{
    public $sourcePath = (__DIR__ . '/assets');

    public $css = [
        'css/scroll-up.css',
    ];

    public $js = [
        'js/scroll-up.js',
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}