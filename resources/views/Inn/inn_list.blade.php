@extends('commons.template')

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
@foreach ($inn_lists as $inn)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$inn->id}}</td>
			<td><a href="{{route('inns.show_lists', $inn->id)}}">{{$inn->name}}</a></td>
			<td>{{$inn->inn_code_id}}</td>
            <td>{{$inn->address}}</td>
            <td>{{$inn->tel}}</td>
            <td>{{$inn->email}}</td>
            <td>
                <div class="form-row">
                    <button><a href="{{route('inns.edit', $inn)}}">修正</a></button>
                    {{-- <form method="post" action="{{route('inns.edit', $inn_list)}}">
                        @csrf
                        <input type="hidden" name="password" value="{{$inn_list->password}}">
                        <input type="hidden" name="inn_id" value="{{$inn_list->id}}">
                        <input type="hidden" name="name" value="{{$inn_list->name}}">
                        <input type="hidden" name="address" value="{{$inn_list->address}}">
                        <input type="hidden" name="tel" value="{{$inn_list->tel}}">
                        <input type="hidden" name="email" value="{{$inn_list->email}}">
                            <button class="btn btn-primary">変更
                                
                            </button>
                    </form> --}}
                    </div>
            </td>

		</tr>
@endforeach
</tbody>
</table>
@endsection