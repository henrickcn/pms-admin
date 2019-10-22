<?php
// +----------------------------------------------------------------------
// | Title   : 权限认证公共类
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2019-10-22 18:36
// +----------------------------------------------------------------------


namespace backend\controllers;


use common\service\UserComService;
use yii\web\Controller;

class AuthController extends Controller
{
    private $_userComService;

    public function __construct($id, $module, $config = [], UserComService $userComService) {
        $this->_userComService = $userComService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return parent::behaviors(); // TODO: Change the autogenerated stub
    }
}