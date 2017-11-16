<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Discounts */

$this->title = 'Update Discounts: ' . $model->id_discount;
$this->params['breadcrumbs'][] = ['label' => 'Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_discount, 'url' => ['view', 'id' => $model->id_discount]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="discounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
