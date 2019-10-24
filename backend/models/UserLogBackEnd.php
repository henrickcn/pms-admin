<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property string $user_id
 * @property string $remark 日志内容
 * @property string $create_time 登录时间
 * @property string $device 设备类型
 * @property string $header header头信息
 */
class UserLogBackEnd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['header'], 'string'],
            [['user_id'], 'string', 'max' => 36],
            [['remark'], 'string', 'max' => 1000],
            [['device'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'remark' => 'Remark',
            'create_time' => 'Create Time',
            'device' => 'Device',
            'header' => 'Header',
        ];
    }
}
