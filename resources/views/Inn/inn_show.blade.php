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
        {{dd($plans)}}
        @foreach ($plans as $plan)
        {{$plan->plan_name}}
        @endforeach
        {{-- <form action="{{ route('reservation.confirm') }}" method="post"> --}}

        <button class="btn btn-primary" type="submit">このプランで予約</button></p>

        <p class="text-right">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                最新の口コミ
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body text-right">
                {{-- @foreach ($plans as $plan)
                {{ $post->content }}
                @endforeach --}}
                <form action="{{ route('inns.show', $inn) }}" method="post">
                    @csrf
                    <label class="text-left">口コミ投稿<br>
                    <input type="text" name="content" value="content"></label>
                <button type="submit">投稿</button>
                
            </div>
        </div>
@endsection