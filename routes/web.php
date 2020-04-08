<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ログイン認証を求める機能をミドルウェアを用いる
Route::group(['middleware' => 'auth'], function() {
  // ホーム画面
  Route::get('/', 'HomeController@index')->name('home');

  // フォルダ作成 (フォルダ作成ページ表示と、フォルダ作成処理のルーティング)
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create'); //同じ URL で HTTP メソッド違いのルートがいくつかある場合はどれか一つに名前をつければ OK 
  Route::post('/folders/create', 'FolderController@create');

  Route::group(['middleware' => 'can:view,folder'], function() {
    // フォルダ一覧表示。本来{id}になっているところが{folder}になっているのはルートモデルバインディング化のため。
    Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

    // タスク作成機能（タスク作成ページの表示と、タスク作成処理のルーティング）
    Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

    // タスク編集機能（タスク編集ページの表示と、タスク編集処理のルーティング）
    Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
  });
});

// この1行で会員登録・ログイン・ログアウト・パスワード再設定の各機能で必要なルーティング設定をすべて定義できる
Auth::routes();