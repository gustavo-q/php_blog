<?php

namespace app\admin\controller;

class Member extends Base
{

    public function memberadd()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
            ];
            $result = model('Member')->add($data);
            if ($result == 1) {
                $this->success('添加成功！', 'admin/member/memberlist');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    public function memberlist()
    {

        $members = model('Member')->order( 'create_time' , 'desc')->paginate(10);
        $viewData = [
            'members' => $members
        ];
        $this->assign($viewData);
        return view();
    }


    public function memberstatus()
    {
        $memberInfo = model('Member')->find(input('post.id'));
        $memberInfo->status = input('post.status') ? 0 : 1;
        $result = $memberInfo->save();
        if ($result) {
            $this->success('操作成功！', 'admin/member/memberlist');
        }else {
            $this->error('操作失败！');
        }
    }

    public function memberedit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'oldpass' => input('post.oldpass'),
                'newpass' => input('post.newpass'),
                'nickname' => input('post.nickname'),
                'email' =>input('post.email')
            ];
            $result = model('Member')->edit($data);
            if ($result == 1) {
                $this->success('编辑成功！', 'admin/member/memberlist');
            }else {
                $this->error($result);
            }
        }

        $memberInfo = model('Member')->find(input('id'));
        $viewData = [
            'memberInfo' => $memberInfo
        ];
        $this->assign($viewData);
        return view('memberedit');
    }

    public function memberdel()
    {
        $memberInfo = model('Member')->with('comments')->find(input('post.id'));
        $result = $memberInfo->together('comments')->delete();
        if ($result) {
            $this->success('会员删除成功！', 'admin/member/memberlist');
        }else {
            $this->error('会员删除失败！');
        }
    }
}
