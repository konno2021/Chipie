@extends('commons.template_admin')

@section('content')
<h2 class="mb-3 pt-3">◇宿アカウント一覧</h2>

<table class="table table-bordered">
    <thead  class="thead-dark">
        <tr class="pd-2">
			<th>ID</th>
			<th>宿名</th>
			<th>分類コード</th>
            <th>住所</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th>詳細</th>
		</tr>
	</thead>
	<tbody>
@foreach ($inn_lists as $inn_list)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$inn_list->'id'}}</td>
			<td>{{$inn_list->'name'}}</td>
			<td>{{$inn_list->'inn_code'}}</td>
            <td>{{$inn_list->'address'}}</td>
            <td>{{$inn_list->'#'}}</td>
            <td>{{$inn_list->'#'}}</td>
            <td>
                <form method="get" action="{{route('inns.edit', $inn_list)}}">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
@endforeach
</tbody>
</table>
@endsection