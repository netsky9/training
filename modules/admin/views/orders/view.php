<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->title = $model->id_order;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1>Order №<?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_order',
            [
                'attribute' => 'id_product',
                'value' => function ($data) {
                    return '<a href="/bicycles/view?id_product='.$data->products->id_product.'">'.$data->products->title_product.'</a>';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'buyer',
                'value' => function ($data) {
                    return $data->buyers->name.' '.$data->buyers->last_name;
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'buyer contacts',
                'value' => function ($data) {
                    return 'phone: '.$data->buyers->phone.' email: '.$data->buyers->email;
                },
                'format' => 'html',
            ],
            'datetime',
            'count',
            'sum',
            'id_discount',
            'status',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_order], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_order], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
