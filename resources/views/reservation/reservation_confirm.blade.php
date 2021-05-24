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

@extends('commons.template')

@section('content')
<div class="card font-weight-bold">
  <h3 class="card-header pl-5">箱根旅館</h3>
  <div class="iframely-embed ml-3 mr-3"><div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;"><a href="https://www.jubilo-iwata.co.jp/" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a></div></div><script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
<div class="card-body">
  <div class="card-body">
    <h4 class="card-title">{{ $plan->plan_name }}</h4>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">価格：{{ $plan->price }}</li>
      <li class="list-group-item">概要：{{ $plan->description }}</li>
      <li class="list-group-item">残り部屋数：{{ $plan->room }}</li>
    </ul>
  </div>
</div>

<form action="{{ route('reservations.store') }}" method="post">
  @csrf
  <div class="form-row ml-3 mr-3">
    <div class="col-8">
      <div class="form-row font-weight-bold">
        <div class="form-group col-4">
          <label for="check-in">チェックイン日時</label>
          <input type="date" id="check-in" class="form-control">
        </div>
        <div class="form-group col-4">
          <label for="check-out">チェックアウト日時</label>
          <input type="date" id="check-out" class="form-control">
        </div>

        <div class="form-group col-4">
            <label for="room">部屋数</label>
            <input type="number" id="room" class="form-control">
        </div>

        <div class="form-group col-12">
          <p class="font-weight-bold">その他ご要望</p>
          <textarea rows="4" class="form-control"></textarea>
        </div>
      </div>
    </div>
    <div class="col-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title text-center">合計金額</h5>
          <p class="card-text" id="sum-price">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-success d-block mx-auto">予約する</button>
</form>

<form id="star-form">
  <input type="radio" name="value" value="1" id="star-1" style="display:none"><label for="star-1" id="label-1">★</label>
  <input type="radio" name="value" value="2" id="star-2" style="display:none"><label for="star-2" id="label-2">★</label>
  <input type="radio" name="value" value="3" id="star-3" style="display:none"><label for="star-3" id="label-3">★</label>
  <input type="radio" name="value" value="4" id="star-4" style="display:none"><label for="star-4" id="label-4">★</label>
  <input type="radio" name="value" value="5" id="star-5" style="display:none"><label for="star-5" id="label-5">★</label>
</form>

<script>
  function changeStar(){
    let len = star_form.value.value;
    for(let i=1; i<=5; i++){
      let tmp = document.getElementById('label-' + i);
      if(i <= len){
        tmp.innerHTML = '☆';
      }
      else{
        tmp.innerHTML = '★';
      }
    }
  }
  let star_form = document.getElementById('star-form');
  let value = document.getElementsByName('value');
  value.forEach(function(e){
    e.addEventListener('change', changeStar);
  });
</script>

<script>
  function changeInput(){
    let i = explode('-', check_in.value);
    let check_in_value = new Data(i[0], i[1], i[2]);
    let o = explode('-', check_out.value);
    
  }
  let check_in = document.getElementById('check-in');
  let check_out = document.getElementById('check-out');
  let room = document.getElementById('room');
  check_in.addEventListener(change, changeInput);
  check_out.addEventListener(change, changeInput);
  room.addEventListener(change, changeInput)
</script>
@endsection