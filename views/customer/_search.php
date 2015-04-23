<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FindCustomers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= //$form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= //$form->field($model, 'address') ?>

    <?= //$form->field($model, 'city') ?>

    <?= $form->field($model, 'contact_no') ?>

    <?php echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <?php // echo $form->field($model, 'date_registered') ?>

    <?php // echo $form->field($model, 'field1') ?>

    <?php // echo $form->field($model, 'field2') ?>

    <?php // echo $form->field($model, 'field3') ?>

    <?php // echo $form->field($model, 'field4') ?>

    <?php // echo $form->field($model, 'field5') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
