<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Detailvalue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detailvalue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_detail_attribute')->textInput() ?>

    <?= $form->field($model, 'id_product')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-fill btn-wd' : 'btn btn-primary btn-fill btn-wd']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
