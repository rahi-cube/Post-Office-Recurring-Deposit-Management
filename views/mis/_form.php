<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customers;
/* @var $this yii\web\View */
/* @var $model app\models\MisAccount */
/* @var $form yii\widgets\ActiveForm */

$items = ArrayHelper::map(Customers::find()->all(), 'id', 'name');
?>

<div class="mis-account-form">
<div class="row">
	<?php $form = ActiveForm::begin(); ?>
	<div class="col-md-4">
    <?= $form->field($model, 'account')->textInput() ?>

    <?=  $form->field($model, 'contact_1')->dropDownList($items, ['prompt'=>'Select Customer']); ?>

    <?=  $form->field($model, 'contact_2')->dropDownList($items, ['prompt'=>'Select Customer']); ?>

    <?=  $form->field($model, 'contact_3')->dropDownList($items, ['prompt'=>'Select Customer']); ?>

    
    <?= $form->field($model, 'amount')->textInput() ?>
    
    <?= $form->field($model, 'start_date')->textInput() ?>
    
         
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    
    <div class="col-md-4">
    
    <?= //$form->field($model, 'term')->textInput() 
	
		$form->field($model, 'payment_type')->radioList(
            ["cheque" => "Cheque","cash" => "Cash Payment"], // Flat array ('id'=>'label')
            ['class'=>'payment_type']    // options
        );
	
	?>

    <?= $form->field($model, 'cheque_no')->textInput() ?>

    <?= $form->field($model, 'date_taken')->textInput() ?>
    
    <?= $form->field($model, 'kyc')->textInput(['maxlength' => 30]) ?>

    <?php //$form->field($model, 'register_date')->textInput() ?>

    <?= $form->field($model, 'term')->dropDownList(
            ["5" => "5 Years","6"  => "6 Years","7"  => "7 Years","8"  => "8 Years","9"  => "9 Years","10"  => "10 Years"], // Flat array ('id'=>'label')
            ['prompt'=>'Select Term']    // options
        ); ?>

    

    

    <?= $form->field($model, 'status')->dropDownList(
            //["5" => "5 Years","6"  => "6 Years","7"  => "7 Years","8"  => "8 Years","9"  => "9 Years","10"  => "10 Years"], // Flat array ('id'=>'label')
            ["1" => "Active","0"  => "Closed"],
			['prompt'=>'Select Term']    // options
        ); 
	?>
    
   
    </div>

    

    

    

    <?php ActiveForm::end(); ?>
</div>
</div>
