<?php


namespace frontend\controllers;


use common\models\Video;
use common\models\VideoLikes;
use common\models\VideoView;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['POST'],
                ],
            ],
        ];
    }

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
        $video = $this->findVideo($id);

        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->created_at = time();
        $videoView->user_id = \Yii::$app->user->id;
        $videoView->save();

        return $this->render('view', ['model' => $video]);
    }

    public function actionLike($id): string
    {

        $video = $this->findVideo($id);
        $userId = \Yii::$app->user->id;

        $videoLikeDislike = VideoLikes::find()->userIdVideoId($userId, $id)->one();
        if(!$videoLikeDislike){
            $this->saveVideoLikeDislike($userId, $id,VideoLikes::TYPE_LIKE);
        }else if($videoLikeDislike->type == VideoLikes::TYPE_LIKE){
            $videoLikeDislike->delete();
        }else{
            $videoLikeDislike->delete();
            $this->saveVideoLikeDislike($userId, $id,VideoLikes::TYPE_LIKE);
        }
        return $this->renderAjax('_buttons', ["model" => $video]);
    }

    public function actionDislike($id): string
    {

        $video = $this->findVideo($id);
        $userId = \Yii::$app->user->id;

        $videoLikeDislike = VideoLikes::find()->userIdVideoId($userId, $id)->one();
        if(!$videoLikeDislike){
            $this->saveVideoLikeDislike($userId, $id,VideoLikes::TYPE_DISLIKE);
        }else if($videoLikeDislike->type == VideoLikes::TYPE_DISLIKE){
            $videoLikeDislike->delete();
        }else{
            $videoLikeDislike->delete();
            $this->saveVideoLikeDislike($userId, $id,VideoLikes::TYPE_DISLIKE);
        }
        return $this->renderAjax('_buttons', ["model" => $video]);
    }


    protected function findVideo($id): Video
    {
        $video = Video::findOne($id);

        if (!$video) {
            throw new NotFoundHttpException('Video Not Found');
        }

        return $video;
    }

    protected function saveVideoLikeDislike($userId, $videoId, $type){
        $videoLike = new VideoLikes();
        $videoLike->video_id = $videoId;
        $videoLike->created_at = time();
        $videoLike->user_id =$userId ;
        $videoLike->type = $type;
        $videoLike->save();
    }

}