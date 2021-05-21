@extends('commons.template')

@section('content')
    <h4 class="mb-3 ml-3 pt-3">検索結果一覧</h4>

    
        <div class="card ml-3 mr-3">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
            <div class="card-body">
            <h5 class="card-title">宿名</h5>
            <p class="card-text">宿タイプ：　住所：　電話番号：　メールアドレス：　チェックイン時間：　チェックアウト時間：　</p>
            <div class="container">
                <div class="row">

                    <div class="col-4">
                    <p>プラン1</p>
                    <p>内容</p>
                    <a href="#" class="btn btn-primary">詳細・予約</a>
                    </div>

                    <div class="col-4">
                    <p>プラン2</p>
                    <p>内容</p>
                    <a href="#" class="btn btn-primary">詳細・予約</a>
                    </div>

                    <div class="col-4">
                    <p>プラン3</p>
                    <p>内容</p>
                    <a href="#" class="btn btn-primary">詳細・予約</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
<a href="/" class="mb-2 ml-4">検索画面へ戻る</a>

@endsection