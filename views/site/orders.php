<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form =
        ActiveForm::begin([
            'action' => [
                'order/delete-all-new',
            ]
        ]);
    echo Html::submitButton(
        'Удалить все новые',
        ['name' => 'add-button', 'value' => 'add', 'class' => 'btn btn-danger']
    );
    ActiveForm::end(); ?>

    <?php foreach ($orders as $order): ?>

        <?= DetailView::widget([
            'model' => $order,
            'options' => ['class' => 'table table-striped table-bordered detail-view'],
            'attributes' => [
                'id',
                'created_at',
                'status.title'
                // add more attributes here as needed
            ],
        ]) ?>

        <?php if ($order->status_id == 1) { ?>
            <?php $form =
                ActiveForm::begin([
                    'action' => [
                        'order/delete',
                        'id' => $order->id
                    ]
                ]);
            echo Html::submitButton(
                'Удалить',
                ['name' => 'add-button', 'value' => 'add', 'class' => 'btn btn-danger']
            );
            ActiveForm::end(); ?>
        <?php }?>

        <h3>Order Items</h3>
        <ul>
            <?php foreach ($order->orderItems as $item): ?>
                <li><?= $item->product->title ?></li>
            <?php endforeach ?>
        </ul>
    <?php endforeach ?>

    <code><?= __FILE__ ?></code>
</div>
