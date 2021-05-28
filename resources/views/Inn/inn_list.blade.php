@extends('commons.template')

@section('content')
<h2 class="mb-3 pt-3">＜宿アカウント一覧＞</h2>

<table class="table table-bordered">
    <thead  class="thead-dark text-center">
        <tr class="pd-2">
			<th>ID</th>
			<th>宿名</th>
			<th>分類コード</th>
            <th>住所</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th style="width:120px">詳細</th>
		</tr>
	</thead>
	<tbody>
@foreach ($inn_lists as $inn)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$inn->id}}</td>
			<td><a href="{{route('inns.show_lists', $inn->id)}}">{{$inn->name}}</a></td>
			<td>{{$inn->inn_code->inn_code}}</td>
            <td>{{$inn->address}}</td>
            <td>{{$inn->tel}}</td>
            <td>{{$inn->email}}</td>
            <td>
                <div class="form-row">
                    <button class="w-100 h-100"><a href="{{route('inns.edit', $inn)}}">修正</a></button>
                    </div>
            </td>

		</tr>
@endforeach
</tbody>
</table>
{{ $inn_lists->links() }}
@endsection