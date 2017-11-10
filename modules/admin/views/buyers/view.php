<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Buyers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Buyers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buyers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_user',
            'name',
            'last_name',
            'phone',
            'email:email',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_user], ['class' => 'btn btn-info btn-fill btn-wd']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_user], [
            'class' => 'btn btn-danger btn-fill btn-wd',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
