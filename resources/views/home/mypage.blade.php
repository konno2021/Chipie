@extends('commons.template')

@section('content')

<style>
    @media (min-height: 420px){
        #reservations-list {
            height: 420px;
        };
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-6 text-center">
            <p class="h4 text-center mb-3">アカウント情報</p>
            <div class="card mb-4">
                <div class="card-body">
                    <dl>
                        <dt>名前</dt>
                        <dd>{{ Auth::user()->name }}</dd>
                    </dl>
                    <dl>
                        <dt>住所</dt>
                        <dd>{{ Auth::user()->address }}</dd>
                    </dl>
                    <dl>
                        <dt>電話番号</dt>
                        <dd>{{ Auth::user()->tel }}</dd>
                    <dl>
                        <dt>メールアドレス</dt>
                        <dd>{{ Auth::user()->email }}</dd>
                    </dl>
                    <dl>
                        <dt>生年月日</dt>
                        <dd>{{ Auth::user()->birthday }}</dd>
                    </dl>
                    {{-- <dl>
                        <dt>パスワード</dt>
                        <dd>
                            {{ Auth::user()->password }}
                        </dd>
                    </dl> --}}
                </div>
            </div>
            <a class="btn btn-primary" href={{ route('users.edit', Auth::user()) }}>編集する</a>
            <a class="btn btn-danger" href="#" onclick="deleteUser()">退会する</a>
            <form action="{{ route('logout') }}" method="post" id="delete-form">
                @csrf
                <input type="hidden" name="is_delete" value="1">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            </form>
        </div>
        <div class="col-6">
            <p class="h4 text-center mb-3">{{ Auth::user()->name }}様の予約履歴</p>
            <div class="card">
                <div class="card-body overflow-auto" id="reservations-list">
                    @foreach($reservations as $reservation)
                        <ul class="list-group">
                            <li class="list-group-item">宿名：<a href="{{ route('inns.show', $reservation->plan->inn) }}">{{ $reservation->plan->inn->name }}</a></li>
                            <li class="list-group-item">プラン名：{{ $reservation->plan->plan_name }}</li>
                            <li class="list-group-item">チェックイン：{{ $reservation->check_in }}</li>
                            <li class="list-group-item">チェックアウト：{{ $reservation->check_out }}</li>
                            <li class="list-group-item">部屋数：{{ $reservation->room }}</li>
                            <li class="list-group-item">確認用トークン：{{ $reservation->token }}</li>
                            <li class="list-group-item">登録日：{{ $reservation->updated_at }}</li>
                            <li class="list-group-item">予約状況：
                                @if($reservation->status == 0)
                                    <span>予約中</span>
                                    <div class="container">
                                        <div class="text-center mt-4 row">
                                            <div class="col-6">
                                                <p><a class="btn btn-info text-light" href="#collapse{{ $reservation->id }}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{ $reservation->id }}">変更する</a></p>
                                            </div>
                                            <div class="col-6">
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">キャンセルする</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($reservation->status == 1)
                                    <span>キャンセル待ち予約</span>
                                    <div class="container">
                                        <div class="text-center mt-4 row">
                                            <div class="col-6">
                                                <p><a class="btn btn-info text-light" href="#collapse{{ $reservation->id }}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse{{ $reservation->id }}">変更する</a></p>
                                            </div>
                                            <div class="col-6">
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">キャンセルする</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($reservation->status == 2)
                                    <span>予約可能（ボタンを押すと予約が完了します）<br></span>
                                    <div class="container">
                                        <div class="text-center mt-4 row">
                                            <div class="col-6">
                                                <form action="{{ route('reservations.waiting_to_reserved', $reservation->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-success d-block mx-auto">予約する</button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger d-block mx-auto">キャンセルする</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($reservation->status == 3)
                                    <span>キャンセル済み<br></span>
                                @endif
                                <div class="collapse" id="collapse{{ $reservation->id }}">
                                    <div class="card card-body">
                                        <form action="{{ route('reservations.update', $reservation->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <table class="table">
                                                <tr>
                                                    <td>チェックイン</td>
                                                    <td><input type="date" name="check_in" value="{{ $reservation->check_in }}" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>チェックアウト</td>
                                                    <td><input type="date" name="check_out" value="{{ $reservation->check_out }}" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>部屋数</td>
                                                    <td><input type="number" name="room" value="{{ $reservation->room }}" class="form-control" min="1" max="{{ $reservation->plan->room }}"></td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="plan_id" value="{{ $reservation->plan_id }}">
                                            <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
                                            <input type="hidden" name="demand" value="{{ $reservation->demand }}">
                                            <input type="hidden" name="token" value="{{ $reservation->token }}">
                                            <input type="hidden" name="status" value="{{ $reservation->status }}">
                                            <button type="submit" class="btn btn-primary text-light d-block mx-auto">内容を保存する</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <br>
                    @endforeach
                </div>
            </div>
            {{-- <a href="/">検索画面へ</a> --}}
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteUser() {
        event.preventDefault();
        if (window.confirm('本当に削除しますか？')) {
            document.getElementById('delete-form').submit();
        }
    }   
</script>
@endsection