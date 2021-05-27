@extends('commons.template')

@section('content')

<h1 class="text-center py-3">プランの修正</h1>
<form action="{{route('plans.update', $plan->id)}}" method="POST">
@csrf
@method('PUT')
@if(Auth::user()->get_user_status() === 2)
    <input type="hidden" name="inn_id" value="{{ Auth::user()->inn_id }}">
@elseif(Auth::user()->get_user_status() === 3)
<dl>
    <dd>
        <dt  class=" ml-3">宿名</dt>
            <select name="inn_id" size="1" class=" ml-3">
            @foreach($inn_lists as $inn)
                <option value="{{$inn->id}}">{{$inn->name}}</option>
            @endforeach
            </select>
    </dd>
</dl>
@endif

    <div class="col">
            <label for="inputAddress"class="font-weight-bold  ">プラン名</label>
          <input type="text" name="plan_name" class="form-control  "  value="{{old('plan_name', $plan->plan_name)}}">
        
    </div>

    <br>
    
    <div class="form-group font-weight-bold col">
        <label for="inputAddress">価格 (円)：</label>
        <input type="number" id="inputAddress" placeholder="0000" name="price" value="{{old('price', $plan->price)}}">
    </div>
    <br>
    <div class="form-group col-12">
        <p class="font-weight-bold">コースの概要</p>
        <textarea rows="4" name="description" class="form-control">{{ old('description', $plan->description) }}</textarea>
    </div>

    <br>

    <div class="form-group font-weight-bold col">
        <label for="exampleInputEmail1">部屋数</label>
        <input type="number"  id="exampleInputEmail1" aria-describedby="emailHelp" name="room" value="{{old('room', $plan->room)}}">
    </div>

<br>
    <div class="form-row">
    <div class="form-group font-weight-bold ml-3">
        <label for="exampleInputPassword1">プラン開始年月日：</label>
        <input type="date"  name="started_at" value="{{old('started_at', substr($plan->started_at, 0, 10))}}">
    </div>
<p class="font-weight-bold ml-3">～</p>
    <div class="form-group font-weight-bold col ml-3">
        <label for="exampleInputPassword1">プラン終了年月日：</label>
        <input type="date"   name="ended_at" value="{{old('ended_at', substr($plan->ended_at, 0, 10))}}">
    </div>
    </div>
<br>
    <div class="form-group col-12">
        <p class="font-weight-bold">備考</p>
        <textarea rows="4" name="remarks" class="form-control">{{ old('remarks', $plan->remarks) }}</textarea>
    </div>
<br>
    <div class="form-group font-weight-bold col ">
     <button type="submit" class="btn btn-primary col">変更を保存</button>
    </div>
  </form>
@endsection