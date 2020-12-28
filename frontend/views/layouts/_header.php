<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

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
    $menuItems[] = ['label' => 'Logout(' . YII::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
}

?>

    <form class="form-inline my-2 my-lg-0" action="<?php echo Url::to(['/video/search'])?>">
        <input class="form-control mr-sm-2"
               type="search" placeholder="Search"
               aria-label="Search"
               name="keyword" value="<?php echo Yii::$app->request->get('keyword')?>">
        <button class="btn btn-outline-success my-2 my-sm-0">Search</button>
    </form>

<?php
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => $menuItems,
]);
NavBar::end();