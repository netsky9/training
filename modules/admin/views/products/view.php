<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */

$this->title = $model->title_product;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_product',
            'title_product',
            //'id_category',
            [
                'attribute' => 'Category',
                'value' => function ($data){
                    return $data->categories->title;
                },
            ],
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
            'count',
            'view',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_product], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_product], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
