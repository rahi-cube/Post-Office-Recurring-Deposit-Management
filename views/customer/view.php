<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            //'id',
            'name',
            'address',
            'city',
            'contact_no',
            'email:email',
            'date_of_birth:date',
            'date_registered:datetime',
			[
				'attribute'=>'signature',
				'value'=> Yii::$app->homeUrl . "/uploads/".  $model->id . "_" . $model->signature,
				'format' => ['image',['width'=>'100','height'=>'100']],
			]
            //'field1',
            //'field2',
            //'field3',
            //'field4',
            //'field5',
        ],
		
    ]) ?>

</div>
