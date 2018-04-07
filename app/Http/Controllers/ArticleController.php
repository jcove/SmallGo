<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/12/26
 * Time: 17:55
 */

namespace App\Http\Controllers;


use App\Http\Requests\StoreArticlePost;
use App\Http\Requests\UpdateArticlePut;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function index(){
        $list                               =   Article::where(['status'=>1])->orderBy('created_at','desc')->paginate(16);
        $data['list']                       =   $list;
        return smallgo_view('article.index',$data);
    }
    public function show($article){
        $post                               =   Article::where('id',$article)->firstOrFail();
        $data['post']                       =   $post;
        $data['title']                      =   isset($post->title) ? $post->title : '';
        $list                               =   Comment::where('article_id',$article)->orderBy('created_at','desc')->paginate(10);
        $data['comments']                   =   $list;
        Article::where('id',$article)->increment('view');
        return smallgo_view('article.show',$data);
    }

    public function create(){
        $data['categories']                 =   Category::options();
        $data['title']                      =   '创作文章';
        return view('article.edit',$data);
    }

    public function edit($article){
        $data['categories']                 =   Category::options();
        $data['article']                    =   Article::where(['id'=>$article])->first();
        $data['title']                      =   '编辑文章';
        return view('article.edit',$data);
    }

    public function update(UpdateArticlePut $request){
        $article                            =   Article::where(['id'=>$request->id])->first();
        $article->title                     =   request()->title;
        $article->body                      =   request()->body;
        $article->subject                   =   request()->subject;
        $article->cover                     =   request()->cover;
        $article->category_id               =   $request->category_id;
        $article->updated_at                =   Carbon::now();
        $article->save();
        admin_toastr('保存成功');
        return redirect(route('article.show',['id'=>$article->id]));
    }

    public function store(StoreArticlePost $request){
        $id                                 =   $request->id;
        $article                            =   new Article();
        if($id > 0){
            $article->id                    =   $id;
        }
        $article->title                     =   $request->title;
        $article->body                      =   $request->body;
        $article->subject                   =   $request->subject;
        $article->cover                     =   $request->cover;
        $article->author_id                 =   Auth::id();
        $article->category_id               =   $request->category_id;
        $article->updated_at                =   Carbon::now();
        $article->save();
        admin_toastr('保存成功');
        return redirect(route('article.show',['id'=>$article->id]));
    }
}