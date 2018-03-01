<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17/9/26
 * Time: 下午2:54
 */

namespace App\Models;


use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Overtrue\Pinyin\Pinyin;

class Channel extends Model
{
    use AdminBuilder,ModelTree;
    public static function getAllChannel($parentId = 0) {
        $channels                             =   static ::getChildren($parentId);
        $allCategories                          =   array();
        if (!empty($channels)) {
            foreach ($channels as $key => $channel) {
                $allCategories[$channel->id]   =   $channel;

                $channelChild                  =   static ::getChildren($channel->id);
                if (!empty($channelChild)) {
                    $allCategories[$channel->id]->child = $channelChild;
                }
            }
        }
        return $allCategories;
    }

    public static function getAllChannelId($parentId){
        $channels                             =   static ::where('parent_id' , $parentId)->orderBy('order' ,'asc')->get();
        $allCategories[]                        =   $parentId;
        if (!empty($channels)) {
            foreach ($channels as $key => $channel) {
                $allCategories[]                =   $channel->id;

                $channelChild                  =   static ::getAllChannel($channel->id);
                if (!empty($channelChild)) {
                    foreach ($channelChild as $row){
                        $allCategories[]        = $row;
                    }

                }
            }
        }
        return $allCategories;
    }

    public static function getChildren($parentId=0){
        return static::where(['hidden'=>0,'parent_id' => $parentId])->orderBy('order' ,'asc')->get();
    }

    public static function selectOptions($parentId=0){
        $channels                             =   static::getChildren($parentId);
        $data                                   =   [0=>'无'];
        foreach ($channels as  $channel){
            if(!isset($data[$channel->id])){
                $data[$channel->id]               =   $channel->name;
            }
        }
        return array_unique($data);
    }
    public static function allSelectOptions(){
        $channels                                  =   static::orderBy('order' ,'asc')->get();
        $data                                           =   [0=>'无'];
        foreach ($channels as  $channel){
            if(!isset($data[$channel->id])){
                $data[$channel->id]                    =   $channel->name;
            }
        }

        return ($data);
    }

    public static function info($id){
        return static::where(['id'=>$id])->first();
    }

    public static function getName($id){
        $channel                               =   static::info($id);
        if($channel){
            return $channel->name;
        }
        return '';
    }

    public static function getByName($name){
        return static::where(['name'=>$name])->first();
    }
    public static function getByParentIdAndName($parentId,$name){
        return static::where(['parent_id'=>
            $parentId,'name'=>$name])->first();
    }
    public function getCoverAttribute($cover)
    {
        return get_image_url($cover);
    }
    public function getSeoTitleAttribute($value){
        if(isset($this->attributes['name']) and !empty($this->attributes['name'])){
            $pinyin                              =   new Pinyin();
            $this->attributes['seo_title']       =   $pinyin->permalink($this->attributes['name']);
            return $this->attributes['seo_title'];
        }
        return $value;
    }
}