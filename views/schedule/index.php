<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindSchedule */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'srno',
			[
				"attribute" => 'srno',
				//"type" => "link"
				"value" => function ($data) {
					return $data->srno . "-" . $data->month ."/". $data->year;
				}
			],
            [
				"attribute" => 'schedule_date',
				//"type" => "link"
				"value" => function ($data) {
					return date("d/m/y", strtotime($data->schedule_date));
				}
			],           
			[
				"attribute" => 'gross_total',
				//"type" => "link"
				"value" => function ($data) {
					return $data->gross_total . " Rs.";
				}
			],
			[
				"attribute" => 'commision',
				//"type" => "link"
				"value" => function ($data) {
					return $data->commision . " Rs.";
				}
			], 
            [
				"attribute" => 'net_amount',
				//"type" => "link"
				"value" => function ($data) {
					return $data->net_amount . " Rs.";
				}
			], 
			[
				"attribute" => 'tds',
				//"type" => "link"
				"value" => function ($data) {
					return $data->tds . " Rs.";
				}
			], 
            // 'field1',
            // 'field2',
            // 'field3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
