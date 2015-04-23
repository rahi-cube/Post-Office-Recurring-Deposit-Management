<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindSchedule */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedule Summary';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="schedule-index">
  <h1>
    <?= Html::encode($this->title) ?> <a target="_blank" href="<?php echo Yii::$app->homeUrl; ?>rdaccount/print/<?php echo $month ."00". $year ?>" class="btn btn-sm btn-default pull-right">Print</a>
  </h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <table class="table table-striped table-bordered">
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
