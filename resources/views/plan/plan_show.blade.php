@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$plan->plan_name}}の情報</h1>
<div class="card" style="width: 100;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">宿名：{{$plan->inn->name}}</li>
      <li class="list-group-item">プラン名：{{$plan->plan_name}}</li>
      <li class="list-group-item">料金：{{$plan->price}}</li>
      <li class="list-group-item">プラン概要：{{$plan->description}}</li>
      <li class="list-group-item">部屋数：{{$plan->room}}</li>
      <li class="list-group-item">プラン開始年月日：{{$plan->started_at}}</li>
      <li class="list-group-item">プラン終了年月日：{{$plan->ended_at}}</li>
    </ul>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <button  class="btn btn-primary "><a href="{{route('plans.edit', $plan->id)}}" style=color:white>変更</a></button>
                </div>
                <div class="col-6 text-center">
                        <form method="post" action="{{route('plans.destroy', $plan)}}">
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