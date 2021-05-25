@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$user->name}}さんの情報</h1>

<div class="text-xl-center">

    <div class="form-group">
        <p>氏名:{{$user->name}}</p>
    </div>
    <div class="form-group">
        <p>住所:{{$user->address}}</p>
    </div>
    <div class="form-group">
        <p>電話番号:{{$user->tel}}</p>
    </div>
    <div class="form-group">
        <p>メールアドレス:{{$user->email}}</p>
    </div>
    <div class="form-group">
        <p>誕生日:{{$user->birthday}}</p>
    </div>
    
    <div class="form-row center ">
    <a href="{{route('users.edit', $user->id)}}"><button type="submit" class="btn btn-primary mx-auto d-block">変更</button></a>
    <a href="{{route('users.destroy', $user->id)}}"><button type="submit" class="btn btn-danger mx-auto d-block">削除</button></a>
    </div>
</div>
@endsection