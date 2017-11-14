<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detailattributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailattribute-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detailattribute', ['create'], ['class' => 'btn btn-success right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_detail_attribute',
            //'id_category',
            [
                'attribute' => 'id_category',
                'value' => function ($data) {
                    return $data->categories->title;
                },
            ],
            'title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-hover table-striped'
        ],
    ]); ?>
</div>
