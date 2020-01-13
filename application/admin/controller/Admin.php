<?php

namespace app\admin\controller;

class Admin extends Base
{
    public function adminlist()
    {

        $admins = model('Admin')->order(['is_super'=>'asc', 'status'=>'asc'])->paginate(10);
        $viewData = [
            'admins' => $admins
        ];
        $this->assign($viewData);
        return view();
    }

    public function adminstatus()
    {
        $data = [
            'id' => input('post.id'),
            'status' => input('post.status') ? 0 : 1
        ];
        $result = model('Admin')->isUpdate(true)->save($data);
        if ($result) {
            $this->success('操作成功！', 'admin/admin/adminlist');
        }else {
            $this->error('操作失败！');
        }
    }

    public function adminadd()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'nickname' => input('post.username'),
                'email' =>input('post.email')
            ];
            $result = model('Admin')->add($data);
            if ($result == 1) {
                $this->success('添加成功！', 'admin/admin/adminlist');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    public function adminedit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'oldpass' => input('post.oldpass'),
                'newpass' => input('post.newpass'),
                'nickname' => input('post.nickname'),
            ];
            $result = model('Admin')->edit($data);
            if ($result == 1) {
                $this->success('修改成功！', 'admin/admin/adminlist');
            }else {
                $this->error($result);
            }
        }
        $adminInfo = model('Admin')->find(input('id'));
        $viewData = [
            'adminInfo' => $adminInfo
        ];
        $this->assign($viewData);
        return view();
    }

    public function admindel()
    {
        $adminInfo = model('Admin')->find(input('post.id'));
        $result = $adminInfo->delete();
        if ($result) {
            $this->success('删除成功！', 'admin/admin/adminlist');
        }else {
            $this->error('删除失败！');
        }
    }
}
