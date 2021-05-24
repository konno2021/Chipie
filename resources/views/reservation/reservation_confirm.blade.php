<style>
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

    </style>

@extends('commons.template')

@section('content')
<div class="card font-weight-bold">
    <h3 class="card-header pl-5">箱根旅館</h3>
    <div class="iframely-embed"><div class="iframely-responsive" style="height: 140px; padding-bottom: 0; width:100%;"><a href="https://www.jubilo-iwata.co.jp/" data-iframely-url="//cdn.iframe.ly/VjMLuRM?iframe=card-small"></a></div></div><script async src="//cdn.iframe.ly/embed.js" charset="utf-8"></script>
  <div class="card-body">
    <div class="card-body">
      <h4 class="card-title">リラックスプラン</h4>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">価格:#</li>
        <li class="list-group-item">概要:#</li>
        <li class="list-group-item">部屋数:#</li>
      </ul>
    </div>
  </div>

  <form action="{{route('reservations.create_register', $plan)}}" method="post">
    @csrf
<div class="form-row m-0">
    <div class="col-md-8">
    <div class="form-row font-weight-bold ml-5">
        <div class="form-group col-md-4">
            <label for="inputState">チェックイン日時</label>
            <input type="date" select id="inputState" class="form-control">
          </div>

        <div class="form-group col-md-4">
          <label for="inputState">チェックアウト日時</label>
          <input type="date" select id="inputState" class="form-control">
        </div>

        <div class="form-group col-md-4">
            <label for="inputState">部屋数</label>
            <input type="number" select id="inputState" class="form-control">
        </div>

        <div class="form-group col-md-11">
        <p class="font-weight-bold ml-1">その他ご要望</p>
            <textarea rows="5" cols="80" class="ml-1"></textarea>
        </div>
  </div>
</div>
<div class="col-md-4">
    <article>
        <p>合計金額</p><h2>100万円</h2></div>
    </article>
</div>
  
</div>
  <button type="submit" class="btn btn-success btn-lg btn-block pt-3">予約する</button>
      
    
  </form>
@endsection