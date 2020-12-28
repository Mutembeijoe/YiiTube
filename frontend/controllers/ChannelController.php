<?php


namespace frontend\controllers;


use common\models\Subscriber;
use common\models\User;
use common\models\Video;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ChannelController extends \yii\web\Controller
{

    public function actionView($username): string
    {
        $channel = $this->findChannel($username);
        $dataProvider = new ActiveDataProvider(
            [
                'query' => Video::find()->creator($channel->id)->published(),
            ]
        );
        return $this->render('view', ['channel' => $channel, 'dataProvider' => $dataProvider]);
    }

    public function actionSubscribe($username): string
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

            \Yii::$app->mailer->compose([
                'html' => 'subscriber-html',
                'text' => 'subscriber-text',
            ], [
                'channel' => $channel,
                'user' => \Yii::$app->user->identity,
            ])->setFrom(\Yii::$app->params['senderEmail'])
                ->setTo($channel->email)
                ->setSubject('You have a new subscriber')
                ->send();
        } else {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe', ["channel" => $channel]);
    }

    protected function findChannel($username): User
    {
        $channel = User::findByUsername($username);
        if (!$channel) {
            throw new NotFoundHttpException();
        }
        return $channel;
    }
}