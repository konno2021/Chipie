@extends('commons.template')

@section('content')
<h1 class="text-center">パスワードの初期化</h1>
<form action="{{ route('change_pass') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="email">名前</label>
        <input type="name" name="name" value="{{ old('name') }}" class="form-control">
      </div>
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">新しいパスワード</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mx-auto d-block">新しいパスワードを登録</button>
</form>
@endsection