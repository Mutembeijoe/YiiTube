<?php
/** @var $model \common\models\Video */
?>
<div class="card m-2" style="width: 18rem;">
    <div class="embed-responsive embed-responsive-16by9">
        <video class="embed-responsive-item" poster="<?php echo $model->getThumbnailLink() ?>"
               src="<?php echo $model->getVideoLink() ?>"
        >
        </video>
    </div>
    <div class="card-body p-2">
        <h6 class="card-title m-0"><?= $model->title?></h6>
        <p class="card-text text-muted m-0"><?= $model->createdBy->username?></p>
        <p class="card-text text-muted m-0"><?= '1000 views . ' . Yii::$app->formatter->asRelativeTime($model->created_at)?></p>
    </div>
</div>