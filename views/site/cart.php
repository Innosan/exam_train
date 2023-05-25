<?php

/** @var yii\web\View $this */

use app\models\CartItem;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;

$cartItems = CartItem::find()->with('product')->all();
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($cartItems as $cartItem): ?>
        <div>
             <p class="$cartItem"><?=$cartItem->product->title?></p>
        </div>
    <?php endforeach ?>

    <?php if (!Yii::$app->user->isGuest) { ?>
        <?php $form =
            ActiveForm::begin([
                'action' => [
                    'order/make-order',
                    'userId' => Yii::$app->user->id,
                ]
            ]);
        echo Html::submitButton(
            'Заказать',
            ['name' => 'add-button',
                'value' => 'add',
                'class' => 'btn btn-primary'
            ]
        );
        ActiveForm::end(); ?>
    <?php } ?>

    <code><?= __FILE__ ?></code>
</div>
