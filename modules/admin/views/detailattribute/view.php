<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailattribute */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Detailattributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailattribute-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_detail_attribute',
            //'id_category',
            [
                'attribute' => 'id_category',
                'value' => function($data){
                    return $data->categories->title;
                },
            ],
            'title',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_detail_attribute], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_detail_attribute], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
