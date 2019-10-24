<?php
// +----------------------------------------------------------------------
// | Title   : 
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2019-10-23 10:26
// +----------------------------------------------------------------------


namespace backend\service;

use common\tools\GenerateTools;
use Yii;
use backend\ar\UserBackEndAR;
use common\service\BaseService;
use yii\helpers\Html;

class UserBackEndService extends BaseService
{
    private $_userBackEndAR;

    public function __construct(UserBackEndAR $userBackEndAR) {
        $this->_userBackEndAR = $userBackEndAR;
    }

    public function edit($data, $conditon=[]){
        if(empty($conditon)){
            $userExt = $this->_userBackEndAR->checkUserExt($data['phone'], $data['oa_name']);
            if($userExt){
                return $this->error(1, '当前手机号或OA用户名已存在');
            }
            if($this->_userBackEndAR->addUser($data)){
                return $this->error(0, '添加成功');
            }
            return $this->error(1, '添加失败');
        }
    }

    public function login($userName, $password, $loginType='pc'){
        $userName = trim(Html::encode($userName));
        $password = trim(Html::encode($password));
        if(!$userName || strlen($password)<6){
            return $this->error(1, '用户名或密码不正确');
        }
        $userInfo = $this->_userBackEndAR->getUserByPhoneOrOaName($userName, $userName);
        if(!$userInfo){
            return $this->error(1, '用户不存在');
        }
        if(!Yii::$app->security->validatePassword($password, $userInfo['pass_word'])){
            return $this->error(1, '用户名或密码错误');
        }
        if($userInfo['user_status'] == 2){
            return $this->error(1, '账号已被禁用，联系管理员');
        }
        $sessoinKey = Yii::$app->security->generateRandomString(6).base64_encode(Yii::$app->security->generatePasswordHash($userInfo['id'].$userInfo['pass_word'])).Yii::$app->security->generateRandomString(6);
        //更新用户登录Session
        $upData = [ 'login_ip' => Yii::$app->request->getUserIP() ];
        $oldSessoinKey = '';
        switch ($loginType){
            case 'pc':
                $upData['pc_session_key'] = $sessoinKey;
                $oldSessoinKey = $userInfo['pc_session_key'];
                break;
        }
        if($oldSessoinKey)
            Yii::$app->redis->hdel(GenerateTools::createRedisKey('user_login_'.$loginType), $oldSessoinKey);
        $upRet = $this->_userBackEndAR->updateData($upData, $userInfo['id']);
        if(!$upRet){
            return $this->error(1, '登录失败，联系管理员');
        }
        $this->_userBackEndAR->addLoginLog($userInfo['id'],'账号：'.$userName.'，登录了系统', Yii::$app->request->getHeaders()->toArray());
        $userInfo = [
            'id' => $userInfo['id'],
            'phone' => $userInfo['phone'],
            'oa_name' => $userInfo['oa_name'],
            'user_agent' => Yii::$app->request->getHeaders()->get('user-agent'),
            'expire_time' => time()+7200
        ];
        Yii::$app->redis->hmset(GenerateTools::createRedisKey('user_login_'.$loginType), $sessoinKey, serialize($userInfo));
        return $this->error(0, '登录成功', [ 'session_key' => $sessoinKey]);
    }


}