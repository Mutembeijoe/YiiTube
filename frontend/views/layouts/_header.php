<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-light bg-light navbar-expand-lg shadow-sm'
    ]
]);
//$menuItems = [];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    $menuItems[] = ['label' => 'SignUp', 'url' => ['/site/signup']];
} else {
    $menuItems[] = ['label' => 'Logout('.YII::$app->user->identity->username.')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => $menuItems,
]);
NavBar::end();