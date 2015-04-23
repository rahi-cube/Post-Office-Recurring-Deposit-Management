<?php


use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindSchedule */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedule Summary of '. $month . "/" . $year	;
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
*{
	font-size:99%;
}
*
{
	font-family:Arial, Helvetica, sans-serif;
}
@page 
{
    size: auto;   /* auto is the initial value */
    margin: 0mm;  /* this affects the margin in the printer settings */
}
</style>
<div class="schedule-index" style="margin: 20px 20px;">
  <h1>
    <?= Html::encode($this->title) ?>
  </h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <table class="table table-striped table-bordered" >
    <thead>
      <tr>
        <th>Srno</th>
        <th>Schedule Date</th>
        <th>Gross Total</th>
        <th>Commision</th>
        <th>Net Amount</th>
        <th>TDS</th>
      </tr>
    </thead>
    <tbody>
      <?php 
	  $gross_total 	= 0;
	  $commision 	= 0;
	  $net_amount	= 0;
	  $tds			= 0;
	  foreach($collections as $data){ 
	  
	  $gross_total 	= $gross_total + $data["gross_total"];
	  $commision 	= $commision   + $data["commision"];
	  $net_amount	= $net_amount  + $data["net_amount"];
	  $tds			= $tds		   + $data["tds"];
	  
	  ?>
      <tr>
        <td><?php echo $data['srno'] . "-" . $data["month"] ."/". $data["year"]; ?></td>
        <td class=""><?php echo date("d/m/y", strtotime($data["schedule_date"])) ?></td>
        <td class=""><?php echo sprintf("%.2f",$data["gross_total"]) . " Rs.";?></td>
        <td class=""><?php echo sprintf("%.2f",$data["commision"]) . " Rs."; ?></td>
        <td><?php echo sprintf("%.2f",$data["net_amount"]) . " Rs."; ?></td>
        <td><?php echo sprintf("%.2f",$data["tds"]) . " Rs"; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php foreach($collections as $data){ ?>
      <tr>
        <td colspan="2" align="right"><strong>Total : </strong></td>
       
        <td class=""><strong><?php echo sprintf("%.2f",$data["gross_total"]) . " Rs.";?></strong></td>
        <td class=""><strong><?php echo sprintf("%.2f",$data["commision"]) . " Rs."; ?></strong></td>
        <td><strong><?php echo sprintf("%.2f",$data["net_amount"]) . " Rs."; ?></strong></td>
        <td><strong><?php echo sprintf("%.2f",$data["tds"]) . " Rs"; ?></strong></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
  			
</div>
</body>
</html>
