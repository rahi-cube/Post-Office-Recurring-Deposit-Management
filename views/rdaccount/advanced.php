<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\RdAccounts;
use app\models\Customers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindCollections */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Advanced paid accounts of $month/$year";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collections-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $data,
       // 'filterModel' => $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'account_id',
            [
				"attribute" => 'account_id',
				"header"	=> "Name",
				//"type" => "link"
				"value" => function ($data) {
					return Customers::getContact(RdAccounts::find()->where(['account_no' => $data->account_id])->one()->contact_1); // $data['name'] for array data, e.g. using SqlDataProvider.
				}
			],
			[
				"attribute" => 'month',
				//"type" => "link"
				"value" => function ($data) {
					return date('m/Y', strtotime($data->inst_month)); // $data['name'] for array data, e.g. using SqlDataProvider.
				}
			],
            //'year',
            //'inst_month',
            // 'receive_date',
			[
				"attribute" => 'ispaid',
				"header"  => "Status",
				//"type" => "link"
				"value" => function ($data) {
					return ($data->ispaid == 0) ? "Unpaid" : "Paid"; // $data['name'] for array data, e.g. using SqlDataProvider.
				}
			]
            
            // 'field1',
            // 'field2',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
