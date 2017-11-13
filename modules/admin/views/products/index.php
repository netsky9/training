<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_product',
            [
                'attribute' => 'Image',
                'value' => function($data){
                    $img = $data->getImage();
                    return "<img src='{$img->getUrl('100x')}'>";
                },
                'format' => 'html',
            ],
            //'title_product',
            [
                'attribute' => 'title_product',
                'value' => function($data){
                    return '<a href="/bicycles/view?id_product='.$data->id_product.'">'.$data->title_product.'</a>';
                },
                'format' => 'html',
            ],
            'id_category',
            'description:ntext',
            'price',
            //'rent_sale',
            [
                'attribute' => 'rent_sale',
                'value' => function($data){
                    if($data->rent_sale == 0) return 'sale';
                    if($data->rent_sale == 1) return 'rent';
                    if($data->rent_sale == 2) return 'rent + sale';
                },
            ],
            //'count',
            // 'view',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-hover table-striped'
        ],
    ]); ?>
</div>