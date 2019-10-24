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
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    private $_userComService;

    public function __construct($id, $module, $config = [], UserComService $userComService) {
        $this->_userComService = $userComService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    //'Origin' => ['http://localhost:1024'],
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                ],
            ],
        ], parent::behaviors());
    }
}