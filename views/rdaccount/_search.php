<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FindRdAccounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rd-accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'account_no') ?>

    <?= $form->field($model, 'contact_1') ?>

    <?= $form->field($model, 'contact_2') ?>

    <?= $form->field($model, 'deposit_amount') ?>

    <?= $form->field($model, 'term') ?>

    <?php // echo $form->field($model, 'kyc') ?>

    <?php // echo $form->field($model, 'card_no') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'balance_in') ?>

    <?php // echo $form->field($model, 'balance_out') ?>

    <?php // echo $form->field($model, 'half_withdrawal') ?>

    <?php // echo $form->field($model, 'last_trans_date') ?>

    <?php // echo $form->field($model, 'date_registered') ?>

    <?php // echo $form->field($model, 'field1') ?>

    <?php // echo $form->field($model, 'field2') ?>

    <?php // echo $form->field($model, 'filed3') ?>

    <?php // echo $form->field($model, 'filed4') ?>

    <?php // echo $form->field($model, 'filed5') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
