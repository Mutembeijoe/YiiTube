<?php


namespace frontend\controllers;


use common\models\User;
use yii\web\NotFoundHttpException;

class ChannelController extends \yii\web\Controller
{

    public function actionView($username): string
    {
        $channel = User::findByUsername($username);
        if (!$channel) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', ['username' => $username]);
    }
}