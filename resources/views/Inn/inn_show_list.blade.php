@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$inn->name}}の情報</h1>

<div class="card" style="width: 100;">
    <div class="iframely-embed mb-4"><div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;"><a href="{{$inn->hp}}" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a></div></div><script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>    <div class="card-body">
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
                    <button  class="btn btn-primary "><a href="{{route('inns.edit', $inn->id)}}" style=color:white>修正</a></button>
                </div>
                <div class="col-6 text-center">
                        <form method="post" action="{{route('inns.destroy', $inn->id)}}" id="delete-form">
                        @csrf
                        @method('delete')
                            <button class="btn btn-danger" onclick="cancelClick()">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function cancelClick() {
        event.preventDefault();
        if (window.confirm('本当に削除しますか？')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection