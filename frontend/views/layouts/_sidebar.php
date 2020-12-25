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
            'label' => 'History',
            'url' => ['video/history']
        ],
    ],

    'options' => ['class' =>'nav-pills d-flex flex-column'], // set this to nav-tabs to get tab-styled navigation
]);
?>

