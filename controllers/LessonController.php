<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/12/8
 * Time: 下午9:58
 */

namespace app\controllers;

use yii\rest\ActiveController;

class LessonController extends ActiveController
{
    public $modelClass = 'app\models\Lesson';
}