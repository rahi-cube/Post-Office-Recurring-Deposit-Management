<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FindAgent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'authority_no') ?>

    <?= $form->field($model, 'validity_date') ?>

    <?= $form->field($model, 'date_registered') ?>

    <?php // echo $form->field($model, 'field1') ?>

    <?php // echo $form->field($model, 'filed2') ?>

    <?php // echo $form->field($model, 'filed3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
