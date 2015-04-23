<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RdAccounts;
use app\models\Customers;
use app\models\Schedule;

/* @var $this yii\web\View */
/* @var $model app\models\Schedule */
/* @var $form yii\widgets\ActiveForm */

$rdaccount = RdAccounts::find()->all();
$month = date("m");
$year  = date('Y');

$schedule = Schedule::find(['month' => $month, 'year' => $year])->one();

if(count($schedule) == 0)
{
	$no = 1;
}
else
{
	$no = $schedule->srno + 1;
}

?>

<div class="schedule-form">

    <?php $form = ActiveForm::begin(); ?>
	
    <div class="well">
    	<label>Schedule Date : </label>
    	<input type="text" id="schedule-date" name="schedule_date" value="<?php echo date('Y-m-d'); ?>" />
        
        <label style="margin-left:20px;">Nos : </label>
    	<input type="text" name="nos" readonly="readonly" value="0<?php echo $no ?>"/>
        
        <label style="margin-left:20px;">Schedule Number : </label>
    	<input type="text" name="schedule_num" id="schedule_num" value="<?php echo 0 . $no . "-" . date("m/Y"); ?>" readonly="readonly" />
    </div>
    
    <div class="row-fluid">
    	<div class="col-lg-4" style="padding:0">
        	<table class="table table-bordered table-striped sieve">
            	<thead>
                	<th>Acc No</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th></th>
                </thead> 
                <tbody>
                	<?php foreach($rdaccount as $l){ 
					$v['account_no'] = $l['account_no'];
					$v['name'] = Customers::getContact($l['contact_1']);;
					$v['deposit_amount'] = $l['deposit_amount'];					
					?>
                        <tr id="left-<?php echo $v['account_no']; ?>">
                        	<td><?php echo $l['account_no'] ?></td>
                            <td><?php echo $v['name']; ?></td>
							<td><?php echo $l['deposit_amount'] ?> Rs.</td>
                            <td><a href="javascript:void(0);" class="add-to-right" rel='<?php echo json_encode($v); ?>'>Add</a></td>							                            
                        </tr>                
                    <?php } ?> 
                </tbody>           
            </table>
        </div>
        <div class="col-lg-7 pull-right" style="padding-right:0">
        	<table class="table table-bordered table-striped">
            	<thead>
                	<th>Account No</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th width="15%"></th>
                </thead> 
                <tbody id="schedule-pane">
                	<td colspan="4">Select From left menu</td>
                </tbody> 
                <tfoot>
                	<tr class="success">
                		<td colspan="3" align="right"><strong>Amount of Gross Deposited</strong><input type="hidden" name="total" id="input-total" value="0"/></td>
                    	<td align="left" id="total">0 Rs.</td> 
                    </tr>
                    <tr class="warning">
                		<td colspan="3" align="right"><strong>Amount of Commission Received</strong></td>
                    	<td align="left" id="comm">0 Rs.</td> 
                    </tr>
                    <tr class="danger">
                		<td colspan="3" align="right"><strong>Net Amount to be Tendered</strong></td>
                    	<td align="left" id="tendered">0 Rs.</td> 
                    </tr>
                    <tr class="info">
                		<td colspan="3" align="right"><strong>T.D.S</strong></td>
                    	<td align="left" id="tds">0 Rs.</td> 
                    </tr>                   
                </tfoot> 
                          
            </table>
            <div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Save Schedule' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right', 'id' => 'create-submit']) ?>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
