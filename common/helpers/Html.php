<?php


namespace common\helpers;


use yii\helpers\Url;

class Html
{
    public static function channelLink($username, $schema=false)
    {
        return \yii\helpers\Html::a($username,
            Url::to(['/channel/view', 'username' => $username], $schema),
            ['class' => 'text-dark']);
    }

}