<?php
// +----------------------------------------------------------------------
// | Title   : 用户模型层
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2019-10-23 10:01
// +----------------------------------------------------------------------
namespace backend\ar;

use backend\models\UserBackEnd;
use backend\models\UserLogBackEnd;
use common\tools\GenerateTools;
use Yii;

class UserBackEndAR extends UserBackEnd
{
    /**
     * 添加一个用户
     * @param $data
     * @return bool
     * @throws \yii\base\Exception
     */
    public function addUser($data){
        $data['id'] = GenerateTools::uuid();
        $data['pass_word'] = Yii::$app->security->generatePasswordHash($data['pass_word']);
        $this->attributes = $data;
        return $this->save();
    }

    /**
     * 用户是否有效存在
     * @param $phone 手机号
     * @param $oa_name OA名字
     * @return bool
     */
    public function checkUserExt($phone, $oa_name){
        return $this->find()->where([ 'user_status' => [1,2]])->andWhere('phone=:phone or oa_name=:oa_name',[
            ':phone'   => $phone,
            ':oa_name' => $oa_name
        ])->exists();
    }

    /**
     * 手机号或oa账号查询有效用户
     * @param $phone
     * @param $oa_name
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getUserByPhoneOrOaName($phone, $oa_name)
    {
        return $this->find()->where([ 'user_status' => [1,2]])->andWhere('phone=:phone or oa_name=:oa_name',[
            ':phone'   => $phone,
            ':oa_name' => $oa_name
        ])->asArray()->one();
    }

    /**
     * 更新用户信息
     * @param $data
     */
    public function updateData($data, $user_id){
        if(!$user_id){
            return false;
        }
        return static::updateAll($data, ['id' => $user_id]);
    }

    public function addLoginLog($user_id, $remark, $header){
        $userLogBackEnd = new UserLogBackEnd();
        $userLogBackEnd->attributes([
            'user_id' => $user_id,
            'remark'  => $remark,
            'header'  => json_encode($header,256)
        ]);
        return $userLogBackEnd->save();
    }
}