<?php
/** @var $model \common\models\Video */

use yii\helpers\Url;

?>

<div>
    <a href="<?php echo Url::to(['/video/like', 'id' => $model->video_id]) ?>"
       class="btn btn-outline-primary" data-pjax="1" data-method="POST">
        <i class="fas fa-thumbs-up"></i>
        1000
    </a>

    <a href="<?php echo Url::to(['/video/dislike', 'id' => $model->video_id]) ?>"
       class="btn btn-outline-primary" data-pjax="1" data-method="POST">
        <i class="fas fa-thumbs-down"></i>
        1000
    </a>
</div>

