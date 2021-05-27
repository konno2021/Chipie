@extends('commons.template')

@section('content')
    <h4 class="m-3">予約内容確認画面</h4>
    <form action="{{ route('reservations.store') }}" method="post">
        @csrf
    <div class="card font-weight-bold">
        <h3 class="card-header pl-5">{{ $plan->inn->name }}</h3>
        <div class="iframely-embed">
            <div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;">
                <a href="https://www.jubilo-iwata.co.jp/" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a>
            </div>
        </div>
            <script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
        <div class="card-body">
            <h4 class="card-title">{{ $plan->plan_name }}</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">価格: {{ $plan->price }}</li>
                <li class="list-group-item">概要: {{ $plan->description }}</li>
                <li class="list-group-item">部屋数: {{ $plan->room }}</li>
                <li class="list-group-item">チェックイン時間: {{ $check_in }}</li>
                <li class="list-group-item">チェックアウト時間: {{ $check_out }}</li>
                <li class="list-group-item">合計金額: {{ $sum_price }}</li>
                <li class="list-group-item">その他ご要望: {{ $demand }}</li>
            </ul>
        </div>
        <div class="card-body">
            <ul class="pl-0">
            @if($is_ok === true)
                <li  class="list-group-item text-center text-danger">ただいま予約可能</li><br>
                <h6 class="text-muted text-center">※予約が確定していないため、この画面で時間経過すると予約が埋まってしまう場合がございます。
                <br>その場合、キャンセル待ち予約となります。予めご了承ください。</h6>
            @elseif($is_ok === false)
                <li  class="list-group-item text-center text-danger">キャンセル待ちで予約可能</li>
            @endif
            </ul>
        </div>
        <div class="card-body">
            <h4 class="card-title">予約者個人情報</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">氏名: {{ Auth::user()->name }}</li>
                <li class="list-group-item">電話番号: {{ Auth::user()->tel }}</li>
                <li class="list-group-item">メールアドレス: {{ Auth::user()->email }}</li>
                <li class="list-group-item">住所: {{ Auth::user()->address }}</li>
                <li class="list-group-item">生年月日: {{ Auth::user()->birthday }}</li>
                <li class="list-group-item"><a href="{{ route('users.edit', Auth::user()) }}">個人情報を編集する</a></li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="row  mb-3">
            
                <div class="col-6">
                <a href="{{ route('reservations.create', $plan) }}" class="btn btn-primary col">予約内容を変更する</a>
                </div>
                <div class="col-6">
                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="check_in" value="{{$check_in}}">
                <input type="hidden" name="check_out" value="{{$check_out}}">
                <input type="hidden" name="room" value="{{$room}}">
                <input type="hidden" name="demand" value="{{$demand}}">
                <input type="hidden" name="token" value="{{mt_rand(10000000,99999999)}}">
                @if($is_ok)
                    <input type="hidden" name="status" value="0">
                @else
                    <input type="hidden" name="status" value="1">
                @endif
                <button class="btn btn-primary col">予約内容を確定する</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection