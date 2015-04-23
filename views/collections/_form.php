<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RdAccounts;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Collections */
/* @var $form yii\widgets\ActiveForm */
$items = ArrayHelper::map(RdAccounts::find()->all(), 'deposit_amount', 'account_no');
?>

<div class="collections-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-4">
        <?php 
        echo $form->field($model, 'account_id')->dropDownList(
                $items,           // Flat array ('id'=>'label')
                ['prompt'=>'Select Account']    // options
        );
        ?>
        </div>
        <div class="col-md-2">
        	<div class="form-grouprequired">
            	<label>&nbsp;</label>
            	<input type="text" class="form-control" id="collection_date" placeholder="select date" name="collection_date" maxlength="50">            	
            </div>
        </div>
        <div class="col-md-1">
        	<label></label>
          
        	<a href="javascript:void(0);" id="collect" style="padding:6px 15px; margin-top:4px;" class="btn btn-info">Collect</a>
        </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                    	<tr>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Collection Month</th>
                             <th></th>
                        </tr>
                    </thead>
                    <tbody id="account-list">
                    	<tr>
                        	<td colspan="4" align="center">Please select account from above </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
	</div>
    
	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Collection' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'submit_button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
