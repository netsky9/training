<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailvalue */

$this->title = 'Create Detailvalue';
$this->params['breadcrumbs'][] = ['label' => 'Detailvalues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailvalue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
