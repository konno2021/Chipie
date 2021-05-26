@extends('commons.template')

@section('content')
@include('commons/flash')
<h1 class="text-center">会員登録</h1>
<form action="{{ route('register') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">氏名</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">住所</label>
        <input type="text" name="address" value="{{ old('address') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="tel">電話番号</label>
        <input type="tel" name="tel" value="{{ old('tel') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="birtyday">生年月日</label>
        <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
    </div>
    {{-- nullだけどinsertで必要なので --}}
    <input type="hidden" name="inn_id" value="null">
    <input type="hidden" name="deleted_at" value="null">
    {{-- あとで消す --}}
    <div class="form-group">
        <label for="is_admin">is_admin</label>
        <select name="is_admin">
            <option value="0">会員</option>
            <option value="1">管理者</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mx-auto d-block">登録</button>
</form>
@endsection