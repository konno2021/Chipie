@extends('commons.template')

@section('content')
    <h1 class="text-center py-3">プラン修正画面</h1>
    <form action="{{route('plans.update', $plan->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="col">
                <label for="inputAddress"class="font-weight-bold  ml-3">プラン名</label>
            <input type="text" id="name" name="name" class="form-control  ml-3" value="{{old('name', $plan->name)}}">
            
        </div>
        <br>
        <div class="form-group font-weight-bold col">
            <label>価格</label>
            <input type="text" class="form-control" id="price" name="address" value="{{old('price', $plan->price)}}">
        </div>
        <br>
        <div class="form-group font-weight-bold col">
            <label>プラン内容</label>
            <input type="text" class="form-control" id="description" name="description" value="{{old('description', $plan->description)}}">
        </div>
        <br>
        <div class="form-group font-weight-bold col">
            <label>部屋数</label>
            <input type="number" class="form-control" id="room" name="room" value="{{old('room', $plan->room)}}">
        </div>
        <br>
        <div class="form-group font-weight-bold col">
            <label>プラン開始</label>
            <input type="date" class="form-control" id="started_at" name="started_at" value="{{old('started_at', $plan->started_at)}}">
        </div>
        <br>
        <div class="form-group font-weight-bold col">
            <label>プラン終了</label>
            <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{old('ended_at', $plan->ended_at)}}">
        </div>
        
    <br>
        <button type="submit" class="btn btn-primary col">更新</button>
    </form>
    </div>
@endsection