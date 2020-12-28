<?php
/** @var $model \common\models\Video */
/** @var $similarVideos \common\models\Video[] */

/** @var $this \yii\web\View */

use yii\helpers\Html;
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
        <div>
            <?php echo \common\helpers\Html::channelLink($model->createdBy->username) ?>
            <p class="mt-2"> <?php echo Html::encode($model->description) ?> </p>
        </div>
    </div>
    <div class="col-md-4">
        <?php foreach ($similarVideos as $similarVideo): ?>
            <div class="media mb-3">
                <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 120px">
                    <video class="embed-responsive-item" poster="<?php echo $similarVideo->getThumbnailLink() ?>"
                           src="<?php echo $similarVideo->getVideoLink() ?>"
                    >
                    </video>
                </div>
                <div class="media-body">
                    <h6 class="mt-0"><?= $similarVideo->title ?></h6>
                    <div class="text-muted">
                        <p class="mt-0"> <?php echo \common\helpers\Html::channelLink($similarVideo->createdBy->username)  . ' 🔸 '. Yii::$app->formatter->asRelativeTime($similarVideo->created_at) ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
