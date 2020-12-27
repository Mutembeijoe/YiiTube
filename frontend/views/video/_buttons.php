<?php
/** @var $model \common\models\Video */

use yii\helpers\Url;

?>

<div>
    <a href="<?php echo Url::to(['/video/like', 'id' => $model->video_id]) ?>"
       class="btn <?php echo $model->isLikedBy(YII::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary' ?>"
       data-pjax="1" data-method="POST">
        <i class="fas fa-thumbs-up"></i>
        <?php echo $model->getLikes()->count() ?>
    </a>

    <a href="<?php echo Url::to(['/video/dislike', 'id' => $model->video_id]) ?>"
       class="btn <?php echo $model->isDislikedBy(YII::$app->user->id) ? 'btn-outline-primary' : 'btn-outline-secondary' ?>"
       data-pjax="1" data-method="POST">
        <i class="fas fa-thumbs-down"></i>
        <?php echo $model->getDislikes()->count() ?>
    </a>
</div>

