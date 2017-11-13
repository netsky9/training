<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailvalue */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Detailvalues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailvalue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_detail_value',
            'id_detail_attribute',
            'id_product',
            'title',
            'value:ntext',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_detail_value], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_detail_value], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
