@extends('commons.template_admin')

@section('content')
<h2 class="mb-3 pt-3">宿アカウント登録申請一覧</h2>

<table class="table table-bordered">
    <thead  class="thead-dark">
        <tr class="pd-2">
            <th>宿名</th>
            <th>分類コード</th>
            <th>住所</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th>詳細</th>
	    </tr>
	</thead>

<tbody>
@foreach ($inn_request_lists as $inn_request_list)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$inn_request_list->'#'}}</td>
			<td>{{$inn_request_list->'#'}}</td>
			<td>{{$inn_request_list->'#'}}</td>
            <td>{{$inn_request_list->'#'}}</td>
            <td>{{$inn_request_list->'#'}}</td>
            <td>
                <form method="get" action="{{route('#', $inn_request_list)}}">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
@endforeach
</tbody>
</table>
@endsection