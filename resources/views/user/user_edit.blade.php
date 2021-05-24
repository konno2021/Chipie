@extends('commons.template')

@section('content')
<h1 class="text-center">会員登録</h1>
<form action="{{ route('users.update', $user->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">氏名</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">住所</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="tel">電話番号</label>
        <input type="tel" name="tel" value="{{ old('tel', $user->tel) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="birtyday">生年月日</label>
        <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mx-auto d-block">変更</button>
</form>
@endsection