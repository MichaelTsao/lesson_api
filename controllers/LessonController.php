<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/12/8
 * Time: 下午9:58
 */

namespace app\controllers;

use dakashuo\lesson\Lesson;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class LessonController extends ActiveController
{
    public $modelClass = 'dakashuo\lesson\Lesson';

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