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
<div class="card font-weight-bold pb-3 m-3">
  	<h3 class="card-header pl-5">{{ $plan->inn->name }}</h3>
  	<div class="iframely-embed mb-4"><div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;"><a href="https://www.jubilo-iwata.co.jp/" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a></div></div><script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
	<div class="card m-3">
		<div class="card-body">
			<h4 class="card-title">{{ $plan->plan_name }}</h4>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">価格：<span id="price">{{ number_format($plan->price) }}</span></li>
				<li class="list-group-item">概要：{{ $plan->description }}</li>
				<li class="list-group-item">部屋数：{{ $plan->room }}</li>
			</ul>
		</div>
	</div>

	<form action="{{ route('reservations.create_register', $plan) }}" method="post">
		@csrf
		<div class="form-row ml-3 mr-3">
			<div class="col-8">
				<div class="form-row font-weight-bold">
					<div class="form-group col-4">
						<label for="check-in">チェックイン日時</label>
						<input type="date" name="check_in" id="check-in" class="form-control">
					</div>
					<div class="form-group col-4">
						<label for="check-out">チェックアウト日時</label>
						<input type="date" name="check_out" id="check-out" class="form-control">
					</div>

					<div class="form-group col-4">
						<label for="room">部屋数</label>
						<input type="number" name="room" id="room" class="form-control">
					</div>

					<div class="form-group col-12">
						<p class="font-weight-bold">その他ご要望</p>
						<textarea rows="4" name="demand" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="col-4 mb-3">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title text-center">合計金額</h5>
						<p class="card-text" id="sum-price"></p>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success d-block mx-auto">予約登録画面へ進む</button>
	</form>
</div>

<script>
	function changeInput(){
		let i = check_in.value.split('-');
		let o = check_out.value.split('-');
		let check_in_value = new Date(i[0], i[1], i[2]);
		let check_out_value = new Date(o[0], o[1], o[2]);
		let room_value = parseInt(room.value);
		let sum_price_value = (parseInt(price.innerHTML.replace(',', '')) * room_value * (check_out_value - check_in_value) / 86400000).toLocaleString();
		if(sum_price_value !== 'NaN'){
			sum_price.innerHTML = sum_price_value;
		}
	}
	let check_in = document.getElementById('check-in');
	let check_out = document.getElementById('check-out');
	let room = document.getElementById('room');
	let price = document.getElementById('price');
	let sum_price = document.getElementById('sum-price');
	check_in.addEventListener('input', changeInput);
	check_out.addEventListener('change', changeInput);
	room.addEventListener('input', changeInput);
</script>
@endsection