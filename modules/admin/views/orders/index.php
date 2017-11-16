<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_order',
            [
                'attribute' => 'id_product',
                'value' => function ($data) {
                    return '<a href="/bicycles/view?id_product='.$data->products->id_product.'">'.$data->products->title_product.'</a>';
                },
                'format' => 'html',
            ],
            //'id_user',
            [
                'attribute' => 'id_user',
                'value' => function ($data) {
                    return '<a href="/admin/users/view?id='.$data->users->id_user.'">'.$data->users->name.'</a>';
                },
                'format' => 'html',
            ],
            'datetime',
            'count',
            // 'sum',
            // 'id_discount',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
                'class' => 'table table-hover table-striped'
            ],
    ]); ?>
</div>
