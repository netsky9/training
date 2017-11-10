<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailattribute */

$this->title = 'Update Detailattribute: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Detailattributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_detail_attribute]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detailattribute-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
