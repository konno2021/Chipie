{{-- 宿アカウントのトップページ(プラン一覧) --}}
@extends('commons.template')

@section('content')
    @foreach($plans as $plan)
        <div class="card ml-3 mr-3">
            <div class="card-body">
                <div class="card-text">
                <p>プラン名：{{ $plan }}</p>
                    <table class="table">
                        <tr>
                            <th class="table-active pt-1 pb-1 text-center" style="width:150px"></th>
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
            </div>
        </div>
    @endforeach
@endsection