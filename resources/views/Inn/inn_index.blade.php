@extends('commons.template')

@section('content')
    <h4 class="mb-3 ml-3 pt-3">検索結果一覧</h4>
        <table class="table table-bordered">
            <thead  class="thead-dark">
                <tr class="pd-2">
                    <th>宿名</th>
                    <th>宿タイプ</th>
                    <th>住所</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>チェックイン時間</th>
                    <th>チェックアウト時間</th>
                    <th>宿HP</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="(user,index) in users" v-bind:key="index">
                <td>しぴホテル</td>
                <td>シティホテル</td>
                <td>静岡県藤枝市</td>
                <td>0120000000</td>
                <td>sipi@index.com</td>
                <td>
                </td>

            </tr>
            <tr v-for="(user,index) in users" v-bind:key="index">
                <td>しぴホテル</td>
                <td>シティホテル</td>
                <td>静岡県藤枝市</td>
                <td>0120000000</td>
                <td>sipi@index.com</td>
                <td>
                </td> 
            </tr> 
        </table>
    <a href="/">検索画面へ戻る</a>
@endsection