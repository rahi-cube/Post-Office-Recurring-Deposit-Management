<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MisAccount */

$this->title = $model->account;
$this->params['breadcrumbs'][] = ['label' => 'Mis Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mis-account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->account], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->account], [
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
            'account',
            'contact_1',
            'contact_2',
            'contact_3',
            'kyc',
            'payment_type',
            'amount',
            'cheque_no',
            'date_taken',            
            'term',
            'start_date:date',
            'end_date:date',
            'status',
            'register_date:date',
			//'field1',
            //'field2',
        ],
    ]) ?>

</div>
