<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2017/1/4
 * Time: 上午9:56
 */

namespace app\controllers;

use dakashuo\lesson\User;
use mycompany\common\WeiXin;
use yii\rest\Controller;
use Yii;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    public function actionLogin($code)
    {
        $weixin = new WeiXin([
            'appId' => Yii::$app->params['weixin_appid'],
            'appSecret' => Yii::$app->params['weixin_secret'],
        ]);

        if (!$weixinInfo = $weixin->codeToSession($code)) {
            throw new ForbiddenHttpException();
        }

        if (!$token = User::loginByWeixin($weixinInfo['openid'])) {
            throw new ForbiddenHttpException();
        }

        return $token;
    }

    public function actionPayList()
    {

    }
}