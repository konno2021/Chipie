@extends('commons.template')

@section('content')
    <div class="card font-weight-bold">
        <h3 class="card-header pl-5">箱根旅館</h3>
        <div class="iframely-embed">
            <div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;">
                <a href="https://www.jubilo-iwata.co.jp/" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a>
            </div>
        </div>
            <script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
        <div class="card-body">
            <h4 class="card-title">リラックスプラン</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">価格:#</li>
                <li class="list-group-item">概要:#</li>
                <li class="list-group-item">部屋数:#</li>
                <li class="list-group-item">チェックイン時間:#</li>
                <li class="list-group-item">チェックアウト時間:#</li>
                <li class="list-group-item">合計金額:#</li>
                <li class="list-group-item">その他ご要望:#</li>
            </ul>
        </div>
        <div class="card-body">
            <h4 class="card-title">予約者個人情報</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">氏名:#</li>
                <li class="list-group-item">電話番号:#</li>
                <li class="list-group-item">メールアドレス:#</li>
                <li class="list-group-item">住所:#</li>
                <li class="list-group-item">生年月日:#</li>
            </ul>
            <a href="{{route('users.edit', $id)}}">個人情報を編集する</a>
        </div>
    </div>
@endsection