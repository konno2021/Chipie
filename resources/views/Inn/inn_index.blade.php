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
    
    {{-- 変更 --}}
    @foreach($inns as $inn)
        <div class="card ml-3 mr-3">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
            <div class="card-body">
                <div class="card-title">
                    <span class="h3"><a href="{{ route('inns.show', $inn) }}">{{ $inn->name }}</a></span>
                    <span class="h6">（{{ $inn->inn_code->inn_code }}）</span>
                </div>
                <div class="card-text">
                    <table class="table">
                        <tr>
                            <th class="table-active pt-1 pb-1 text-center" style="width:150px">住所</th>
                            <td class="table-light pt-1 pb-1">{{ $inn->address }}</td>
                        </tr>
                        <tr>
                            <th class="table-active pt-1 pb-1 text-center">電話番号</th>
                            <td class="table-light pt-1 pb-1">{{ $inn->tel }}</td>
                        </tr>
                        <tr>
                            <th class="table-active pt-1 pb-1 text-center">メールアドレス</th>
                            <td class="table-light pt-1 pb-1">{{ $inn->email }}</td>
                        </tr>
                        <tr>
                            <th class="table-active pt-1 pb-1 text-center">チェックイン</th>
                            <td class="table-light pt-1 pb-1">{{ date('H:i', strtotime($inn->check_in)) }}</td>
                        </tr>
                        <tr>
                            <th class="table-active pt-1 pb-1 text-center">チェックアウト</th>
                            <td class="table-light pt-1 pb-1">{{ date('H:i', strtotime($inn->check_out)) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        @foreach($plans[$inn->id] as $plan)
                            <div class="col-4 card p-0" style="width:20rem">
                                <div class="card-body">
                                    <p class="card-title h4 text-center">{{ $plan->plan_name }}</p>
                                    <p class="card-text text-center">{{ number_format($plan->price) }}円 / {{ $plan->room }}部屋</p>
                                    <p class="card-text">{{ $plan->description }}</p>
                                    <p class="text-center mb-0"><a href="#" class="btn btn-primary">詳細・予約</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- 変更 --}}

<a href="/" class="mb-2 ml-4">検索画面へ戻る</a>

@endsection