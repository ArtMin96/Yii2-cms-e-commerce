<?php
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];

use demogorgorn\jquerysortable\Sortable;

$items = [
        [
            'content' => 'First',
            'options' => ['class' => 'panel', 'data-id' => 12]
        ],
        [
            'content' => 'Second',
            'options' => ['class' => 'panel', 'data-id' => 13],
            'items' => [
                [
                    'content' => 'Nested 1',
                    'options' => ['class' => 'panel', 'data-id' => 14]
                ],
                [
                    'content' => 'Nested 2',
                    'options' => ['class' => 'another class']
                ],

            ]

        ],

    ];

echo Sortable::widget([

    'listTag' => 'ol',
    'autoNestedEnabled' => true,
    'useDragHandle' => '<i class="fas fa-bars"></i>',
    'options' => [
        'class' => 'vertical',
        'id' => 'menulist',
    ],
    'items'=> $items,
    'clientOptions' => [
        'handle' => '.fa-bars',
        'onDragStart' => new \yii\web\JsExpression('function ($item, container, _super) {
                // Duplicate items of the no drop area
                if(!container.options.drop)
                    $item.clone().insertAfter($item);
                    _super($item, container);
        }'),

    ],
]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <?= \hail812\adminlte3\widgets\Alert::widget([
                'type' => 'success',
                'body' => '<h3>Congratulations!</h3>',
            ]) ?>
            <?= \hail812\adminlte3\widgets\Callout::widget([
                'type' => 'danger',
                'head' => 'I am a danger callout!',
                'body' => 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
            ]) ?>
        </div>
    </div>
</div>