<?php

namespace app\models;

use Yii;

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
            [['lesson_id', 'name'], 'required'],
            [['status'], 'integer'],
            [['ctime'], 'safe'],
            [['lesson_id'], 'string', 'max' => 6],
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
}
