@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$post->poster_name}}さんの口コミ情報</h1>
<div class="card" style="width: 100;">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">口コミID：{{$post->id}}</li>
      <li class="list-group-item">口コミ名：{{$post->poster_name}}</li>
      <li class="list-group-item">本名：{{$post->user->name}}</li>
      <li class="list-group-item">本名：{{$post->title}}</li>
      <li class="list-group-item">宿名：{{$post->plan->inn->name}}</li>
      <li class="list-group-item">プラン名：{{$post->plan->plan_name}}</li>
      <li class="list-group-item">内容：{{$post->content}}</li>
      <li class="list-group-item">評価：{{$post->value}}</li>
    </ul>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <button  class="btn btn-primary "><a href="{{route('posts.edit', $post)}}" style=color:white>修正</a></button>
                </div>
                <div class="col-6 text-center">
                        <form method="post" action="{{route('posts.destroy', $post)}}" id="delete-form">
                        @csrf
                        @method('delete')
                            <button class="btn btn-danger" onclick="deleteClick()">削除</button>
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