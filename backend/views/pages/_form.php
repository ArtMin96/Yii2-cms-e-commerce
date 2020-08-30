<?php

use common\widgets\ArtMinToggleSwitch\ArtMinToggleSwitchWidget;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use mludvik\tagsinput\TagsInputWidget;
use powerkernel\slugify\Slugify;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */

$pages = new \common\models\Pages();

if ($model->isNewRecord) {
    $disabled = 'disabled';
} else {
    $disabled = '';
}

$form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]);

$baseUrl = Url::base(true);
?>

<nav class="nav nav-pills flex-column flex-sm-row mb-3" id="pills-tab" role="tablist">
    <a class="flex-sm-fill text-sm-center nav-link active" id="pills-page-info-tab" data-toggle="pill" href="#pills-page-info" role="tab" aria-controls="pills-page-info" aria-selected="true">
        <?= Yii::t('backend', 'Page Info') ?>
    </a>
    <a class="flex-sm-fill text-sm-center nav-link <?= $disabled ?>" id="pills-banner-tab" data-toggle="pill" href="#pills-banner" role="tab" aria-controls="pills-banner" aria-selected="true">
        <?= Yii::t('backend', 'Banner') ?>
    </a>
    <a class="flex-sm-fill text-sm-center nav-link <?= $disabled ?>" id="pills-page-content-tab" data-toggle="pill" href="#pills-page-content" role="tab" aria-controls="pills-page-content" aria-selected="true">
        <?= Yii::t('backend', 'Page Content') ?>
    </a>
    <a class="flex-sm-fill text-sm-center nav-link <?= $disabled ?>" id="pills-seo-tab" data-toggle="pill" href="#pills-seo" role="tab" aria-controls="pills-seo" aria-selected="true">
        <?= Yii::t('backend', 'SEO') ?>
    </a>
</nav>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-page-info" role="tabpanel" aria-labelledby="pills-page-info-tab">

        <div class="form-row">

            <div class="col-sm-12 col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-12 col-md-6">
                <?= $form->field($model, 'name_hy')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-12 col-md-6">
                <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-12 col-md-6">
                <?= $form->field($model, 'alias')->widget(Slugify::className(), ['source' => '#pages-name']) ?>
            </div>

        </div>

        <div class="form-row">

            <div class="col-sm-12 col-md-4">
                <?= $form->field($model, 'type')->widget(Select2::className(), [
                    'theme' => Select2::THEME_KRAJEE_BS4,
                    'data' => [
                        '_link' => '_link',
                        '_text' => '_text',
                    ],
                    'hideSearch' => true,
                    'maintainOrder' => true,
                    'options' => ['placeholder' => Yii::t('backend', 'Select')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>

            <div class="col-sm-12 col-md-4">
                <?= $form->field($model, 'parent_id')->widget(Select2::className(), [
                    'theme' => Select2::THEME_KRAJEE_BS4,
                    'data' => (!$model->isNewRecord && !empty($skipedNodes)) ? $skipedNodes : $activePages,
                    'hideSearch' => true,
                    'maintainOrder' => true,
                    'options' => ['placeholder' => Yii::t('backend', 'Select')],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>

            <div class="col-sm-12 col-md-4">
                <?= $form->field($model, 'order_sort')->textInput() ?>
            </div>

        </div>

        <?= $form->field($model, 'deleted')->widget(ArtMinToggleSwitchWidget::classname(), [
            'type' => ArtMinToggleSwitchWidget::CHECKBOX
        ]); ?>

        <?= $form->field($model, 'allow_delete')->widget(ArtMinToggleSwitchWidget::classname(), [
            'type' => ArtMinToggleSwitchWidget::CHECKBOX
        ]); ?>

        <?= $form->field($model, 'allow_parent')->widget(ArtMinToggleSwitchWidget::classname(), [
            'type' => ArtMinToggleSwitchWidget::CHECKBOX
        ]); ?>

    </div>
    <div class="tab-pane fade" id="pills-banner" role="tabpanel" aria-labelledby="pills-banner-tab">...</div>
    <div class="tab-pane fade" id="pills-page-content" role="tabpanel" aria-labelledby="pills-page-content-tab">...</div>
    <div class="tab-pane fade" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">

        <div class="row mb-2">
            <div class="col-sm-12">
                <h4>Website SEO meta</h4>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-12 col-md-6">
                <?= $form->field($seo, 'meta_title')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-12 col-md-6">
                <?php $seo->meta_keywords = explode(',', $seo->meta_keywords) ?>
                <?= $form->field($seo, 'meta_keywords')->widget(Select2::className(), [
                    'theme' => Select2::THEME_KRAJEE_BS4,
                    'value' => $seo->meta_keywords,
                    'hideSearch' => true,
                    'maintainOrder' => true,
                    'options' => [
                        'placeholder' => Yii::t('backend', 'Select'),
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true
                    ],
                ]) ?>
            </div>

        </div>

        <div class="form-row">

            <div class="col-sm-12 col-md-6">
                <?= $form->field($seo, 'meta_description')->textarea() ?>
            </div>

            <div class="col-sm-12 col-md-6">
                <?= $form->field($seo, 'meta_image')->widget(\kartik\file\FileInput::className(), [
                    'options' => [
                        'accept' => 'image/*'
                    ],
                    'pluginOptions' => [
                        'initialPreview' => !empty($seo->meta_image)? Html::img(Url::to('@storage/seo/'.$seo->page_id.'/'.$seo->meta_image), ['class' => 'w-100']) : '',
                        'maxFileSize' => 5800,
                        'showUpload' => false,
                        'overwriteInitial' => true,
                    ]
                ]) ?>
            </div>

        </div>

        <hr class="my-4">

        <div class="row">

            <div class="col-sm-12 col-md-6">

                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h4>Facebook</h4>
                    </div>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'og_title')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'og_type')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'og_url')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'og_site_name')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'og_description')->textarea() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'og_image')->widget(\kartik\file\FileInput::className(), [
                        'options' => [
                            'accept' => 'image/*'
                        ],
                        'pluginOptions' => [
                            'initialPreview' => !empty($seo->og_image)? Html::img(Url::to('@storage/seo/'.$seo->page_id.'/'.$seo->og_image), ['class' => 'w-100']) : '',
                            'maxFileSize' => 5800,
                            'showUpload' => false,
                            'overwriteInitial' => true,
                        ]
                    ]) ?>
                </div>

            </div>

            <div class="col-sm-12 col-md-6">

                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h4>Twitter</h4>
                    </div>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'twitter_title')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'twitter_site')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'twitter_card')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'twitter_creator')->textInput() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'twitter_description')->textarea() ?>
                </div>

                <div class="col-sm-12">
                    <?= $form->field($seo, 'twitter_image')->widget(\kartik\file\FileInput::className(), [
                        'options' => [
                            'accept' => 'image/*'
                        ],
                        'pluginOptions' => [
                            'initialPreview' => !empty($seo->twitter_image)? Html::img(Url::to('@storage/seo/'.$seo->page_id.'/'.$seo->twitter_image), ['class' => 'w-100']) : '',
                            'maxFileSize' => 5800,
                            'showUpload' => false,
                            'overwriteInitial' => true,
                        ]
                    ]) ?>
                </div>

            </div>

        </div>

    </div>

</div>

<div class="form-group text-right">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<?= \common\widgets\ArtMinScrollUp\ArtMinScrollUpWidget::widget() ?>
