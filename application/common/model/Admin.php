<?php

namespace app\common\model;

use think\Db;
use think\db\Where;
use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;


//    只读字段
    protected $readonly = ['email'];


    //登录校验
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
        $result = $this->where($data)->find();
        if ($result) {
            if ($result['status'] != 1) {
                return '此用户被禁用';
            }
            $sessionData =[
              'id'=>$result['id'],
              'nickname'=>$result['nickname'],
              'is_super'=>$result['is_super']
            ];
            session('admin',$sessionData);
            return 1;
        } else {
            return '用户密码错误';
        }
    }


//    注册校验
    public function register($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '注册失败';
        }
    }



    //验证码 ，重置密码
//    public function forget($data)
//    {
//
//        $validate = new \app\common\validate\Admin();
//        if (!$validate->scene('forget')->check($data)) {
//            return $validate->getError();
//        }
//        $result= $this->where($data)->find();
//        if($result){
//            return 1;
//        }else{
//            return "邮箱不存在！";
//        }
//
//
//    }

//
    public function codein($data)
    {
        $validate = new  \app\common\validate\Admin();
        if (!$validate->scene('codein')->check($data)) {
            return $validate->getError();
        }
        if ($data['code'] != session('code')) {
            return '验证码不正确';
        } else {
            $adminInfo = $this->where('email', $data['email'])->find();
            $password = mt_rand(10000, 99999);
            $adminInfo->password = $password;
            $result = $adminInfo->save();

            if ($result) {
                $content = '密码重置成功 <br>用户名' . $adminInfo['username'] . '<br>新密码:' . $adminInfo['password'];
                mailto($data['email'], '密码重置成功', $content);
                return 1;
            } else {
                return '重置密码失败';
            }


        }
    }


    public function add($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '管理员添加失败！';
        }
    }


    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $adminInfo = $this->find($data['id']);
        if ($adminInfo['password'] != $data['oldpass']) {
            return '原密码不正确！';
        }
        $adminInfo->password = $data['newpass'];
        $adminInfo->nickname = $data['nickname'];
        $result = $adminInfo->save();
        if ($result) {
            return 1;
        }else {
            return '管理员修改失败！';
        }
    }
}
