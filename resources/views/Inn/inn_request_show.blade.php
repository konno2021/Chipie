@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$inn->name}}さんの申請登録情報</h1>
<div class="card" style="width: 100;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">宿名：{{$inn->name}}</li>
      <li class="list-group-item">分類グループ：{{$inn->inn_code->inn_code}}({{$inn->inn_code_id}})</li>
      <li class="list-group-item">住所：{{$inn->address}}</li>
      <li class="list-group-item">メールアドレス：{{$inn->email}}</li>
      <li class="list-group-item">電話番号：{{$inn->tel}}</li>
      <li class="list-group-item">チェックイン時間：{{$inn->check_in}}</li>
      <li class="list-group-item">チェックアウト時間：{{$inn->check_out}}</li>
      <li class="list-group-item">宿のHP：{{$inn->hp}}</li>

    </ul>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <form method="post" action="{{route('users.store')}}">
                        @csrf
                        <input type="hidden" name="password" value="{{$inn->password}}">
                        <input type="hidden" name="inn_id" value="{{$inn->id}}">
                        <input type="hidden" name="name" value="{{$inn->name}}">
                        <input type="hidden" name="address" value="{{$inn->address}}">
                        <input type="hidden" name="tel" value="{{$inn->tel}}">
                        <input type="hidden" name="email" value="{{$inn->email}}">
                            <button class="btn btn-primary">承認</button>
                    </form>
                </div>
                <div class="col-6 text-center">
                        <form method="post" action="{{route('inns.destroy', $inn)}}" id="delete-form">
                        @csrf
                        @method('delete')
                            <button class="btn btn-danger" onclick="deleteClick()">却下</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteClick() {
        event.preventDefault();
        if (window.confirm('本当に削除しますか？')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection