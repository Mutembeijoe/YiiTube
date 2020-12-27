<?php
/** @var $model \common\models\Video */
/** @var $this \yii\web\View */

use yii\widgets\Pjax;

?>

<div class="row">
    <div class="col-md-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" poster="<?php echo $model->getThumbnailLink() ?>"
                   src="<?php echo $model->getVideoLink() ?>"
                   controls
            >
            </video>
        </div>
        <h6 class="mt-3"><?= $model->title ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <div> <?php echo $model->getViews()->count() ?> views
                . <?php echo YII::$app->formatter->asDate($model->created_at) ?></div>
            <?php Pjax::begin() ?>
            <?= $this->render('_buttons', ['model' => $model]); ?>
            <?php Pjax::end() ?>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
