<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_parent')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\admin\models\Categories::find()->where('id_parent = 0')->all(), 'id_category', 'title')); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-fill btn-wd' : 'btn btn-info btn-fill btn-wd']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
