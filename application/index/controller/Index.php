<?php
namespace app\index\controller;


class Index extends Base
{
    //首页
    public function index()
    {
        $where=[];
        $catename=null;
        if(input('?id')){
            $where=[
                'cate_id'=>input('id')
            ];
            $catename=model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles =model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewData=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewData);
        return view();
    }

    //注册
    public function login()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
//                'verify' => input('post.verify')
            ];
            $result = model('Member')->login($data);
            if ($result == 1) {
                $this->success('登录成功！','index/index/index');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    public function register()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'email' => input('post.email'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'nickname' => input('post.nickname')
            ];
            $result = model('Member')->register($data);
            if ($result == 1) {
                $this->success('注册成功！','index/index/login');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    public function loginout()
    {
       session(null);
       if (session('?index.id')){
           $this->error('退出失败');
       }else{
           $this->success('退出成功！','index/index/index');
       }

    }

    public function search()
    {
        $where[]=['title','like','%'.input('search').'%'];
        $catename=input('search');
        $articles =model('Article')->where($where)->order('create_time','desc')->paginate(10);
        $viewData= [
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewData);
        return view('index');
    }



}
