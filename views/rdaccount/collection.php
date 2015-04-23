<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Customers;

/* @var $this yii\web\View */
/* @var $model app\models\RdAccounts */

$this->title = "View Collections";
$this->params['breadcrumbs'][] = ['label' => 'RD Account', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
.highlighted {
	background-color: #FFC;
}
tbody tr:hover {
	background-color: #FFC !important;
}
#nn {
	background-color: #1a6ecc
}
#nn th {
	border: 1px solid #1a6ecc;
	color: #fff;
	text-align: center;
}
.tile {
	margin-bottom: 15px;
	border-radius: 3px;
	background-color: #1A6ECC;
	color: #FFFFFF;
	transition: all 1s;
}
.tile:hover {
	opacity: 0.95;
}
.tile a {
	color: #FFFFFF;
}
.tile-heading {
	padding: 5px 8px;
	text-transform: uppercase;
	background-color: #0957AF;
	color: #FFF;
}
.tile .tile-heading .pull-right {
	transition: all 1s;
	opacity: 0.7;
}
.tile:hover .tile-heading .pull-right {
	opacity: 1;
}
.tile-body {
	padding: 15px;
	color: #FFFFFF;
	line-height: 48px;
	height: 80px;
}
.tile .tile-body h2 {
	font-size: 42px;
	margin: 0px;
	text-align: center;
}
.tile-footer {
	padding: 5px 8px;
	background-color: #3E84D2;
}
</style>
<div class="rd-accounts-view">
  <h1>
    <?= Html::encode($this->title) ?>
    <a href="<?php echo Yii::$app->homeUrl; ?>collections/create" class="btn btn-sm btn-default pull-right">Add Collection</a>
  </h1>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6">
      <div class="tile">
        <div class="tile-heading">Account Number</div>
        <div class="tile-body"><i class="fa fa-shopping-cart"></i>
          <h2 ><?php echo $rdaccount->account_no; ?></h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
      <div class="tile">
        <div class="tile-heading">Balance</div>
        <div class="tile-body"><i class="fa fa-credit-card"></i>
          <h2 ><?php echo $rdaccount->balance_in; ?></h2>
        </div>
        
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
      <div class="tile">
        <div class="tile-heading">Important Dates</div>
        <div class="tile-body">
          <h2 style="font-size:18px; line-height:25px;"><?php echo date("m F Y", strtotime($rdaccount->start_date)); ?> <br /> <?php echo date("m F Y", strtotime($rdaccount->end_date)); ?></h2>
        </div>
        
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
      <div class="tile">
        <div class="tile-heading">Owners</div>
        <div class="tile-body"><i class="fa fa-eye"></i>
          <h2 style="font-size:18px; line-height:25px;"><?php echo Customers::getContact($rdaccount->contact_1); ?><br /><?php echo Customers::getContact($rdaccount->contact_2); ?></h2>
        </div>
        
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered">
    <thead>
      <tr id="nn">
        <th></th>
        <th>Jan</th>
        <th>Fab</th>
        <th>Mar</th>
        <th>Apr</th>
        <th>May</th>
        <th>Jun</th>
        <th>Jul</th>
        <th>Aug</th>
        <th>Sep</th>
        <th>Oct</th>
        <th>Nov</th>
        <th>Dec</th>
      </tr>
    </thead>
    <tbody>
      <?php 
		  $last = "";
		  $values = array();
		  foreach($collections as $c){ 	
		  
		  
		  
		  $value['date']   = $c['inst_month'];
		  $value['ispaid'] = $c['ispaid'];
		  $value['paidon'] = date("d/m/Y", strtotime($c['receive_date']));
		  
		  $values[] = $value;
		  	  
		  $year = $c['year'];
		  $v = false;
		  if($last == "" || $last != $year)
		  {
			  $last = $year;
			  $v = true;
		  }
		  if($v){
		  ?>
      <tr>
        <th><?php echo $year; ?></th>
        <td id="<?php echo $year; ?>-01-01"></th>
        <td id="<?php echo $year; ?>-02-01"></th>
        <td id="<?php echo $year; ?>-03-01"></th>
        <td id="<?php echo $year; ?>-04-01"></th>
        <td id="<?php echo $year; ?>-05-01"></th>
        <td id="<?php echo $year; ?>-06-01"></th>
        <td id="<?php echo $year; ?>-07-01"></th>
        <td id="<?php echo $year; ?>-08-01"></th>
        <td id="<?php echo $year; ?>-09-01"></th>
        <td id="<?php echo $year; ?>-10-01"></th>
        <td id="<?php echo $year; ?>-11-01"></th>
        <td id="<?php echo $year; ?>-12-01"></th>
      </tr>
      <?php 
		  }
		  } ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
<?php 
echo "var Collections = '" . json_encode($values) . "'"; 
?> 
Collections = JSON.parse(Collections);
for(var i = 0; i < Collections.length; i++)
{
	
	if(Collections[i].paidon == "01/01/1970"){
		Collections[i].paidon = "____ __ __";
		document.getElementById(Collections[i].date).innerHTML = Collections[i].paidon ;
		document.getElementById(Collections[i].date).bgColor = "";
	}
	else
	{
		document.getElementById(Collections[i].date).innerHTML = Collections[i].paidon ;
		document.getElementById(Collections[i].date).bgColor = "#99FF99";
		document.getElementById(Collections[i].date).style.border  = "1px solid #99FF99";
	}
	
}


</script> 
