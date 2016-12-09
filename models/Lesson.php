<?php

namespace app\models;

use mycompany\common\Logic;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lesson".
 *
 * @property string $lesson_id
 * @property string $name
 * @property integer $status
 * @property string $ctime
 */
class Lesson extends \yii\db\ActiveRecord
{
    const STATUS_NORMAL = 1;
    const STATUS_CLOSED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['ctime'], 'safe'],
            [['lesson_id'], 'string', 'max' => 12],
            [['name'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lesson_id' => '课程ID',
            'name' => '名字',
            'status' => '状态',
            'ctime' => '创建时间',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'lesson_id',
                ],
                'value' => Logic::makeID(),
            ],
        ];
    }

    public function fields()
    {
        return [
            'lesson_id',
            'name',
        ];
    }
}
