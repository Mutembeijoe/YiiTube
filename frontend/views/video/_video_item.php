<?php
/** @var $model \common\models\Video */

use yii\helpers\Url;

?>
<div class="card m-2" style="width: 18rem;">
    <a href="<?php echo Url::to(['/video/view/', 'id' => $model->video_id]) ?>">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="embed-responsive-item" poster="<?php echo $model->getThumbnailLink() ?>"
                   src="<?php echo $model->getVideoLink() ?>"
            >
            </video>
        </div>
    </a>
    <div class="card-body p-2">
        <h6 class="card-title m-0"><?= $model->title ?></h6>
        <p class="card-text text-muted m-0"><?= $model->createdBy->username ?></p>
        <p class="card-text text-muted m-0"><?= $model->getViews()->count(). ' views . ' . Yii::$app->formatter->asRelativeTime($model->created_at) ?></p>
    </div>
</div>