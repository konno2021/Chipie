@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$user->name}}さんの情報</h1>
<div class="card" style="width: 100;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">名前：{{$user->name}}</li>
      <li class="list-group-item">住所：{{$user->address}}</li>
      <li class="list-group-item">電話番号：{{$user->tel}}</li>
      <li class="list-group-item">メールアドレス：{{$user->email}}</li>
      <li class="list-group-item">生年月日：{{$user->birthday}}</li>
    </ul>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <button  class="btn btn-primary "><a href="{{route('users.edit', $user->id)}}" style=color:white>修正</a></button>
                </div>
                <div class="col-6 text-center">
                        <form method="post" action="{{route('users.destroy', $user->id)}}">
                        @csrf
                        @method('delete')
                            <button class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection