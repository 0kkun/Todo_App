<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">ToDo App</a>
    </nav>
  </header>
  <main>
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
                  <input type="text" class="form-control" name="title" id="title" />
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
  </main>
</body>
</html>