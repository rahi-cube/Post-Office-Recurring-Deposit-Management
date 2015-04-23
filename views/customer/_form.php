<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'signature')->fileinput();

     //$form->field($model, 'date_registered')->textInput() ?>

	<?php /*  ?>
	
    <?= $form->field($model, 'field1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'field2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'field3')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'field4')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'field5')->textInput(['maxlength' => 50]) ?>

	</php */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

