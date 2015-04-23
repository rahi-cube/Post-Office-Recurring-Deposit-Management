<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'authority_no')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'validity_date')->textInput() ?>

    <?= $form->field($model, 'date_registered')->textInput() ?>

    <?= $form->field($model, 'field1')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'filed2')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'filed3')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
