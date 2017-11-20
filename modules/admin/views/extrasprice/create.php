<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ExtrasPrice */

$this->title = 'Create Extras Price';
$this->params['breadcrumbs'][] = ['label' => 'Extras Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extras-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
