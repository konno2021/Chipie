@extends('commons.template')

@section('content')
<h1 class="text-center py-3">宿アカウント登録申請画面</h1>
<form action="{{route('inns.store')}}" method="POST">
@csrf

    <div class="col">
            <label for="inputAddress"class="font-weight-bold  ml-3">宿名</label>
          <input type="text" name="name" class="form-control  ml-3" placeholder="宿名" value="{{old('name')}}">
        
    </div>

    <br>
    <div class="col-5">
        <dl>
            <dd>
                <dt  class=" ml-3">分類コード</dt>
                    <select name="inn_code_id" size="1" class=" ml-3">
                        <option value="0">シティホテル</option>
                        <option value="1">リゾートホテル</option>
                        <option value="2">ビジネスホテル</option>
                        <option value="3">旅館</option>
                        <option value="4">民宿</option> 
                        <option value="5">ペンション</option>
                    </select>
            </dd>
        </dl>
        <dl>
    <br>
    
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

    <br>

    <div class="form-group font-weight-bold col">
        <label for="exampleInputEmail1">電話番号</label>
        <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="012-3456-7890" name="tel" value="{{old('tel')}}">
</div>

<br>

    <div class="form-group font-weight-bold col">
        <label for="exampleInputPassword1">チェックイン時間：</label>
        <input type="time"  id="exampleInputPassword1" name="check_in" value="{{old('check_in')}}">
    </div>
    
    <div class="form-group font-weight-bold col ">
        <label for="exampleInputPassword1">チェックアウト時間：</label>
        <input type="time"  id="exampleInputPassword1" name="check_out" value="{{old('check_out')}}">
<br>
    </div>
     <div class="col">
        <label for="inputAddress"class="font-weight-bold">宿のHP</label>
      <input type="text" class="form-control" placeholder="https://" name="hp" value="{{old('hp')}}">
    </div> 
<br>
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
</div>
@endsection