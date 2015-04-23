<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MisAccount */

$this->title = 'Create Mis Account';
$this->params['breadcrumbs'][] = ['label' => 'Mis Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mis-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
