<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth".
 *
 * @property string $id
 * @property string $name 权限名称
 * @property string $url 链接地址
 * @property string $param 参数
 * @property int $is_login 是否登录
 * @property int $is_sys 是否系统权限（所以登录用户都次权限）
 * @property string $module_name 模块名称（唯一）
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['is_login', 'is_sys'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['id', 'name', 'url', 'param'], 'string', 'max' => 100],
            [['module_name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'param' => 'Param',
            'is_login' => 'Is Login',
            'is_sys' => 'Is Sys',
            'module_name' => 'Module Name',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
