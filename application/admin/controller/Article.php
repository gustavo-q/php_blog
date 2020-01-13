<?php

namespace app\admin\controller;


class Article extends Base
{
    //文章添加
    public function articleadd()
    {
        if (request()->isAjax()) {
            $data = [
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top', 0),
                'cate_id' => input('post.cateid'),
                'desc' => input('post.desc'),
                'content' => input('post.content')
            ];
            $result = model('Article')->add($data);
            if ($result == 1) {
                $this->success('文章添加成功！', 'admin/article/articlelist');
            }else {
                $this->error($result);
            }

        }

        $cates = model('Cate')->select();
        $viewData = [
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view();
    }

    //文章列表
    public function articlelist()
    {//
//        $where = [];
//        $catename = null;
//        if (input('?cateid')) {
//            $where = [
//                'cateid' => input('cateid')
//            ];
//            $catename = model('Cate')->where('id', input('cateid'))->value('catename');
//        }



        $articles = model('Article')->with('cate')->order(['is_top' => 'asc', 'create_time' => 'desc'])->paginate(10);
        $viewData = [
            'articles' => $articles

        ];
        $this->assign($viewData);
        return view();
    }

    //文章推荐
    public function articletop()
    {
        $data =[
            'id'=>input( 'post.id'),
            'is_top' => input('post.is_top') ? 0:1
        ];
        $result = model('Article')->top($data);


        if ($result == 1) {
            $this->success('操作成功！', 'admin/article/articlelist');
        }else {
            $this->error('操作失败！');
        }
    }


    //文章的编辑
    public function articleedit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'title' => input('post.title'),
                'is_top'=>input('post.is_top'),
                'cate_id' => input('cateid'),
                'tags' => input('post.tags'),
                'desc' => input('post.desc'),
                'content' => input('post.content')
            ];
            $result = model('Article')->edit($data);
            if ($result == 1) {
                $this->success('文章编辑成功！', 'admin/article/articlelist');
            }else {
                $this->error($result);
            }
        }



        $cates = model('Cate')->select();
        $articleInfo = model('Article')->with('cate')->find(input('id'));
        $viewData = [
            'articleInfo' => $articleInfo,
            'cates' => $cates
        ];
        $this->assign($viewData);



        return view();

    }

//    文章删除
    public function articledel()
    {
        $acticleInfo= model('Article')->with('comments')->find(input('id'));
        $result = $acticleInfo->together('comments')->delete();
        if ($result) {
            $this->success('文章删除成功！', 'admin/article/articlelist');
        }else {
            $this->error('删除失败！');
        }
    }
}
