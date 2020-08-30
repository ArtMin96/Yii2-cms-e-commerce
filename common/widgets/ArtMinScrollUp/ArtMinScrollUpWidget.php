<?php

namespace common\widgets\ArtMinScrollUp;

use common\widgets\ArtMinScrollUp\ArtMinScrollUpAsset;
use yii\base\Widget;

class ArtMinScrollUpWidget extends Widget
{

    public function run() {
        //Подключаем свой файл Asset
        ArtMinScrollUpAsset::register($this->view);
        return $this->render('artmin-scrollup', []);
    }

}