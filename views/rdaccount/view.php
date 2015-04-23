<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Customers;

/* @var $this yii\web\View */
/* @var $model app\models\RdAccounts */

$this->title = $model->account_no;
$this->params['breadcrumbs'][] = ['label' => 'Rd Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rd-accounts-view">

    <h1>Account Number : <?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->account_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->account_no], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'account_no',
            [
				"attribute" => 'contact_1',
				//"type" => "link"
				"value" => Customers::find()->where(['id' => $model->contact_1])->one()->name
			],
            [
				"attribute" => 'contact_2',
				//"type" => "link"
				"value" => Customers::find()->where(['id' => $model->contact_2])->one()->name
			],
			[
				"attribute" => 'deposit_amount',
				//"type" => "link"
				"value" =>  $model->deposit_amount ." Rs."
			],
            
            'term',
            'kyc',
            'card_no',
            'start_date:date',
            'end_date:date',
            [
				"attribute" => 'balance_in',
				//"type" => "link"
				"value" =>  $model->balance_in ." Rs."
			],
			[
				"attribute" => 'balance_out',
				//"type" => "link"
				"value" =>  $model->balance_out ." Rs."
			],
			[
				"attribute" => 'half_withdrawal',
				//"type" => "link"
				"value" =>  $model->half_withdrawal ." Rs."
			],
			'date_registered',
            
        ],
    ]) ?>

</div>
