<?php
// +----------------------------------------------------------------------
// | Title   : 
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2019-10-23 10:01
// +----------------------------------------------------------------------
namespace backend\ar;

use Yii;
use backend\models\Auth;

class AuthBackEndAR
{
    private $_auth;

    public function __construct(Auth $auth) {
        $this->_auth = $auth;
    }


}