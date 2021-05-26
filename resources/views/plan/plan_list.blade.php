@extends('commons.template')

@section('content')
<h2 class="mb-3 pt-3">◇プラン一覧</h2>
<table class="table table-bordered">
    <thead  class="thead-dark">
        <tr class="pd-2">
            <th>宿名</th>
			<th>プラン名</th>
			<th>プラン概要</th>
            <th>部屋数</th>
            <th>開始年月日</th>
            <th>終了年月日</th>
            <th>備考</th>
            <th>修正</th>
		</tr>
	</thead>
	<tbody>
@foreach ($plan_lists as $plan)
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>{{$plan->inn->name}}</td>
			<td><a href="{{route('plans.show', $plan->id)}}">{{$plan->plan_name}}</a></td>
			<td>{{$plan->description}}</td>
            <td>{{$plan->room}}</td>
            <td>{{$plan->started_at}}</td>
            <td>{{$plan->ended_at}}</td>
            <td>{{$plan->remarks}}</td>
            <td>
                <div class="form-row">
                    <button><a href="{{route('plans.edit', $plan)}}">修正</a></button>
                   
                    {{-- <form method="post" action="{{route('plans.destroy', $plan)}}">
                        @csrf
                        @method('delete')
                            <button class="btn btn-danger">削除
                                        
                            </button>
                    </form> --}}
                </div>
            </td>

		</tr>
@endforeach
</tbody>
</table>
@endsection