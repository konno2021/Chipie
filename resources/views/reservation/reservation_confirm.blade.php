@extends('commons.template')

@section('content')
{{-- <style>
	h3 {
		position: relative;
	}
	h3:after {
		content: "";
		position: absolute;
		left: 0;
		bottom: 0;
		width: 100%;
		height: 7px;
		background: -webkit-repeating-linear-gradient(-45deg, #374746, #323f3e 2px, #fff 2px, #fff 4px);
		background: repeating-linear-gradient(-45deg, #425250, #3b4948 2px, #fff 2px, #fff 4px);
	}
	article{
		width:100%;
		height:75%;
		border:5px black solid;
	}
</style> --}}
<style>
	.sum-price-body{
		border-top: solid 5px #7db4e6;
		border-bottom: solid 5px #7db4e6;
	}
</style>
<div class="card pb-3 m-3">
  	<h3 class="card-header pl-5">{{ $plan->inn->name }}</h3>
  	{{-- <div class="iframely-embed mb-4"><div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;"><a href="https://www.jubilo-iwata.co.jp/" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a></div></div><script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script> --}}
	@if($plan->inn->hp)
		<div class="iframely-embed mb-4"><div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;"><a href="" data-iframely-url="{{ $plan->inn->hp }}"></a></div></div><script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
	@endif
	<div class="card m-3">
		<div class="card-body">
			<h4 class="card-title">{{ $plan->plan_name }}</h4>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">概要：{{ $plan->description }}</li>
				<li class="list-group-item">価格：<span id="price">{{ number_format($plan->price) }}</span></li>
				<li class="list-group-item">部屋数：<span id="max-room">{{ $plan->room }}</span></li>
				<li class="list-group-item">プラン開始日：{{ substr($plan->started_at, 0, 10) }}</span></li>
				<li class="list-group-item">プラン終了日：{{ substr($plan->ended_at, 0, 10) }}</span></li>
			</ul>
		</div>
	</div>

	<?php
		$min_check_in = new DateTime($plan->started_at);
		$max_check_in = new DateTime($plan->ended_at);
		$min_check_out = new DateTime($plan->started_at);
		$max_check_out = new DateTime($plan->ended_at);
		$max_check_in->modify('-1 days');
		$min_check_out->modify('+1 days');
		$today = new DateTime();
		if($min_check_in < $today){
			$min_check_in = new DateTime();
			$min_check_out = new DateTime();
			$min_check_out->modify('+1 days');
		}
		if($max_check_in < $today){
			$min_check_in = new DateTime();
			$min_check_out = new DateTime();
			$max_check_in = new DateTime();
			$max_check_out = new DateTime();
			$min_check_in->modify('+2 days');
			$min_check_out->modify('+2 days');
		}
	?>
	<form action="{{ route('reservations.create_register', $plan) }}" method="post">
		@csrf
		<div class="form-row ml-3 mr-3">
			<div class="col-8">
				<div class="form-row font-weight-bold">
					<div class="form-group col-4">
						<label for="check-in">チェックイン</label>
						<input type="date" name="check_in" id="check-in" class="form-control" value="{{ old('check_in') }}" min="{{ $min_check_in->format('Y-m-d') }}" max="{{ $max_check_in->format('Y-m-d') }}">
					</div>
					<div class="form-group col-4">
						<label for="check-out">チェックアウト</label>
						<input type="date" name="check_out" id="check-out" class="form-control" value="{{ old('check_out') }}" min="{{ $min_check_out->format('Y-m-d') }}" max="{{ $max_check_out->format('Y-m-d') }}">
					</div>
					<div class="form-group col-4">
						<label for="room">部屋数</label>
						<input type="number" name="room" id="room" class="form-control" value="{{ old('room', 1) }}" min="1" max="{{ $plan->room }}">
					</div>

					<div class="form-group col-12">
						<p class="font-weight-bold">その他ご要望</p>
						<textarea rows="4" name="demand" class="form-control">{{ old('demand') }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-4 mb-3 pt-4">
				<div class="card h-100">
					<div class="card-body">
						<div class="h-100 pt-3 pb-3 sum-price-body">
							<h5 class="card-title text-center">合計金額</h5>
							<div class="h-75 d-flex align-items-center justify-content-center"><p class="font-weight-bold h5" id="sum-price"></p></div>
							<input type="hidden" id="hidden-sum-price" name="sum_price" value="{{ old('sum_price') }}">
						</div>
					</div>
				</div>
			</div>
		</div>
		@if(Auth::check())
			<button type="submit" class="btn btn-success d-block mx-auto">予約登録画面へ進む</button>
		@else
			<button type="submit" class="btn btn-success d-block mx-auto mb-3" disabled>予約登録画面へ進む</button>
			<p class="text-center mb-2"><a href="{{ route('login') }}">ログインがお済でない方はこちら</a></p>
			<p class="text-center mb-0"><a href="{{ route('register') }}">会員登録がまだの方はこちら</a></p>
		@endif
	</form>
</div>

<script>
	function changeInput(){
		let i = check_in.value.split('-');
		let o = check_out.value.split('-');
		let check_in_value = new Date(i[0], i[1], i[2]);
		let check_out_value = new Date(o[0], o[1], o[2]);
		let room_value = parseInt(room.value);
		room_value = Math.min(room_value, parseInt(max_room.innerHTML));
		room_value = Math.max(room_value, 1);
		room.value = room_value;
		let sum_price_value = parseInt(price.innerHTML.replace(',', '')) * room_value * (check_out_value - check_in_value) / 86400000;
		hidden_sum_price.value = sum_price_value;
		sum_price.innerHTML = '';
		if(!isNaN(sum_price_value)){
			if(sum_price_value > 0){
				sum_price.innerHTML = sum_price_value.toLocaleString() + '円';
			}
			else{
				sum_price.innerHTML = 'チェックインとチェックアウトの値が不正です。';
			}
		}
	}
	function init(){
		changeInput();
	}
	let check_in = document.getElementById('check-in');
	let check_out = document.getElementById('check-out');
	let room = document.getElementById('room');
	let price = document.getElementById('price');
	let sum_price = document.getElementById('sum-price');
	let max_room = document.getElementById('max-room');
	let hidden_sum_price = document.getElementById('hidden-sum-price');
	check_in.addEventListener('change', changeInput);
	check_out.addEventListener('change', changeInput);
	room.addEventListener('change', changeInput);
	init();
</script>
@endsection