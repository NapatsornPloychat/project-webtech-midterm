<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class AdminController extends Controller
{
    //
    public function dashBoard(){
        $tags=Tag::get();
        $data="";
        foreach($tags as $val){
            $data.= "['".$val->name."',     ".$val->posts->count()."],";
        }
        $chartData=$data;
        return view('admin.dashBoard',compact('chartData'));
    }
}
