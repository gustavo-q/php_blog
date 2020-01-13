<?php

namespace app\admin\controller;

use think\Controller;

class Cate extends Base
{
    public function catelist()
    {
        $cates = model('Cate')->order("sort",'asc')->paginate(10);
        $viewData=[
          'cates'=>$cates
        ];
        $this->assign($viewData);

        return view();
    }


    public function cateadd()
    {
        if (request()->isAjax()) {
            $data = [
                'catename' => input('post.catename'),
                'sort' => input('post.sort')
            ];
            $result=model('Cate')->add($data);
            if($result==1){
                $this->success('添加成功！','admin/cate/catelist');
            }else{
                $this->error($result);
            }
        }
        return view();
    }



    public function catesort(){
        $data=[
            'id'=>input('post.id'),
            'sort'=>input('post.sort')
        ];
        $result=model('Cate')->sort($data);
        if($result){
            $this->success('排序成功！','admin/cate/catelist');
        }else{
            $this->error($result);
        }
    }



    public function cateedit(){
        if (request()->isAjax())
        {
            $data=[
                'id'=>input('post.id'),
                'catename'=>input('post.catename')
            ];
            $result =model('Cate') ->edit($data);
            if($result){
                $this->success('栏目编辑成功！','admin/cate/catelist');
            }else{
                $this->error($result);
            }
        }

        //传输数据
      $cateInfo = model('Cate')->find(input('id'));
      //模板变量
        $viewData = [
            'cateInfo' =>$cateInfo
        ];
        $this->assign($viewData);




        return view();
    }



    public function catedel()
    {
        $cateInfo =model('Cate')->with('article,article.comments')->find(input('post.id'));
        foreach ($cateInfo['article'] as $k=>$v){
            $v->together('comments')->delete();
        }
        $result =$cateInfo->together('article')->delete();
        if($result){
            $this->success('栏目删除成功！','admin/cate/catelist');
        }else{
            $this->error("栏目删除失败");
        }
    }

}


