<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/modules/admin';
    public $baseUrl = '@web/modules/admin/web';
    public $css = [
        'bootstrap/css/bootstrap.min.css',
        'bootstrap/css/bootstrap-datetimepicker.min.css',

        'css/bootstrap.min.css',

        'css/animate.min.css',
        'css/light-bootstrap-dashboard.css',

        'css/demo.css',

        'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,700,300',
        'css/pe-icon-7-stroke.css',
    ];
    public $js = [
      'bootstrap/js/jquery-1.11.1.min.js',
      'bootstrap/js/moment-with-locales.min.js',
      'bootstrap/js/bootstrap.min.js',
      'bootstrap/js/bootstrap-datetimepicker.min.js',

      //'js/jquery-1.10.2.js',
      //'js/bootstrap.min.js',
      //'js/bootstrap-checkbox-radio-switch.js',
      //'js/chartist.min.js',
      'js/bootstrap-notify.js',
      'https://maps.googleapis.com/maps/api/js?sensor=false',
      
      'js/light-bootstrap-dashboard.js',
     
      //'js/demo.js',

      
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
