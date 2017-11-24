<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_category',
            //'id_parent',
            [
                'attribute' => 'id_parent',
                'value' => function ($data) {
                    if(isset($data->categories->title)){
                        return $data->categories->title;
                    }else{
                        return 'parent category';
                    }
                },
                'format' => 'html',
            ],
            'title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-hover table-striped'
        ],
    ]); ?>
</div>
