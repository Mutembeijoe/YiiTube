<?php
/** @var $channel \common\models\User */
/** @var $this \yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\widgets\ListView;
use yii\widgets\Pjax;

?>

<div class="jumbotron">
    <h1 class="display-4"><?php echo $channel->username ?></h1>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <?php Pjax::begin() ?>
    <?php echo $this->render('_subscribe', ['channel' => $channel]); ?>
    <?php Pjax::end() ?>
</div>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div> {pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]);



