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
    <h4 class="mb-3 ml-3 pt-3">検索結果一覧</h4>

    @foreach($inns as $inn)
        <div class="card ml-3 mr-3">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
            <div class="card-body">
                <div class="card-title">
                    <span class="h3"><a href="{{ route('inns.show', $inn) }}">{{ $inn->name }}</a></span>
                    <span>（{{ $inn->inn_code->inn_code }}）</span>
                    @if($inn_values[$inn->id] !== -1)
                        @for($i=1; $i<=5; $i++)
                            @if($i <= round($inn_values[$inn->id]))
                                <span class="star">★</span>
                            @else
                                <span class="non-star">☆</span>
                            @endif
                        @endfor
                        {{-- <span>{{ $inn_values[$inn->id] }}</span> --}}
                    @else
                        <span>まだレビューはありません</span>
                    @endif
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
                                    @if($plan_values[$plan->id] !== -1)
                                        <div class="text-center">
                                            @for($i=1; $i<=5; $i++)
                                                @if($i <= round($plan_values[$plan->id]))
                                                    <span class="star">★</span>
                                                @else
                                                    <span class="non-star">☆</span>
                                                @endif
                                            @endfor
                                            {{-- {{ $plan_values[$plan->id] }} --}}
                                        </div>
                                    @else
                                        <div class="text-center">まだレビューはありません</div>
                                    @endif
                                    <p class="card-text text-center">{{ number_format($plan->price) }}円 / {{ $plan->room }}部屋</p>
                                    <p class="card-text">{{ $plan->description }}</p>
                                    <p class="text-center mb-0"><a href="{{ route('reservations.create', $plan) }}" class="btn btn-primary">詳細・予約</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- 変更 --}}
<br>
<p class="text-center"><a href="/" class="mb-2 ml-4">検索画面へ戻る</a></p>
@endsection