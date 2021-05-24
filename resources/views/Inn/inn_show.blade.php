@extends('commons.template')

@section('content')
<p class="mb-3 ml-3 pt-3" style="font-size:40px">宿名</p>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#777" width="100%" height="100%"/><text fill="#555" dy=".3em" x="50%" y="50%">First slide</text></svg>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Second slide"><title>Placeholder</title><rect fill="#666" width="100%" height="100%"/><text fill="#444" dy=".3em" x="50%" y="50%">Second slide</text></svg>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Third slide"><title>Placeholder</title><rect fill="#555" width="100%" height="100%"/><text fill="#333" dy=".3em" x="50%" y="50%">Third slide</text></svg>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
    </div>
        <p class="mb-3 ml-3 pt-3">
        @foreach ($plans as $plan)
            {{$plan->plan_name}}
            {{-- @foreach($plan->posts as $post)でいけるはず・・・？ --}}
        
        {{-- <form action="{{ route('reservation.confirm') }}" method="post"> --}}
        <a href="{{ route('reservations.create', $plan) }}" class="btn btn-primary">このプランで予約</a></p>

        <p class="text-right">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                最新の口コミ
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body text-right">
                <div>
                @foreach ($plan->posts as $post)
                {{ $post->value }} 
                {{ $post->title }}
                {{ $post->poster_name }}
                {{ $post->content }}
                @endforeach
                </div>
                <div>
                    <form action="{{ route('posts.store') }}" method="post">
                        @csrf
                        <label class="text-left">口コミ投稿<br>
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <input type="hidden" name="plan_id" value="{{$plan->id}}">

                        <p>評価：
                            非常に良い<input type="radio" name="value" id="value5" value="5">
                            良い<input type="radio" name="value" id="value4" value="4">
                            普通<input type="radio" name="value" id="value3" value="3">
                            悪い<input type="radio" name="value" id="value2" value="2">
                            非常に悪い<input type="radio" name="value" id="value1" value="1">
                        </p>
                        <p>タイトル：　<input type="text" name="title"></p>
                        <p>ペンネーム：　<input type="name" name="poster_name"></p>
                        感想：　<input type="text" name="content"></label>
                        <button type="submit">投稿</button>
                    </form>
                </div>
                
            </div>
        </div>
        @endforeach
@endsection