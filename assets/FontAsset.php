<?php
namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:400,700',
        '//fonts.googleapis.com/css?family=Ubuntu:400,700',
        '//fonts.googleapis.com/css?family=Oswald:400,700',
        '//fonts.googleapis.com/css?family=Ruda:400,700',
        '//fonts.googleapis.com/css?family=Marvel:400,700',



    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
