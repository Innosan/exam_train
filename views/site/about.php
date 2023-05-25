<?php

/** @var yii\web\View $this */

use app\models\Product;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';

$query = Product::find()
    ->joinWith('category')
    ->joinWith('country');

if ($category = Yii::$app->request->get('category')) {
    $query->andWhere(['category_id' => $category]);
}

$orderBy = Yii::$app->request->get('sort');
if ($orderBy) {
    $query->orderBy($orderBy);
}

$products = $query->all();

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead biba">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['site/about'],
            'options' => ['class' => 'form-inline mb-3'],
        ]) ?>

        <th><?= Html::a('Title', ['site/about', 'sort' => 'title']) ?></th>
        <th><?= Html::a('Category', ['site/about', 'sort' => 'category.title']) ?></th>
        <th><?= Html::a('Country', ['site/about', 'sort' => 'country.title']) ?></th>

        <div class="form-group mr-2">
            <?= Html::dropDownList(
                    'category',

                    Yii::$app->request->get('category'),
                    \app\models\Category::find()
                        ->select(['title', 'id'])
                        ->indexBy('id')
                        ->column(),

                    ['prompt'=>'All categories', 'class'=>'form-control'])
            ?>
        </div>
        <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
        <?php foreach ($products as $product): ?>
            <div>
                <p class="$product"><?=$product->title?></p>
                <p class="$product"><?=$product->category->title?></p>
                <p class="$product"><?=$product->country->title?></p>

                <?php if (!Yii::$app->user->isGuest) { ?>
                    <?php $form =
                        ActiveForm::begin([
                            'action' => [
                                'cart-item/add-to-cart',
                                'productId' => $product->id,
                                'userId' => Yii::$app->user->id
                            ]
                        ]);
                    echo Html::submitButton(
                        'Добавить в корзину',
                        [
                                'name' => 'add-button',
                            'value' => 'add',
                            'class' => 'btn btn-primary'
                        ]
                    );
                    ActiveForm::end();
                    ?>
                <?php }?>

            </div>
        <?php endforeach ?>
    </div>
</div>
