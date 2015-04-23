<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RdAccounts */

$this->title = 'Update Rd Accounts: ' . ' ' . $model->account_no;
$this->params['breadcrumbs'][] = ['label' => 'Rd Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account_no, 'url' => ['view', 'id' => $model->account_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rd-accounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
