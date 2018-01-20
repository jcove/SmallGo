<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view($view='',$data=[]){
        if(request()->ajax() && !empty($view)){
            $view                       =   $view.'_ajax';
            if(!request()->acceptsHtml()){
                return response()->json($data);
            }
        }
        if(is_mobile()){
            return view('mobile.'.$view,$data);
        }else{
            return view($view,$data);
        }
    }
}
