<?php

use common\widgets\ArtMinToggleSwitch\ArtMinToggleSwitchWidget;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use powerkernel\slugify\Slugify;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<nav class="nav nav-pills flex-column flex-sm-row mb-3" id="pills-tab" role="tablist">
    <a class="flex-sm-fill text-sm-center nav-link active" id="pills-page-info-tab" data-toggle="pill" href="#pills-page-info" role="tab" aria-controls="pills-page-info" aria-selected="true">
        <?= Yii::t('backend', 'Page Info') ?>
    </a>
    <a class="flex-sm-fill text-sm-center nav-link" id="pills-banner-tab" data-toggle="pill" href="#pills-banner" role="tab" aria-controls="pills-banner" aria-selected="true">
        <?= Yii::t('backend', 'Banner') ?>
    </a>
    <a class="flex-sm-fill text-sm-center nav-link" id="pills-page-content-tab" data-toggle="pill" href="#pills-page-content" role="tab" aria-controls="pills-page-content" aria-selected="true">
        <?= Yii::t('backend', 'Page Content') ?>
    </a>
    <a class="flex-sm-fill text-sm-center nav-link" id="pills-seo-tab" data-toggle="pill" href="#pills-seo" role="tab" aria-controls="pills-seo" aria-selected="true">
        <?= Yii::t('backend', 'SEO') ?>
    </a>
</nav>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-page-info" role="tabpanel" aria-labelledby="pills-page-info-tab">

        <?php $form = ActiveForm::begin(); ?>

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
                    'data' => \yii\helpers\ArrayHelper::map($skipedNodes, 'id', 'name'),
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

        <div class="form-group text-right">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <div class="tab-pane fade" id="pills-banner" role="tabpanel" aria-labelledby="pills-banner-tab">...</div>
    <div class="tab-pane fade" id="pills-page-content" role="tabpanel" aria-labelledby="pills-page-content-tab">...</div>
    <div class="tab-pane fade" id="pills-seo" role="tabpanel" aria-labelledby="pills-seo-tab">...</div>
</div>
