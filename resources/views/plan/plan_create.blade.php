{{-- プランの作成 --}}
@extends('commons.template')

@section('content')
	<br>
    <h4>プラン登録画面</h4>
    <form action="{{ route('plans.store') }}" method="post">
    @csrf
		<div class="form-row ml-3 mr-3">
			<div class="col-8">
				<div class="form-row font-weight-bold">
						{{-- 宿ID --}}
					<input type="hidden" name="inn_id" id="inn_id" value="{{ Auth::user()->inn_id }}">
					<div class="form-group col-4">
						<label for="plan_name">プラン名
						<input type="text" name="plan_name" id="plan_name" value="{{ old('plan_name') }}"></label>
					</div>
					<div class="form-group col-4">
						<label for="price">価格
						<input type="number" name="price" id="price" value="{{ old('price') }}"></label>
					</div>
					<div class="form-group col-12">
						<label for="description">プラン説明
						<input type="text" name="description" value="{{ old('description') }}"></label>
					</div>
					<div class="form-group col-4">
						<label for="room">部屋数
						<input type="number" name="room" id="room" class="form-control" value="{{ old('room') }}"></label>
					</div>

					<div class="form-group col-4">
						<label for="started_at">プラン開始
						<input type="date" name="started_at" value="{{ old('started_at') }}"></label>
					</div>
					<div class="form-group col-4">
						<label for="ended_at">プラン終了
						<input type="date" name="ended_at" value="{{ old('ended_at') }}"></label>
					</div>
				</div>
			</div>	
		</div>
        <button type="submit" class="btn btn-success d-block mx-auto">プランを登録する</button>
    </form>
@endsection