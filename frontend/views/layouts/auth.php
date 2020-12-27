<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php') ?>
<?php echo $this->render('_header') ?>
<div class="container p-3">
    <?= $content ?>
</div>
<?php $this->endContent() ?>
