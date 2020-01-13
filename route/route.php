<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];


//前台路由
Route::rule('comment','index/article/comm','post');
Route::rule('search','index/index/search','get');
Route::rule('loginout','index/index/loginout','post');
Route::rule('login','index/index/login','get|post');
Route::rule('register','index/index/register','get|post');
Route::rule('article-<id>', 'index/article/info', 'get');
Route::rule('cate/:id','index/index/index','get');
Route::rule('/', 'index/index/index','get');


//后台路由
Route::group('admin', function (){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('codein','admin/index/codein','post');
    Route::rule('index','admin/home/index','get');
    Route::rule('loginout','admin/home/loginout','post');
    Route::rule('catelist','admin/cate/catelist','get');
    Route::rule('cateadd','admin/cate/cateadd','get|post');
    Route::rule('catesort','admin/cate/catesort','post');
    Route::rule('cateedit/:id','admin/cate/cateedit','get|post');
    Route::rule('cateedit','admin/cate/catedel','post');
    Route::rule('articleadd','admin/article/articleadd','get|post');
    Route::rule('articlelist','admin/article/articlelist','get|post');
    Route::rule('articletop','admin/article/articletop','post');
    Route::rule('articleedit/:id','admin/article/articleedit','get|post');
    Route::rule('articledel','admin/article/articledel','post');
    Route::rule('memberadd','admin/member/memberadd','get|post');
    Route::rule('memberlist','admin/member/memberlist','get');
    Route::rule('memberedit/:id','admin/member/memberedit','get|post');
    Route::rule('memberdel','admin/member/memberdel','post');
    Route::rule('adminlist','admin/admin/adminlist','get');
    Route::rule('adminadd','admin/admin/adminadd','get|post');
    Route::rule('adminedit/:id','admin/admin/adminedit','get|post');
    Route::rule('admindel','admin/member/admindel','post');
    Route::rule('commentlist','admin/comment/commentlist','get');
    Route::rule('commentdel','admin/comment/commentdel','post');
    Route::rule('set','admin/system/set','get|post');


});