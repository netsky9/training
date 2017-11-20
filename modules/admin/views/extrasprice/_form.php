<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ExtrasPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="extras-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_product')->textInput(['value' => $_GET['id']]) ?>

    <?= $form->field($model, 'one_hour')->textInput() ?>

    <?= $form->field($model, 'six_hour')->textInput() ?>

    <?= $form->field($model, 'twelve_hours')->textInput() ?>

    <?= $form->field($model, 'one_week')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
