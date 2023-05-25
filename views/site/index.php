<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Carousel;
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$products = \app\models\Product::find()->with('category', 'country')->all();

$items = [];
foreach ($products as $product) {
    $items[] = [
        'content' => '<img class="slider_baze" src="' . $product->image_path . '" alt="' . $product->title . '">',
        'caption' => '<h3>' . $product->title . '</h3><p>' . $product->description . '</p>',
    ];
}

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <?php

    // Render the carousel
    echo Carousel::widget([
        'items' => $items,
    ]);
    ?>

    <code><?= __FILE__ ?></code>
</div>
