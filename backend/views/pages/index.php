<?php

use common\models\Pages;
use yii\helpers\Html;
use yii\grid\GridView;
use demogorgorn\jquerysortable\Sortable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="artmin-menu-detail">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="artmin-menu-detail-title"><?= Html::encode($this->title) ?></h4>
                    <div class="ml-auto">
                        <?= Html::a(Yii::t('backend', 'Create Page'), ['create'], ['class' => 'btn btn-info']) ?>
                    </div>
                </div>

                <div class="artmin-menu position-relative">
                    <ol class="artmin-menu-list">
                        <?php if (!empty($pages)) : ?>
                            <?php foreach ($pages as $page) : ?>
                                <li class="artmin-menu-item">
                                    <div class="artmin-menu-item-content">
                                        <div class="artmin-menu-item-handle d-flex flex-wrap">

                                            <div class="artmin-menu-item-data d-flex">
                                                <div class="artmin-menu-item-title"><?= $page['name'] ?></div>
                                                <div class="artmin-menu-item-alias"><?= $page['alias'] == '#' ? '' : $page['alias'] ?></div>
                                            </div>

                                            <div class="artmin-menu-item-buttons d-flex align-content-center justify-content-end">
                                                <a href="<?= Url::to(['pages/view/'.$page['id']]) ?>" class="artmin-menu-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 16" aria-labelledby="view" role="presentation" class="fill-current"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                                                </a>
                                                <a href="<?= Url::to(['pages/update/'.$page['id']]) ?>" class="artmin-menu-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="fill-current "><path d="M4.3 10.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM6 14h2.59l9-9L15 2.41l-9 9V14zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h6a1 1 0 1 1 0 2H2v14h14v-6z"></path></svg>
                                                </a>
                                                <a href="<?= Url::to(['pages/delete/'.$page['id']]) ?>" data-method="post" data-confirm="Yes?" class="artmin-menu-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="fill-current "><path d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>
