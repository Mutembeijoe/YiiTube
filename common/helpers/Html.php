<?php


namespace common\helpers;


class Html
{
    public static function channelLink($username)
    {
        return \yii\helpers\Html::a($username, ['/channel/view', 'username' => $username]);
    }

}