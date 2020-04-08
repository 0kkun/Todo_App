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

// フォルダ一覧表示
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

// フォルダ作成 (フォルダ作成ページ表示と、フォルダ作成処理のルーティング)
Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create'); //同じ URL で HTTP メソッド違いのルートがいくつかある場合はどれか一つに名前をつければ OK 
Route::post('/folders/create', 'FolderController@create');

// タスク作成機能（タスク作成ページの表示と、タスク作成処理のルーティング）
Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'TaskController@create');