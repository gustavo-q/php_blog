<?php


namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username|管理员账户' => 'require',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'nickname|昵称' => 'require',
        'oldpass|原密码'=>'require',
        'newpass|新密码' =>'require',
        'email|邮箱' => 'require|email|unique:admin',
        'code|验证码'  => 'require',
    ];

    //登录验证场景
    public function sceneLogin()
    {
        return $this->only(['username', 'password']);
    }


    //注册验证场景
    public function sceneRegister()
    {
        return $this->only(['username','password','conpass','nickname','email'])
            ->append('username','unique:admin');
    }



//    获取验证码，重置密码
//    public function sceneForget()
//    {
//        return $this->only(['email']);
//    }



    public function sceneCodein()
    {
        return $this->only(['code']);
    }

    public function sceneAdd()
    {
        return $this->only(['username', 'password', 'conpass', 'nickname','email'])
            ->append('username', 'unique:admin');
    }

    public function sceneEdit()
    {
        return $this->only(['oldpass', 'newpass', 'nickname']);
    }

}