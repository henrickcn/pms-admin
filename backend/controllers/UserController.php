<?php
// +----------------------------------------------------------------------
// | Title   : 用户管理
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2019-10-22 18:10
// +----------------------------------------------------------------------


namespace backend\controllers;



use backend\service\UserBackEndService;
use common\service\UserComService;

class UserController extends AuthController
{
    private $_userBackEndService;

    public function __construct($id, $module, $config = [], UserComService $userComService, UserBackEndService $userBackEndService) {
        $this->_userBackEndService = $userBackEndService;
        parent::__construct($id, $module, $config, $userComService);
    }

    /**
     * @title 用户登录
     */
    public function actionLogin(){
        if(!\Yii::$app->request->isPost){
            //return $this->asJson(GenerateTools::error(1,'非法访问'));
        }
        $userName = \Yii::$app->request->post('user_name');
        $passWord = \Yii::$app->request->post('pass_word');
        return $this->asJson($this->_userBackEndService->login('18566236830', 'Abc123456'));
    }

    public function actionRegister(){
        $data = [
            'phone'     => '18566236830',
            'oa_name'   => 'johny',
            'pass_word' => 'Abc123456',
            'user_status' => 1
        ];
        $data = $this->_userBackEndService->edit($data);
        return $this->asJson($data);
    }
}