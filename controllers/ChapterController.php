<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/12/8
 * Time: 下午9:58
 */

namespace app\controllers;

use dakashuo\lesson\Chapter;
use dakashuo\lesson\LessonUser;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use Yii;
use yii\web\ForbiddenHttpException;

class ChapterController extends ActiveController
{
    const SORT_ASC = 1;
    const SORT_DESC = 2;

    public $modelClass = 'dakashuo\lesson\Chapter';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'optional' => ['view', 'list'],
        ];

        return $behaviors;
    }

    public function actionList($id, $sort = self::SORT_DESC)
    {
        $list = Chapter::find()->where(['lesson_id' => $id, 'status' => Chapter::STATUS_ONLINE]);

        if (Yii::$app->user->isGuest || !LessonUser::check($id)) {
            $list->andWhere(['is_free' => Chapter::IS_FREE_YES]);
        }

        if ($sort == self::SORT_ASC) {
            $sort = SORT_ASC;
        } else {
            $sort = SORT_DESC;
        }
        $list->orderBy(['ctime' => $sort]);

        return $list->all();
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action == 'view') {
            if ($model->is_free == Chapter::IS_FREE_NO && !LessonUser::check($model->lesson_id)) {
                throw new ForbiddenHttpException();
            }
        }
    }
}