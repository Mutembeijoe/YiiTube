<?php
/** @var $channel \common\models\User */
?>

<div>
    <a class="btn <?php echo $channel->getSubscriber(Yii::$app->user->id) ? 'btn-danger' : 'btn-secondary' ?> btn-primary"
       href="<?php echo \yii\helpers\Url::to(['/channel/subscribe', 'username' => $channel->username]) ?>" role="button"
       data-pjax="1" data-method="POST">
        Subscribe <i class="far fa-bell"></i>
    </a>
    <?php echo $channel->getSubscribers()->count()?>
</div>
