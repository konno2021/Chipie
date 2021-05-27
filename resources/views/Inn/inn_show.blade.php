@extends('commons.template')

@section('content')
<style>
    .star {
        color: yellow;
        text-shadow:
            1px 0px 2px orange,
            0px 1px 2px orange,
            -1px 0px 2px orange,
            0px -1px 2px orange,
            1px -1px 2px orange,
            -1px 1px 2px orange,
            -1px -1px 2px orange,
            1px -1px 2px orange;
    }
    .non-star{
        color: black;
    }
</style>
<p class="mb-3 ml-3 pt-3 h1">{{ $inn->name }}</p>
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
    @foreach ($plans as $plan)
        <div class="card m-3">
            <div class="card-body">
                <div class="card-title h3">{{ $plan->plan_name }}</div>
                <p class="card-text">{{ $plan->description }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">価格：{{ $plan->price }}</li>
                    <li class="list-group-item">部屋数：{{ $plan->room }}</li>
                    <li class="list-group-item">開始日：{{ $plan->started_at }}</li>
                    <li class="list-group-item">終了日：{{ $plan->ended_at }}</li>
                    <li class="list-group-item"></li>
                </ul>
                <div class="row">
                    <div class="col-6">
                        <p class="text-center mb-0"><a href="{{ route('reservations.create', $plan) }}" class="btn btn-primary">このプランで予約</a></p>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-info d-block mx-auto" type="button" data-toggle="collapse" data-target="#collapse{{ $plan->id }}" aria-expanded="false" aria-controls="collapse{{ $plan->id }}">最新の口コミ</button>
                    </div>
                </div>
                <div class="collapse mt-4" id="collapse{{ $plan->id }}">
                    <div class="card card-body overflow-auto" id="posts-list" style="max-height:600px">
                        @if($plan->posts->count() > 0)
                            @foreach($plan->posts as $post)
                                <div class="h4 mb-4">{{ $post->title }}</div>
                                <div class="mb-4">{{ $post->content }}</div>
                                <div>
                                    <div class="text-right">
                                        <span>（{{ $post->poster_name }}）評価：</span>
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $post->value)
                                                <span class="star">★</span>
                                            @else
                                                <span class="non-star">☆</span>
                                            @endif
                                        @endfor
                                        <span>　{{ $post->created_at }}</span>
                                    </div>
                                </div>
                                <hr class="mt-1">
                            @endforeach
                        @else
                            <p class="text-center mb-0">まだ口コミはありません。</p>
                        @endif
                    </div>
                    @if(Auth::check())
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="text-center h4 mb-3">口コミ投稿フォーム</div>
                                <form action="{{ route('posts.store') }}" method="post" id="post-form">
                                    @csrf
                                    <table class="w-100">
                                        <tr>
                                            <td style="width:100px" class="text-center">名前</td>
                                            <td><input type="text" name="poster_name" class="form-control w-50" value="<?php if(Cookie::get('poster_name')) { echo Cookie::get('poster_name'); } ?>" required maxlength="255"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">タイトル</td>
                                            <td><input type="text" name="title" class="form-control w-50" required maxlength="255"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">感想</td>
                                            <td><textarea name="content" class="form-control" rows="3" required maxlength="255"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">評価</td>
                                            <td>
                                                @for($i=1; $i<=5; $i++)
                                                    <input type="radio" name="value" value="{{ $i }}" id="star-{{ $i }}" style="display:none" checked>
                                                    <label for="star-{{ $i }}" id="label-{{ $i }}" class="mb-0 h3 star">★</label>
                                                @endfor
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <button type="submit" class="btn btn-primary d-block mx-auto">投稿</button>
                                </form>    
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <script>
        function changeStar(){
            let len = star_form.value.value;
            for(let i=1; i<=5; i++){
                let tmp = document.getElementById('label-' + i);
                if(i <= len){
                    tmp.innerHTML = '★';
                    tmp.classList.remove('non-star');
                    tmp.classList.add('star');
                }
                else{
                    tmp.innerHTML = '☆';
                    tmp.classList.remove('star');
                    tmp.classList.add('non-star');
                }
            }
        }
        
        let star_form = document.getElementById('post-form');
        let value = document.getElementsByName('value');
        value.forEach(function(e){
            e.addEventListener('change', changeStar);
        });
    </script>
@endsection