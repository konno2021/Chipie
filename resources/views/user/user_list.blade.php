@extends('commons.template_admin')

@section('content')
<h2 class="mb-3 pt-3">◇会員一覧</h2>

<table class="table table-bordered">
    <thead  class="thead-dark">
        <tr class="pd-2">
			<th>ID</th>
			<th>ユーザ名</th>
			<th>住所</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th>生年月日</th>
            <th>詳細</th>
		</tr>
	</thead>
	<tbody>
@foreach ($user_lists as $user_list)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$user_list->'id'}}</td>
			<td>{{$user_list->'name'}}</td>
			<td>{{$user_list->'inn_code'}}</td>
            <td>{{$user_list->'address'}}</td>
            <td>{{$user_list->'#'}}</td>
            <td>{{$user_list->'#'}}</td>
            <td>
                <form method="get" action="{{route('#', $inn_list)}}">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
@endforeach
</tbody>
</table>
@endsection