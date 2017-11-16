<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rent-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rent', ['create'], ['class' => 'btn btn-success right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_rent',
            'id_product',
            'id_user',
            'message',
            'rent_begin',
            'rent_end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
                'class' => 'table table-hover table-striped'
            ],
    ]); ?>
</div>
