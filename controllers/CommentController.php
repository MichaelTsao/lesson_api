<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 2016/12/8
 * Time: 下午9:58
 */

namespace app\controllers;

use dakashuo\lesson\Chapter;
use dakashuo\lesson\Comment;
use dakashuo\lesson\LessonUser;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use Yii;
use yii\web\ForbiddenHttpException;

class CommentController extends ActiveController
{
    const SORT_ASC = 1;
    const SORT_DESC = 2;

    public $modelClass = 'dakashuo\lesson\Comment';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'optional' => ['create', 'list'],
        ];

        return $behaviors;
    }

    public function actionList($id, $sort = self::SORT_DESC)
    {
        $list = Comment::find()->where([
            'chapter_id' => $id,
            'status' => Comment::STATUS_PASS,
            'is_shield' => Comment::NO_SHIELD
        ]);

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
        if ($action == 'create') {
            if (isset($model->chapter)
                && $model->chapter->is_free == Chapter::IS_FREE_NO
                && !LessonUser::check($model->chapter->lesson_id)
            ) {
                throw new ForbiddenHttpException();
            }
        }
    }
}