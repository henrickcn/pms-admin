<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id ID
 * @property string $phone 手机号
 * @property string $oa_name OA账号
 * @property string $pass_word 密码（加密）
 * @property string $pc_session_key PC登录session
 * @property string $app_session_key APP登录session
 * @property string $h5_session_key H5登录session
 * @property string $create_time 创建时间
 * @property string $update_time 最后更新时间
 * @property string $login_ip 最后登录IP
 * @property int $user_status 用户状态：1：有效用户，2：已禁用，3：已删除
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['user_status'], 'integer'],
            [['id'], 'string', 'max' => 36],
            [['phone'], 'string', 'max' => 20],
            [['oa_name', 'pass_word', 'pc_session_key', 'app_session_key', 'h5_session_key'], 'string', 'max' => 100],
            [['login_ip'], 'string', 'max' => 500],
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
            'phone' => 'Phone',
            'oa_name' => 'Oa Name',
            'pass_word' => 'Pass Word',
            'pc_session_key' => 'Pc Session Key',
            'app_session_key' => 'App Session Key',
            'h5_session_key' => 'H5 Session Key',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'login_ip' => 'Login Ip',
            'user_status' => 'User Status',
        ];
    }
}
