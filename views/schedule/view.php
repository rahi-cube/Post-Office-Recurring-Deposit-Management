<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\RdAccounts;
use app\models\Customers;
/* @var $this yii\web\View */
/* @var $model app\models\Schedule */

$this->title = "Schedule No : " . $model->srno . "-" . $model->month . "/" . $model->year;
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.borderless td, .borderless th {
    border: none !important;
}
.panel p
{
	line-height:18px;
}
th
{
	text-align:center !important;
}
.right_only tr td
{
	text-align:center;
	min-height: 600px;
}
</style>
<div class="schedule-view">

    <p>
    	<span style="font-size:24px">Schedule No : <span style="color:#00F"><?php echo $this->title ?></span></span>
        <?= Html::a('Print', ['print', 'id' => $model->id], ['class' => 'btn btn-success btn-sm pull-right', "target" => "_blank"]) ?>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm pull-right']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
    </p>
	
    <div class="panel panel-default" id="schedule-page">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
									<address>
										<p class="addres_name"><strong><?php echo $this->title ?></strong></p>
										<p>SCHEDULE FOR DEPOSIT IN PO RD ACCOUNT</p>
										<p>NAME OF THE AGENT : <strong>SMT. J V SHAH</strong></p>
										<p>Authority No. of the Agent : <strong>359/98 SUR MPKBY</strong></p>
									</address>
                                    <p style="border:1px solid #000; padding:0px 8px; text-align:center; width:55%;"><strong>NAVYUG COLLEGE PO</strong></p>                                                                        
                                    <p>Date : <strong><?php echo date("d-m-Y", strtotime($model->schedule_date)); ?></strong></p>
								</div>
								<div class="col-md-7">
									<div class="row">
                                    	<div class="col-sm-7">
                                            <p>1. Amount of Gross Deposited</p>
                                            <p>2. Amount of Commission Received</p>
                                            <p>3. Net Amount to be Tendered</p>
                                            <p style="text-align:right">T.D.S</p>                                            
                                        </div>
                                        <div class="col-sm-5">
                                            
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->gross_total); ?></p>
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->commision); ?></p>
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->net_amount); ?></p>
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->tds); ?></p>                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-sm-12">
                                        	<p>Signature of Agent</p>
                                            <p>A.A.No : 359/98 SUR MPKBY</p>
                                            <p>Valid Upto : 31/03/2018</p>
                                        </div>
                                    </div>
								</div>                                
							</div>
							<div class="row" style="margin-top:20px;">
								<div class="col-md-12">
									<table class="table borderless invoice_table">
										<thead>
											<tr>
												<th width="5%">No.</th>
												<th width="30%">Name of Depositer</th>
												<th width="10">Amount Deposited</th>
												<th width="10">D.L.T</th>
												<th width="10">A/C. No.</th>
												<th width="5%">ASLASS,5 Card No</th>
                                                <th width="10">Month</th>
                                                <th width="10">Balance</th>
                                                <th width="10">Remarks</th>
											</tr>
                                            <tr class="my">
												<th>1</th>
												<th>2</th>
												<th>3</th>
												<th>4</th>
												<th>5</th>
												<th>6</th>
                                                <th>7</th>
                                                <th>8</th>
                                                <th>9</th>
											</tr>
										</thead>
										<tbody class="right_only">
                                        	<?php 
											$i = 1;
											foreach($details as $d){ 
											$row = RdAccounts::find()->where(['account_no' => $d['account_no']])->one();
											?>
                                            <tr>
												<td><?php echo $i; ?></td>
												<td><?php echo Customers::getContact($row['contact_1']); ?></td>
												<td><?php echo $row['deposit_amount']; ?></td>
                                                <?php if($d['last_trans_date'] == "0000-00-00"){ ?>
												<td>-</td>
                                                <?php }else{ ?>
                                                <td><?php echo date("d/m/Y", strtotime($d['last_trans_date'])); ?></td>
                                                <?php } ?>
												<td><?php echo $row['account_no']; ?></td>
												<td><?php echo $row['card_no']; ?></td>
                                                <td><?php echo date("M y", strtotime("01-" .$model['month'] ."-". $model['year'])); ?></td>
												<td><?php echo $row['balance_out']; ?></td>
												<td></td>
											</tr>
											<?php 
											$i++;
											} ?>
										</tbody>
										<tfoot style="">
											<tr style="margin-top:20px; border-top: 1px dashed #000;">
                                            	<td colspan="2"></td>
                                                <td colspan="" style="text-align:center"><?php echo sprintf("%.2f",$model->gross_total); ?></td>
                                                <td colspan="6"></td>
											</tr>											
										</tfoot>
									</table>
								</div>
							</div>
                            <div class="row" style="margin-top:20px;">
								<div class="col-md-12">
									<p>Signature of the MPKBY</p>
                                    <p><strong>SMT. J V SHAH</strong></p>
                                    <p>A.A.No : 359/98 SUR MPKBY</p>
								</div>
							</div>
                            <div class="row" style="margin-top:20px;">
								<div class="col-md-12">
									<p align="center" style="text-decoration:underline"><strong>Postal Certificate</strong></p>
                                    <p>It is Certify that total sum Rs. <strong><?php echo sprintf("%.2f",$model->gross_total); ?></strong> Ruppes <?php ?> has been Received and Deposited / Creditedas shown above in the PO RD Account Pass Books of the Investor's Cencerned.</p>
                                    <p>Date : <strong><?php echo date("d-m-Y", strtotime($model->schedule_date)); ?></strong></p>
                                    <p style="margin-top:50px;">Stamp of the Post Office <span style="margin-left:50%;">Signature of the Post Master</span></p>
								</div>
							</div>
						</div>
					</div>
       

</div>
