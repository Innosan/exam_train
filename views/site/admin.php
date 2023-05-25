<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <a href="?r=product">Product</a>
    <a href="?r=category">category</a>
    <a href="?r=country">country</a>
    <a href="?r=status">status</a>
    <a href="?r=order">order</a>
    <a href="?r=order-item">orderitem</a>
    <a href="?r=cart-item">cartitem</a>

    <code><?= __FILE__ ?></code>
</div>
