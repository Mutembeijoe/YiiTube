<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php') ?>
<div class="container p-3">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endContent() ?>
