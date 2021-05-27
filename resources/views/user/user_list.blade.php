@extends('commons.template')

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
@foreach ($user_lists as $user)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$user->id}}</td>
			<td><a href="{{route('users.show', $user->id)}}">{{$user->name}}</a></td>
			<td>{{$user->address}}</td>
            <td>{{$user->tel}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->birthday}}</td>
            <td>
                <div class="form-row">
                    <button><a href="{{route('users.edit', $user)}}">修正</a></button>
                </div>
            </td>

		</tr>
@endforeach
</tbody>
</table>
{{ $user_lists->links() }}
@endsection