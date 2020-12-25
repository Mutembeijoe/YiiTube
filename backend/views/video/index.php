<?php


use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model common\models\Video */


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

            [
                'attribute' => 'Video',
                'content' => function ($model) {
                    return $this->render('video_display', ['model'=> $model]);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'status',
                'content' => function ($model) {
                    return $model->getStatusAttributeLabels()[$model->status];
                },

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
