<?php
/** @var $model \common\models\Video */
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
        <div class="d-flex justify-content-between">
            <div> 10000 views . <?php echo YII::$app->formatter->asDate($model->created_at) ?></div>
            <div>
                <button class="btn btn-outline-primary"><i class="fas fa-thumbs-up"></i> 1000</button>
                <button class="btn btn-outline-secondary"><i class="fas fa-thumbs-down"></i>40</button>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
