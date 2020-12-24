<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'video_id',
            'title',
            'description:ntext',
            'created_by',
            'created_at',
            //'updated_at',
            //'tags',
            //'status',
            //'has_thumbnail',
            //'video_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
