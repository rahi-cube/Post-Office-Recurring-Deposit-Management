<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RdAccounts */

$this->title = 'Create  Account';
$this->params['breadcrumbs'][] = ['label' => 'Rd Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rd-accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
