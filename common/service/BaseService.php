<?php
// +----------------------------------------------------------------------
// | Title   : 服务层基础类
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2019-10-23 15:36
// +----------------------------------------------------------------------


namespace common\service;


use common\tools\GenerateTools;

class BaseService
{
    /**
     * 固定返回错误信息
     * @param $code
     * @param $msg
     * @param array $data
     * @return array
     */
    public function error($code = 0, $msg = '成功', $data = []){
        return GenerateTools::error($code, $msg, $data);
    }
}