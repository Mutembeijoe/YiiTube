<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php') ?>
<div class="h-100 d-flex flex-column">
    <?php echo $this->render('_header') ?>
    <main class="d-flex flex-grow-1">
        <aside class="shadow py-1">
            <?php echo $this->render('_sidebar') ?>
        </aside>
        <div class="content-wrapper flex-grow-1 p-3">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
</div>

<?php $this->endContent() ?>
