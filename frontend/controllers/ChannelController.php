<?php


namespace frontend\controllers;


use common\models\Subscriber;
use common\models\User;
use yii\web\NotFoundHttpException;

class ChannelController extends \yii\web\Controller
{

    public function actionView($username): string
    {
        $channel = $this->findChannel($username);
        return $this->render('view', ['channel' => $channel]);
    }

    public function actionSubscribe($username)
    {
        $channel = $this->findChannel($username);
        $userId = \Yii::$app->user->id;
        $subscriber = $channel->getSubscriber($userId);

        if (!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->user_id = $userId;
            $subscriber->channel_id = $channel->id;
            $subscriber->created_at = time();
            $subscriber->save();
        } else {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe', ["channel" => $channel]);
    }

    protected function findChannel($username)
    {
        $channel = User::findByUsername($username);
        if (!$channel) {
            throw new NotFoundHttpException();
        }
        return $channel;
    }
}