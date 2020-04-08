<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


# About this application
### 名称
- Todo App

### 概要
- LaravelとPHPを学習するために、チュートリアルとしてタスク管理アプリを作成しました。
- ログイン機能実装・投稿機能・編集機能・メールサーバを経由したパスワードリセット機能を実装
- ユーザー登録・ログイン → フォルダ作成 → タスクを作成 → タスクのステータス編集

### 本番環境
- デプロイ先：Heroku
- http://my-laravel-todo-app.herokuapp.com/

### 制作背景(意図)
- スキル習得(laravel, php)を図るため

### 工夫したポイント
- メールサーバーを使ったパスワードリセットの仕組み
- ミドルウェアを用いた認証チェック
- レスポンシブデザイン
- flatpickrを使用した日付入力
- htmlのテンプレート化


### 使用技術
- Laravel 5.7.28
- PHP 7.3.16
- javascript
- MySQL 5.6.46
- composer 1.10.1
- Heroku
- git

### 課題や今後実装したい機能
- タスク・フォルダ削除機能
- dockerへの搭載

### DB設計

## usersテーブル
|Column|Type|Options|
|------|----|-------|
|name             |string   |null: false, unique: true|
|email            |string   |null: false, unique: true|
|password         |string   |null: false              |
|email_verified_at|timestamp|null: false              |
### Association
- has_many :folders


## foldersテーブル
|Column|Type|Options|
|------|----|-------|
|title              |string   |null: false, unique: true|
|created_at         |timestamp|null: false              |
|updated_at         |timestamp|null: false              |
### Association
- belong_to :user
- has_manu :tasks


## taskテーブル
|Column|Type|Options|
|------|----|-------|
|title        |string     |null: false, unique: true|
|status       |integer    |null: false              |
|due_date     |date       |null: false              |
|created_at   |timestamp  |null: false              |
|updated_at   |timestamp  |null: false              |
|folder_id    |references |null: false, foreign_key: true|
### Association
- belong_to :folder