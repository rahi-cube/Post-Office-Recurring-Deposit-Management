<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customers;

/* @var $this yii\web\View */
/* @var $model app\models\RdAccounts */
/* @var $form yii\widgets\ActiveForm */

$items = ArrayHelper::map(Customers::find()->all(), 'id', 'name');

?>

<div class="rd-accounts-form">
  <?php $form = ActiveForm::begin(); ?>
  <div class="row-fuild">
    <div class="col-md-6">
      <?= $form->field($model, 'account_no')->textInput(['maxlength' => 20]) ?>
      <?=  //$form->field($model, 'contact_1')->textSelect() 
	
			$form->field($model, 'contact_1')->dropDownList(
           	 	$items,           // Flat array ('id'=>'label')
            	['prompt'=>'Select Customer']    // options
        	);

	
		?>
      <?= //$form->field($model, 'term')->textInput() 
	
		$form->field($model, 'term')->dropDownList(
            ["5" => "5 Years","6"  => "6 Years","7"  => "7 Years","8"  => "8 Years","9"  => "9 Years","10"  => "10 Years"], // Flat array ('id'=>'label')
            ['prompt'=>'Select Term']    // options
        );
	
	?>
      
      <?= $form->field($model, 'start_date')->textInput() ?>
      <?= $form->field($model, 'end_date')->textInput() ?>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>
    <div class="col-md-6">
      <?= $form->field($model, 'deposit_amount')->textInput(['maxlength' => 20]) ?>
      <?=  //$form->field($model, 'contact_1')->textSelect() 
	
			$form->field($model, 'contact_2')->dropDownList(
				$items,           // Flat array ('id'=>'label')
				['prompt'=>'Select Customer 2']    // options
			);
	
		
		?>
      <?= $form->field($model, 'kyc')->textInput(['maxlength' => 25]) ?>
      
      <?= $form->field($model, 'card_no')->textInput() ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
