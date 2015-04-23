<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Post Payment',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
			if(Yii::$app->user->isGuest)
			{
				echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => 	[
				        		['label' => 'Login', 'url' => ['/login']],						
                			],
            	]);
			}
            else
			{
				echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => 	[
				        		//['label' => 'Agents', 'url' => ['/site/index']],
								['label' => 'Customers', 'url' => ['/customer']],
								[
									'label' => 'Recurring Deposits', 
									'items' => [
										 ['label' => 'Accounts', 'url' => ['/rdaccount']],
										 ['label' => 'New Accounts', 'url' => ['/rdaccount/create']],
										 ['label' => 'Collection', 'url' => ['/collections/create']],
										 ['label' => 'Schedules', 'url' => ['/schedule']],
										 [	
										 	'label' => 'Reports', 'url' => ['rdaccount/report']
										 ],
									],								
								],
								['label' => 'MIS Account', 'url' => ['/site/working']],
								['label' => 'KVP Account', 'url' => ['/site/working']],
								['label' => 'NSC Account', 'url' => ['/site/working']],
								['label' => 'TD Account', 'url' => ['/site/working']],
								['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                           			'url' => ['site/logout'],
                            		'linkOptions' => ['data-method' => 'post']],			
                				],
            	]);
			}
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="row">
            	
                <div class="col-md-12">
                <?= $content ?>
                </div>
            </div>
            
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Post Payment <?= date('Y') ?></p>
            <p class="pull-right"><a href="http://www.leecorn.com" target="_blank">Leecorn Incorporation</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
