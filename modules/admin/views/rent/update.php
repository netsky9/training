<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Rent */

$this->title = 'Update Rent: ' . $model->id_rent;
$this->params['breadcrumbs'][] = ['label' => 'Rents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rent, 'url' => ['view', 'id' => $model->id_rent]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
