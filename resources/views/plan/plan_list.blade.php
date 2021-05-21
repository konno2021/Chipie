@extends('commons.template_admin')

@section('content')
<h2 class="mb-3 pt-3">◇プラン一覧</h2>

<table class="table table-bordered">
    <thead  class="thead-dark">
        <tr class="pd-2">
			<th>プランID</th>
            <th>宿名</th>
			<th>プラン名</th>
			<th>プラン内容</th>
            <th>部屋数</th>
            <th>詳細</th>
		</tr>
	</thead>
	<tbody>
@foreach ($plan_lists as $plan_list)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$plan_list->'#'}}</td>
			<td>{{$plan_list->'#'}}</td>
			<td>{{$plan_list->'#'}}</td>
            <td>{{$plan_list->'#'}}</td>
            <td>{{$plan_list->'#'}}</td>
            <td>
                <form method="get" action="{{route('#', $plan_list)}}">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
@endforeach
</tbody>
</table>
@endsection