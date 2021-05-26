@extends('commons.template')

@section('content')
<style>
h2 {
  color: black;/*文字色*/
  padding: 0.5em 1em;/*上下の余白*/
  border-top: solid 3px darkslategrey;/*上線*/
  border-bottom: solid 3px darkslategrey;/*下線*/
  background: whitesmoke;/*背景色*/
}
</style>

<h2 class=" mt-3 mb-3 pt-3">会員 (新着)</h2>
<button><a href="{{route('users.index')}}">会員一覧はこちら</a></button>
<table class="table table-bordered">
	<thead  class="thead-dark">
		<tr class="pd-2">
			<th>ユーザ名</th>
			<th>住所</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th>生年月日</th>
            <th>詳細</th>
		</tr>
	</thead>
    <tbody>
            @foreach ($users as $user)
            <tr v-for="(user,index) in users" v-bind:key="index">
                <td>{{$user->name}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->tel}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->birthday}}</td>
                <td>
                    <button><a href="{{route('users.show', $user->id)}}">詳細</a></button>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
<div class="pt-5 pb-5">
</div>
<h2 class="mb-3 pt-3 ">宿アカウント登録承認申請 (新着)</h2>
<button><a href="{{route('inn.request_list')}}">申請一覧はこちら</a></button>
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
        @foreach ($inn_requests as $inn)
        <tr v-for="(user,index) in users" v-bind:key="index">
            <td>{{$inn->name}}</td>
            <td>{{$inn->inn_code_id}}</td>
            <td>{{$inn->address}}</td>
            <td>{{$inn->tel}}</td>
            <td>{{$inn->email}}</td>
            <td>
                <button><a href="{{route('inns.show_request_list', $inn->id)}}">詳細</a></button>
            </td>

        </tr>
        @endforeach
</tbody>     
</table>

<div class="pt-5 pb-5">
</div>

<h2 class="mb-3 pt-3">宿アカウント (新着)</h2>
    <button><a href="{{route('inn.list')}}">宿アカウント一覧はこちら</a></button>
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
        @foreach ($inns as $inn)
        <tr v-for="(user,index) in users" v-bind:key="index">
            <td>{{$inn->name}}</td>
            <td>{{$inn->inn_code_id}}</td>
            <td>{{$inn->address}}</td>
            <td>{{$inn->tel}}</td>
            <td>{{$inn->email}}</td>
            <td>
                <button><a href="{{route('inns.show_lists', $inn->id)}}">詳細</a></button>
            </td>

        </tr>
        @endforeach
</tbody> 
</table>

<div class="pt-5 pb-5">
</div>

<h2 class="mb-3 pt-3">プラン (新着)</h2>
    <button><a href="{{route('plans.index')}}">プラン一覧はこちら</a></button>
<table class="table table-bordered">
	<thead  class="thead-dark">
		<tr class="pd-2">
            <th>宿名</th>
			<th>プラン名</th>
            <th>料金</th>
			<th>プラン内容</th>
            <th>部屋数</th>
            <th>詳細</th>
		</tr>
	</thead>
	<tbody>
        @foreach ($plans as $plan)
        <tr v-for="(user,index) in users" v-bind:key="index">
            <td>{{$plan->inn->name}}</td>
            <td>{{$plan->plan_name}}</td>
            <th>{{$plan->price}}</th>
            <td>{{$plan->description}}</td>
            <td>{{$plan->room}}</td>
            <td>
                <button><a href="{{route('plans.show', $plan->id)}}">詳細</a></button>
            </td>

        </tr>
        @endforeach
</tbody> 
</table>

<button class="btn btn-primary btn-lg"><a href="{{route('plans.create')}}" style="color:white">宿プランの登録</a></button>
@endsection