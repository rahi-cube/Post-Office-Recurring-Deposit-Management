<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Customers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindRdAccounts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rd Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rd-accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rd Accounts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'account_no',
             [
				"attribute" => 'contact_1',
				//"type" => "link"
				"value" => function ($data) {
					return Customers::find()->where(['id' => $data->contact_1])->one()->name; // $data['name'] for array data, e.g. using SqlDataProvider.
				}
				
				
			],
             [
				"attribute" => 'contact_2',
				//"type" => "link"
				"value" => function ($data) {
					return Customers::find()->where(['id' => $data->contact_2])->one()->name; // $data['name'] for array data, e.g. using SqlDataProvider.
				}
			],
			[
				"attribute" => 'deposit_amount',
				//"type" => "link"
				"value" => function ($data) {
					return $data->deposit_amount . " Rs.";
				}
			],
			
			[
				"attribute" => 'term',
				//"type" => "link"
				"value" => function ($data) {
					return $data->term . " Years";
				}
			],
            //'term',
            // 'kyc',
            // 'card_no',
            // 'start_date',
            // 'end_date',
            // 'balance_in',
            // 'balance_out',
            // 'half_withdrawal',
            // 'last_trans_date',
            // 'date_registered',
            // 'field1',
            // 'field2',
            // 'filed3',
            // 'filed4',
            // 'filed5',

             ['class' =>    'yii\grid\ActionColumn',

                            'template'=>'{collections} {view} {update}',
                               'buttons'=>[
                              'collections' => function ($id) {
                                return Html::a('<span class="glyphicon glyphicon-plus"></span>',$id, [ 'title' => Yii::t('yii', 'Create')]);

                              }
                          ]
                            ],
        ],
    ]); ?>

</div>
