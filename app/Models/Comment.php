<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/12/28
 * Time: 17:27
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public static function children($id){
        return static :: where('comment_id',$id)->all();
    }

    public function replayAuthor()
    {
        return $this->belongsTo('App\User','replay_author_id');
    }
}