<?php


namespace App\Http\Controllers\Admin\Content;


use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleController
{

    public function index(){
        $articles = Article::all();
        return view('admin.content.article.index',compact('articles'));
    }

    public function show(Article $article){
        return view('admin.content.article.show',compact('article'));
    }

    public function create(){
        $pageHeader = 'New Article';
        return view('admin.content.article.create',compact('pageHeader'));
    }

    public function store(Category $category){
        $data = request()->validate([
            'title' => 'required|min:10|max:150',
            'type' => 'required',
        ]);

        $article = Article::create([
            'title' => $data['title'],
            'type' => $data['type'],
            'slug' => Str::slug($data['title']),
            'category_id' => $category->id
        ]);

        return redirect()->route('content.article.edit',$article);
    }

    public function edit(string $lang,Article $article){
        $pageHeader = 'Article edit';
        return view('admin.content.article.edit',compact('article','pageHeader'));
    }

    public function update(string $lang,Article $article){

        $article->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'lead' => request('lead'),
            'content' => request('content')
        ]);
//        dump($article->category);
        return redirect()->route('admin.content.category.show',['locale'=>app()->getLocale(),'category'=>$article->category]);

    }

    public function destroy(Article $article){
        $article->delete();
        return redirect()->route('content.article.index')
            ->with('success','Article deleted successfuly');
    }

    public function articleTranslate(string $lang,Article $article){
        app()->setLocale(request('lang'));
        $article->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'content' => request('content'),
            'lead' => request('lead')
        ]);
//
        return back();
    }

}
