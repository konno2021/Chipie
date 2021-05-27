@extends('commons.template')

@section('content')
    <style>
        h1 {
        position: relative;
        display: inline-block;
        padding: 0 55px;
        }

        h1:before, h1:after {
        content: '';
        position: absolute;
        top: 50%;
        display: inline-block;
        width: 45px;
        height: 1px;
        background-color: black;
        }

        h1:before {
        left:0;
        }
        h1:after {
        right: 0;
        }
    </style>
<h1 class="text-center mt-3 mb-3">{{ $user->name }}様の登録内容</h1>
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
        <input type="tel" name="tel" value="{{ old('tel', $user->tel) }}"placeholder="012-3456-7890" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="birtyday">生年月日</label>
        <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" name="password" class="form-control">
    </div>
    <p><button type="submit" class="btn btn-primary mx-auto d-block">更新</button></p>
</form>
@endsection