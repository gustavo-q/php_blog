<?php

namespace app\admin\controller;

use think\Console;
use think\Controller;

class Index extends Controller
{

//    登录
    public function login()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->login($data);
            if ($result == 1) {
                $this->success('登陆成功', 'admin/home/index');
            } else {
                $this->error($result);
            }
        }
        if (session('?admin.id'))
        {
            $this->redirect('admin/home/index');
        }
        return view();

    }


//    注册
    public function register()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),

            ];
            $result = model('Admin')->register($data);
            if ($result == 1) {
                //邮箱发送
                mailto($data['email'], '账号注册', '账号注册成功');
                $this->success('注册成功！', 'admin/index/login');

            } else {
                $this->error($result);
            }
        }
        return view();
    }


//    忘记密码 邮箱验证
    public function forget()
    {
        $data = input('email');
        if (request()->isAjax()) {
//            $result = model('Admin')->forget($data);
            $code = mt_rand(1000, 9999);
            session('code', $code);
            $result = mailto($data, '重置密码验证码', '你收到的邮箱验证码<br>' . $code);
            if ($result) {
                $this->success('验证码发送成功！');
            } else {
                $this->error('验证码发送失败~');
            }
        }
        return view();
    }


    public function codein(){
        $data =[
            'email'=>input('email'),
            'code'=>input('code')
        ];
        $result =model('Admin')->codein($data);
        if($result ==1){
            $this->success('验证正确,请去邮箱查看密码','admin/index/login');
        }else{
            $this->error($result);
        }
    }



}

