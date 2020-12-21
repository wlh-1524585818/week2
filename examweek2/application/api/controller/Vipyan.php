<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Validate;

class Vipyan extends Validate
{
    //验证器
    public function vipYan(){
        $validate = new Validate([
           'vipname|用户名'=>'require|unique:vip',
           'vipmail|邮箱'=>'require|email',
           'viptel|电话'=>'require|regex:[1][35789]\d{9}',
        ]);
    }
}
