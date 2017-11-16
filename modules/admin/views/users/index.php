<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_user',
            'username',
            //'password',
            //'auth_key',
            'name',
            // 'last_name',
             'phone',
             'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
                'class' => 'table table-hover table-striped'
            ],
    ]); ?>
</div>
