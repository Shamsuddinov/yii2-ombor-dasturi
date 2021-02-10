<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/normalize.min.css',
        'css/bootstrap.min.css',
        'css/cs-skin-elastic.css',
        'css/style.css',
        'css/sweetalert2.min.css',
        'css/font-awesome.min.css'
    ];
    public $js = [
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/jquery.matchHeight.min.js',
        'js/main.js',
        'js/sweetalert2.min.js',
        'js/MyJs/my.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
