<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MisAccount */

$this->title = 'Update Mis Account: ' . ' ' . $model->account;
$this->params['breadcrumbs'][] = ['label' => 'Mis Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account, 'url' => ['view', 'id' => $model->account]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mis-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
