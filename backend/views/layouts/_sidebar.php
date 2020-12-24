<?php

use yii\bootstrap4\Nav;

?>
<?php echo Nav::widget([
    'items' => [
        [
            'label' => 'Dashboard',
            'url' => ['site/index'],
        ],
        [
            'label' => 'Videos',
            'url' => ['video/index']
        ],
    ],

    'options' => ['class' =>'nav-pills d-flex flex-column'], // set this to nav-tabs to get tab-styled navigation
]);
?>

