@extends('commons.template')

@section('content')
<h2 class="mb-3 pt-3">＜口コミ一覧＞</h2>

<table class="table table-bordered">
    <thead  class="thead-dark text-center">
        <tr class="pd-2">
            <th>口コミ名</th>
			<th>宿名</th>
			<th>プラン名</th>
			<th>タイトル</th>
            <th>感想</th>
            <th>評価</th>
            <th style="width:120px">詳細</th>
		</tr>
	</thead>
	<tbody>
@foreach ($post_lists as $post)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td><a href="{{route('posts.show', $post->id)}}">{{$post->poster_name}}</a></td>
			<td>{{$post->plan->inn->name}}</td>
            <td>{{$post->plan->plan_name}}</td>
            <td style="width:20%">{{$post->title}}</td>
            <td style="width:30%">{{$post->content}}</td>
            <td>{{$post->value}}</td>
            <td>
                <div class="form-row">
                    <button class="w-100 h-100"><a href="{{route('posts.edit', $post)}}">修正</a></button>
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
{{ $post_lists->links() }}
@endsection