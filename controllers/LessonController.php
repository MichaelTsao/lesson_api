<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/12/8
 * Time: 下午9:58
 */

namespace app\controllers;

use app\models\Lesson;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class LessonController extends ActiveController
{
    public $modelClass = 'app\models\Lesson';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::className(),
//        ];

        $access =  [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'except' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];

        return ArrayHelper::merge($behaviors, $access);
    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'index'];

        return $actions;
    }

    public function index()
    {
        return new ActiveDataProvider([
            'query' => Lesson::find()->where(['status' => Lesson::STATUS_NORMAL])->orderBy(['ctime' => SORT_DESC]),
        ]);
    }
}