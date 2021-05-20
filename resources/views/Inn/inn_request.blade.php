@extends('commons.template')

@section('content')
<h1 class="text-center py-3">宿アカウント登録申請画面</h1>
<form action="#" method="POST">


    <div class="col">
            <label for="inputAddress"class="font-weight-bold">宿名</label>
          <input type="text" name="name" class="form-control" placeholder="宿名" value="{{old('name')}}">
        
    </div>

    <br>
    <p class="font-weight-bold col " >分類コード<p>
    <div class="form-check form-check-inline ml-3">
        <input class="form-check-input" type="radio" id="inlineCheckbox1" name="inn_code_id" value="{{old('inn_code_id')}}">
        <label class="form-check-label" for="inlineCheckbox1">0</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox2" name="inn_code_id" value="{{old('inn_code_id')}}">
        <label class="form-check-label" for="inlineCheckbox2">1</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox3" name="inn_code_id" value="{{old('inn_code_id')}}">
        <label class="form-check-label" for="inlineCheckbox3">2</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox3" name="inn_code_id" value="{{old('inn_code_id')}}">
        <label class="form-check-label" for="inlineCheckbox3">3</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox3" name="inn_code_id" value="{{old('inn_code_id')}}">
        <label class="form-check-label" for="inlineCheckbox3">4</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox3" name="inn_code_id" value="{{old('inn_code_id')}}">
        <label class="form-check-label" for="inlineCheckbox3">5</label>
      </div>
    <p></p>
    <div class="form-group font-weight-bold col">
        <label for="inputAddress">住所</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="東京都新宿区3丁目2-2" name="address" value="{{old('address')}}">
    </div>
    <br>
    <div class="form-group font-weight-bold col">
            <label for="exampleInputEmail1">メールアドレス</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chipie@index.com" name="email" value="{{old('email')}}">
            <small id="emailHelp" class="form-text text-muted">お間違えの無いようお願いします。</small>
    </div>
    

    <div class="form-group font-weight-bold col">
        <label for="exampleInputPassword1">チェックイン時間：</label>
        <input type="time"  id="exampleInputPassword1" name="check_in" value="{{old('check_in')}}">
    </div>

    <div class="form-group font-weight-bold col ">
        <label for="exampleInputPassword1">チェックアウト時間：</label>
        <input type="time"  id="exampleInputPassword1" name="check_out" value="{{old('check_out')}}">
    </div>
     <div class="col">
        <label for="inputAddress"class="font-weight-bold">宿のHP</label>
      <input type="text" class="form-control" placeholder="https://" name="hp" value="{{old('hp')}}">
    </div> 

    <div class="form-group font-weight-bold col">
        <label for="exampleInputPassword1">パスワード</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="{{old('password')}}">
    </div>

     <div class="form-group form-check ml-3">
                    <input type="checkbox" class="form-check-input " id="exampleCheck1">
                    <label class="form-check-label " for="exampleCheck1">ご確認の上クリックをお願いします</label>
     </div>
    
     

     <button type="submit" class="btn btn-primary col">申請</button>
  </form>
@endsection