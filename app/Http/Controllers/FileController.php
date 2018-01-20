<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/27
 * Time: 下午5:58
 */

namespace App\Http\Controllers;


use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class FileController extends Controller
{
    /**
     * Storage instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */


    public function uploadPicture(Request $request){
        if ($request->hasFile('file')) {

            if($request->file('file')->isValid()){
                $md5                            =   md5_file($request->file('file'));
                $uploadFile                     =   $request->file('file');
                $fileModel                      =   new File();
                $file                           =   $fileModel->getByMd5($md5);
                if($file){
                    return $file;
                }else{
                    $path = $request->file->store('images');
                    $file                           =   new File();
                    $file->original_name            =   $request->file->getClientOriginalName();
                    $file->path                     =   $path;
                    $file->ext                      =   $request->file->getClientOriginalExtension();
                    $file->name                     =   $request->file->hashName();
                    $file->md5                      =   $md5;
                    $file->save();
                    return $file;
                }

            }else{
                return "file error";
            }
        }else{
            return "file not exits";
        }
    }

}