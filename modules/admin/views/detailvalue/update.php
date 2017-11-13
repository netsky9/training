<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailvalue */

$this->title = 'Update Detailvalue: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Detailvalues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_detail_value]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detailvalue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
