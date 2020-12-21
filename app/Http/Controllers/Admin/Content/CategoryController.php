<?php


namespace App\Http\Controllers\Admin\Content;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('permission:category-list|category-edit|category-create|category-delete',['only'=>['index','store']]);
        $this->middleware('permission:category-create',['only'=>['store']]);
        $this->middleware('permission:category-edit',['only'=>['edit','update']]);
        $this->middleware('permission:category-delete',['only'=>['destroy']]);

    }

    public function index(){
//        dump(app()->getLocale());
        $categories = Category::all();
        $pageHeader = 'Categories Index';
        return view('admin.content.category.index',compact('categories','pageHeader'));
    }

    public function create(){
        return view('admin.content.category.create');
    }

    public function store(){
        $this->validate(request(),[
            'name' => 'required'
        ]);

        $category = Category::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'in_menu' => request('in_menu') ? true : false
        ]);

        return redirect()->route('content.category.index')->with('success','Category saved successfully');

    }

    public function show(Category $category){
        $pageHeader = $category->name;
        $article = new Article();
        return view('admin.content.category.show',compact('category','pageHeader','article'));
    }

    public function edit($lang,Category $category){
        return view('admin.content.category.edit',compact('category'));
    }

    public function update(Category $category){

    }

    public function destroy(Category $category){

    }

    public function categoryTranslate(Category $category){
//        dd();
        $category->update([
            request('translate-to-locale') => [
                'name' => request('name'),
                'slug' => Str::slug(request('name'))
            ]
        ]);
        return back()->with('success','Category was translated');
    }

}
