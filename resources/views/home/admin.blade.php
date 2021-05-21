@extends('commons.template_admin')

@section('content')
<h2 class="mb-3 pt-3"><a href="admin/user_list">◇会員の一覧</a></h2>
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
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>1</td>
			<td>かたつむり静子</td>
			<td>静岡県藤枝市</td>
            <td>0120000000</td>
            <td>sipi@index.com</td>
            <td>1996年1月1日</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>

        <tr v-for="(user,index) in users" v-bind:key="index">
			<td>1</td>
			<td>かたつむり静子</td>
			<td>静岡県藤枝市</td>
            <td>0120000000</td>
            <td>sipi@index.com</td>
            <td>1996年1月1日</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細

                        </button>
            </td>
		</tr>

        
</table>

<h2 class="mb-3 pt-3"><a href="admin/inn_request_list">◇宿アカウント登録承認申請一覧</a></h2>
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
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>しぴホテル</td>
			<td>シティホテル</td>
			<td>静岡県藤枝市</td>
            <td>0120000000</td>
            <td>sipi@index.com</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
        <tr v-for="(user,index) in users" v-bind:key="index">
        <td>しぴホテル</td>
        <td>シティホテル</td>
        <td>静岡県藤枝市</td>
        <td>0120000000</td>
        <td>sipi@index.com</td>
        <td>
            <form method="POST" action="#">
                @csrf
                    <button class="btn btn-danger">詳細
                        
                    </button>
        </td>

    </tr>       
</table>

<h2 class="mb-3 pt-3"><a href="admin/inn_list">◇宿アカウント一覧</a></h2>
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
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>1</td>
			<td>金野さんホテル</td>
			<td>旅館</td>
            <td>茨城県つくば市</td>
            <td>0120000000</td>
            <td>sipi@index.com</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>

        <tr v-for="(user,index) in users" v-bind:key="index">
			<td>1</td>
			<td>金野さんホテル</td>
			<td>旅館</td>
            <td>茨城県つくば市</td>
            <td>0120000000</td>
            <td>sipi@index.com</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
</table>

<h2 class="mb-3 pt-3"><a href="admin/plan_list">◇プラン一覧</a></h2>
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
		<tr v-for="(user,index) in users" v-bind:key="index">
			<td>1</td>
			<td>金野さんホテル</td>
			<td>全部付プラン</td>
            <td>なんでもありますよ</td>
            <td>10</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>

        <tr v-for="(user,index) in users" v-bind:key="index">
			<td>1</td>
			<td>金野さんホテル</td>
			<td>全部付プラン</td>
            <td>なんでもありますよ</td>
            <td>10</td>
            <td>
                <form method="POST" action="#">
                    @csrf
                        <button class="btn btn-danger">詳細
                            
                        </button>
            </td>

		</tr>
</table>
<form action="#" method="#">
@csrf
    <button type="button" class="btn btn-primary btn-lg">宿プランの登録</button>
<form>





@endsection