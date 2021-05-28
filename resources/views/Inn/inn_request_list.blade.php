@extends('commons.template')

@section('content')
<h2 class="mb-3 pt-3">＜宿アカウント登録申請一覧＞</h2>

<table class="table table-bordered">
    <thead  class="thead-dark text-center">
        <tr class="pd-2">
            <th>宿名</th>
            <th>分類コード</th>
            <th>住所</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th style="width:140px">承認・不可</th>
	    </tr>
	</thead>

<tbody>
@foreach ($inn_request_lists as $inn)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td><a href="{{route('inns.show_request_list', $inn->id)}}">{{$inn->name}}</a></td>
			<td>{{$inn->inn_code->inn_code}}</td>
			<td>{{$inn->address}}</td>
            <td>{{$inn->tel}}</td>
            <td>{{$inn->email}}</td>
            <td>
                <div class="form-row">
                <form method="post" action="{{route('users.store')}}">
                    @csrf
                    <input type="hidden" name="password" value="{{$inn->password}}">
                    <input type="hidden" name="inn_id" value="{{$inn->id}}">
                    <input type="hidden" name="name" value="{{$inn->name}}">
                    <input type="hidden" name="address" value="{{$inn->address}}">
                    <input type="hidden" name="tel" value="{{$inn->tel}}">
                    <input type="hidden" name="email" value="{{$inn->email}}">
                        <button class="btn btn-primary w-100 h-100">承認
                            
                        </button>
                </form>
                <form method="post" action="{{route('inns.destroy', $inn)}}" id="delete-form-{{$inn->id}}">
                    @method('delete')
                    @csrf
                        <button class="btn btn-danger w-100 h-100" onclick="deleteClick({{$inn->id}})">却下
                                    
                        </button>
                </form>
                </div>
            </td>

		</tr>
@endforeach
</tbody>

</table>
<script>
function deleteClick(id) {
    event.preventDefault();
    if (window.confirm('本当にキャンセルしますか？')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
{{ $inn_request_lists->links() }}
@endsection