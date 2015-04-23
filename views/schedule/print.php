<?php

//use yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\RdAccounts;
use app\models\Customers;
use app\models\Schedule;
/* @var $this yii\web\View */
/* @var $model app\models\Schedule */

$this->title = "Schedule No : " . $model->srno . "-" . $model->month . "/" . $model->year;
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="RFNiUV9VYWoqZg44OCRUKSYkDBpvZFRaK2cHZm4DLAI8EVZmMhs1LQ==">
    <title><?php echo $this->title ?></title>
    <link href="/wow/assets/7edcf16a/css/bootstrap.css" rel="stylesheet">
    <link href="/wow/web/css/site.css" rel="stylesheet">
    <link href="/wow/web/css/btheme.css" rel="stylesheet">    
</head>
<body onLoad="window.print()">

<style>
*
{
	font-family:Arial, Helvetica, sans-serif;
}
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
.schedule-view 
{
	width:960px;
	border:none;
	padding:10px 30px;
}
*{
	font-size:99%;
}
@page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
<div class="schedule-view">
	
    <div class="panel panel-default" id="schedule-page" style="border:none; box-shadow:none;">
						<div class="panel-body">
							<div class="row">
								<div style="display:table-cell; width:500px;">
									<address>
										<p class="addres_name"><strong><?php echo $this->title ?></strong></p>
										<p>SCHEDULE FOR DEPOSIT IN PO RD ACCOUNT</p>
										<p>NAME OF THE AGENT : <strong>SMT. J V SHAH</strong></p>
										<p>Authority No. of the Agent : <strong>359/98 SUR MPKBY</strong></p>
									</address>
                                    <p style="border:1px solid #000; padding:0px 8px; text-align:center; width:300px;"><strong>NAVYUG COLLEGE PO</strong></p>                                                                        
                                    <p>Date : <strong><?php echo date("d-m-Y", strtotime($model->schedule_date)); ?></strong></p>
								</div>
								<div style="display:table-cell">
									<div class="row">
                                    	<div style="display:table-cell;  width:280px;">
                                            <p>1. Amount of Gross Deposited</p>
                                            <p>2. Amount of Commission Received</p>
                                            <p>3. Net Amount to be Tendered</p>
                                            <p style="text-align:right">T.D.S</p>                                            
                                        </div>
                                        <div style="display:table-cell; width:140px;">
                                            
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->gross_total); ?></p>
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->commision); ?></p>
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->net_amount); ?></p>
                                            <p style="text-align:right"><?php echo sprintf("%.2f",$model->tds); ?></p>                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div style="display:table-cell">
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
                                                <th width="5">Remarks</th>
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
											$count = 15;
											foreach($details as $d){ 
											$row = RdAccounts::find()->where(['account_no' => $d['account_no']])->one();
											?>
                                            <tr>
												<td><?php echo $i; ?></td>
												<td><?php echo Customers::getContact($row['contact_1']); ?></td>
												<td><?php echo $row['deposit_amount']; ?></td>
												<td><?php echo date("d/m/Y", strtotime($d['last_trans_date'])); ?></td>
												<td><?php echo $row['account_no']; ?></td>
												<td><?php echo $row['card_no']; ?></td>
                                                <td><?php echo date("M y", strtotime("01-" .$model['month'] ."-". $model['year'])); ?></td>
												<td><?php echo ($d['balance'] - $row['half_withdrawal']); ?></td>
												<td></td>
											</tr>
											<?php 
											$i++;
											$count--;
											} ?>
                                            <?php for($i = 1; $i < $count; $i++){ ?>
                                            <tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
                                                <td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
                                            <?php } ?>
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
                                    <p>It is Certify that total sum Rs. <strong><?php echo sprintf("%.2f",$model->gross_total); ?></strong> Ruppes <strong><?php echo Schedule::convert_number_to_words($model->gross_total); ?> only</strong> has been Received and Deposited / Creditedas shown above in the PO RD Account Pass Books of the Investor's Cencerned.</p>
                                    <p>Date : <strong><?php echo date("d-m-Y", strtotime($model->schedule_date)); ?></strong></p>
                                    <p style="margin-top:50px;">Stamp of the Post Office <span style="margin-left:50%;">Signature of the Post Master</span></p>
								</div>
							</div>
						</div>
					</div>
       

</div>

</body>
</html>
