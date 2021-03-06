@extends('layout')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダを追加する</div>
          <div class="panel-body">

            <!-- エラーメッセージを表示 -->
            <!-- バリデーションチェックの結果、ルール違反があった場合は自動的に入力画面にリダイレクトするが、
            このときルール違反の内容は $errors 変数に詰めてテンプレートに渡される -->
            @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('folders.create') }}" method="post">
              <!-- CSRF トークンを用いて自分のサイトからの POST リクエストだけを受け付ける -->
              @csrf
              <div class="form-group">
                <label for="title">フォルダ名</label>
                <!-- value属性の値にoldを使用。入力値はセッションに一時的に保存されている。old関数はそのセッション値を取得。引数はname属性 -->
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection