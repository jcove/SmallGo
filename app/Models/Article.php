<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/12/25
 * Time: 15:10
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function getCoverAttribute($cover){
        if(!empty($cover)){
            return get_image_url($cover);
        }
        return '';
    }
    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public static function getByAuthor($author,$take=10){
        return static ::where('author_id',$author)->take($take)->get();
    }

    public static function comment(Comment $comment){
        $article                        =   static ::where('id',$comment->article_id)->first();
        $article->last_comment_user     =   $comment->author_id;
        $article->comments              =   $article->comments+1;
        $article->updated_at            =   Carbon::now();
        $article->save();
    }
    public function getUpdatedAtColumn() {
        return null;
    }
    public static function getByTitle($title){
        return static ::where('title',$title)->first();
    }
}