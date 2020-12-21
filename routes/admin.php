<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard');



Route::group(['namespace' => 'Content','prefix'=>'content','as'=>'content.'], function () {

    Route::get('/',[\App\Http\Controllers\Admin\Content\ContentController::class,'index'])->name('index');

    Route::group([
        'prefix' => '{locale}',
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'set.lang'
    ], function (){
        Route::get('/',[\App\Http\Controllers\Admin\Content\ContentController::class,'index'])->name('index');
        //Category routes
        Route::resource('category','CategoryController');
        Route::post('category/{category}/translate',[\App\Http\Controllers\Admin\Content\CategoryController::class,'categoryTranslate'])->name('category.translate');

        //Article Routes
        Route::get('article/{category}/create',[\App\Http\Controllers\Admin\Content\ArticleController::class,'create'])->name('article.create');
        Route::post('article/{category}/store',[\App\Http\Controllers\Admin\Content\ArticleController::class,'store'])->name('article.store');
        Route::get('article/{article}/edit',[\App\Http\Controllers\Admin\Content\ArticleController::class,'edit'])->name('article.edit');
        Route::patch('article/{article}/update',[\App\Http\Controllers\Admin\Content\ArticleController::class,'update'])->name('article.update');
        Route::delete('article/{article}/delete',[\App\Http\Controllers\Admin\Content\ArticleController::class,'destroy'])->name('article.delete');
        Route::post('article/{article}/translate',[\App\Http\Controllers\Admin\Content\ArticleController::class,'articleTranslate'])->name('article.translate');


//    Route::resource('article','ArticleController');
//    Route::get('category/{category}/translate',[\App\Http\Controllers\Admin\Content\CategoryController::class,'categoryTranslate'])->name('category.translate');


//    Route::get('article/{article}/translate',[\App\Http\Controllers\Admin\Content\ArticleController::class,'articleTranslate'])->name('category.translate');

    });


});

Route::group(['namespace'=>'Users','prefix'=>'manage','as'=>'manage.'], function(){

    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('permissions','PermissionController');

});
