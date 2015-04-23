<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/site.css',
        'web/css/btheme.css',
		'web/css/datepicker.css',
		'web/css/chosen.css'
    ];
    public $js = [
		'web/js/bootstrap-datepicker.js',
		'web/js/chosen.jquery.min.js',
		'web/js/jquery.sieve.min.js',
		'web/js/xepOnline.jqPlugin.js',
		'web/js/custom.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
