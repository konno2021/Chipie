@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$inn->name}}の情報</h1>
<div class="text-xl-center">
    <div class="form-group">
        <p>宿名:{{$inn->name}}</p>
    </div>
    <div class="form-group">
        <p>分類グループ:{{$inn->inn_code->inn_code}}({{$inn->inn_code_id}})</p>
    </div>
    <div class="form-group">
        <p>住所:{{$inn->address}}</p>
    </div>
    <div class="form-group">
        <p>メールアドレス:{{$inn->email}}</p>
    </div>
    <div class="form-group">
        <p>電話番号:{{$inn->tel}}</p>
    </div>
    <div class="form-group">
        <p>チェックイン時間:{{$inn->check_in}}</p>
    </div>
    <div class="form-group">
        <p>チェックアウト時間:{{$inn->check_out}}</p>
    </div>
    <div class="form-group">
        <p>宿のHP:{{$inn->hp}}</p>
    </div>
    
    <div class="form-row center ">
    <a href="{{route('inns.edit', $inn->id)}}"><button type="submit" class="btn btn-primary mx-auto d-block">変更</button></a>
    <a href="{{route('inns.destroy', $inn->id)}}"><button type="submit" class="btn btn-danger mx-auto d-block">削除</button></a>
    </div>
</div>
@endsection