@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$inn->name}}さんの申請登録情報</h1>
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
    
    <div class="form-row">
        <form method="post" action="{{route('users.store')}}">
            @csrf
            <input type="hidden" name="password" value="{{$inn->password}}">
            <input type="hidden" name="inn_id" value="{{$inn->id}}">
            <input type="hidden" name="name" value="{{$inn->name}}">
            <input type="hidden" name="address" value="{{$inn->address}}">
            <input type="hidden" name="tel" value="{{$inn->tel}}">
            <input type="hidden" name="email" value="{{$inn->email}}">
                <button class="btn btn-primary">承認
                    
                </button>
        </form>
        <form method="post" action="{{route('inns.destroy', $inn)}}">
            @method('delete')
            @csrf
                <button class="btn btn-danger">却下
                            
                </button>
        </form>
        </div>
</div>
@endsection