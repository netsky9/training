<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Extras Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extras-price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Extras Price', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_product',
            'one_hour',
            'six_hour',
            'twelve_hours',
            'one_week',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
