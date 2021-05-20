@extends('commons.template')

@section('content')
@include('commons/flash')
<h1 class="text-center">ログイン</h1>
<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">パスワード</label>
      <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mx-auto d-block">ログイン</button>
</form>
<p class="text-center"><a href="#">パスワードを忘れた方はこちらから</a></p>
@endsection