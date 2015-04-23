<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindMisAccount */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mis-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mis Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'account',
            'contact_1',
            //'contact_2',
            //'contact_3',
            'kyc',
            'payment_type',
            'amount',
            // 'cheque_no',
            // 'date_taken',
            // 'register_date',
            // 'term',
            // 'start_date',
            // 'end_date',
            // 'status',
            // 'field1',
            // 'field2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
