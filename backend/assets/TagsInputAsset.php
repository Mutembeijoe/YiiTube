<?php


namespace backend\assets;


class TagsInputAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot/plugins/tagsInput';
    public $baseUrl = '@web/plugins/tagsInput';
    public $css = [
        'tagsinput.css',
    ];
    public $js = [
        'tagsinput.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}