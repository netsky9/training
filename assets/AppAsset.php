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
        'bootstrap/css/bootstrap.min.css',
        'bootstrap/css/bootstrap-datetimepicker.min.css',
        'css/style.css',
    ];
    public $js = [
      'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js',
      'bootstrap/js/jquery-1.11.1.min.js',
      'bootstrap/js/moment-with-locales.min.js',
      'bootstrap/js/bootstrap.min.js',
      'bootstrap/js/bootstrap-datetimepicker.min.js',
      'js/validation-forms.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
