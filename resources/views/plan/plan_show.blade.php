@extends('commons.template')

@section('content')
<h1 class="text-center py-3">{{$plan->plan_name}}の情報</h1>
<div class="text-xl-center">
    <div class="form-group">
        <p>宿名:{{$plan->inn->name}}</p>
    </div>
    <div class="form-group">
        <p>プラン名:{{$plan->plan_name}}</p>
    </div>
    <div class="form-group">
        <p>料金:{{$plan->price}}</p>
    </div>
    <div class="form-group">
        <p>プランの概要:{{$plan->description}}</p>
    </div>
    <div class="form-group">
        <p>部屋数:{{$plan->room}}</p>
    </div>
    <div class="form-group">
        <p>プラン開始年月日:{{$plan->started_at}}</p>
    </div>
    <div class="form-group">
        <p>プラン終了年月日:{{$plan->ended_at}}</p>
    </div>
</div> 
    <div class="form-row center ">
    <a href="{{route('plans.edit', $plan->id)}}"><button type="submit" class="btn btn-primary mx-auto d-block btn-block">変更</button></a>
    <form method="post" action="{{route('plans.destroy', $plan)}}">
        @csrf
        @method('delete')
            <button class="btn btn-danger">削除</button>
    </form>
    </div>

@endsection