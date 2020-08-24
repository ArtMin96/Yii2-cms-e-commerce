<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$menus = new \common\components\Helper();
?>
<div class="pages-view container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="artmin-menu-detail">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="artmin-menu-detail-title"><?= Html::encode($this->title) ?></h4>
                    <div class="ml-auto">
                        <a href="#" class="btn btn-info">Create</a>
                    </div>
                </div>

                <div class="artmin-menu position-relative">
                    <?= $menus->getChildren($model->id) ?>
                </div>
            </div>
        </div>
    </div>

</div>
