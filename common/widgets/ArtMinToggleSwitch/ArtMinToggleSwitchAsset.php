<?php

namespace common\widgets\ArtMinToggleSwitch;

use yii\web\AssetBundle;

/**
 * Class ArtMinToggleSwitchAsset
 */
class ArtMinToggleSwitchAsset extends AssetBundle
{

    public $sourcePath = (__DIR__ . '/assets');

    public $css = ["css/jquery.mswitch.css"];
    public $js = ["js/jquery.mswitch.js"];

    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];

    public $depends = [
        "backend\assets\AppAsset"
    ];

    public $publishOptions = [
        'forceCopy' => true,
    ];

    public function init()
    {
        parent::init();
    }

}