<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailattribute */

$this->title = 'Create Detailattribute';
$this->params['breadcrumbs'][] = ['label' => 'Detailattributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailattribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
