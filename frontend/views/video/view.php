<?php
/** @var $model \common\models\Video */
/** @var $similarVideos \common\models\Video[] */

/** @var $this \yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
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
                <a href="<?php echo Url::to(['video/view', 'id' => $similarVideo->video_id]) ?>">
                    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width: 150px">
                        <video class="embed-responsive-item" poster="<?php echo $similarVideo->getThumbnailLink() ?>"
                               src="<?php echo $similarVideo->getVideoLink() ?>"
                        >
                        </video>
                    </div>
                </a>

                <div class="media-body">
                    <h6 class="my-0 "><?= $similarVideo->title ?></h6>
                    <div class="text-muted">
                        <div class="m-0"><?php echo \common\helpers\Html::channelLink($similarVideo->createdBy->username) ?></div>
                        <small class="m-0"> <?php echo $similarVideo->getViews()->count() . ' 🔸 ' . Yii::$app->formatter->asRelativeTime($similarVideo->created_at) ?> </small>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
