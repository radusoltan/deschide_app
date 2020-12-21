<?php


namespace App\Http\Controllers\Admin\Content;


use App\Http\Controllers\Controller;

class ContentController extends Controller
{

    public function index(){
        return redirect()->route('admin.content.category.index',app()->getLocale());
    }

    public function switchLang($lang){


        return redirect()->route('admin.content.category.index',app()->getLocale());

//        dump(request()->segments());

    }

}
