<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Jesús Federico Franco <j.francomedinilla@gmail.com>
 * @since 2.0
 */
class AppAssetJS extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/slick-master/slick/slick.css',
        'js/slick-master/slick/slick-theme.css',
    ];
    public $js = [
        'js/slick-master/slick/slick.min.js',
        'js/typeahead/jquery.typeahead.js',
        //'js/typeahead/url.js',
        'js/typeahead/bloodhound.js',
        'js/typeahead/search.js',
    ];
    //public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
