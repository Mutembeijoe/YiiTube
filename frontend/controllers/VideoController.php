<?php


namespace frontend\controllers;


use common\models\Video;
use common\models\VideoView;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{

    public function actionIndex(): string
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->published()->latest(),
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id): string
    {
        $this->layout = 'auth';
        $video = Video::findOne($id);

        if (!$video) {
            throw new NotFoundHttpException('Video Not Found');
        }

        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->created_at = time();
        $videoView->user_id = \Yii::$app->user->id;
        $videoView->save();

        return $this->render('view', ['model' => $video]);
    }

}