@extends('commons.template')

@section('content')
<h1 class="text-center py-3">宿アカウント修正画面</h1>
<form action="{{route('inns.update', $inn->id)}}" method="POST">
@csrf
@method('PUT')
    <div class="col">
            <label for="inputAddress"class="font-weight-bold  ml-3">宿名</label>
          <input type="text" name="name" class="form-control  ml-3" placeholder="宿名" value="{{old('name', $inn->name)}}">
        
    </div>

    <br>
    <div class="col-5">
        <dl>
            <dd>
                <dt  class=" ml-3">分類コード</dt>
                    <select name="inn_code_id" size="1" class=" ml-3">
                        <option value="1" @if(old('inn_code_id',$inn->inn_code_id)==1)selected @endif>シティホテル</option>
                        <option value="2" @if(old('inn_code_id',$inn->inn_code_id)==2)selected @endif>リゾートホテル</option>
                        <option value="3" @if(old('inn_code_id',$inn->inn_code_id)==3)selected @endif>ビジネスホテル</option>
                        <option value="4" @if(old('inn_code_id',$inn->inn_code_id)==4)selected @endif>旅館</option>
                        <option value="5" @if(old('inn_code_id',$inn->inn_code_id)==5)selected @endif>民宿</option> 
                        <option value="6" @if(old('inn_code_id',$inn->inn_code_id)==6)selected @endif>ペンション</option>
                    </select>
            </dd>
        </dl>
        <dl>
    <br>
    
    <div class="form-group font-weight-bold col">
        <label for="inputAddress">住所</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="東京都新宿区3丁目2-2" name="address" value="{{old('address', $inn->address)}}">
    </div>
    <br>
    <div class="form-group font-weight-bold col">
            <label for="exampleInputEmail1">メールアドレス</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chipie@index.com" name="email" value="{{old('email', $inn->email)}}">
            <small id="emailHelp" class="form-text text-muted">お間違えの無いようお願いします。</small>
    </div>

    <br>

    <div class="form-group font-weight-bold col">
        <label for="exampleInputEmail1">電話番号</label>
        <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="012-3456-7890" name="tel" value="{{old('tel', $inn->tel)}}">
</div>

<br>

    <div class="form-group font-weight-bold col">
        <label for="exampleInputPassword1">チェックイン時間：</label>
        <input type="time"  id="exampleInputPassword1" name="check_in" value="{{old('check_in', $inn->check_in)}}">
    </div>
    
    <div class="form-group font-weight-bold col ">
        <label for="exampleInputPassword1">チェックアウト時間：</label>
        <input type="time"  id="exampleInputPassword1" name="check_out" value="{{old('check_out', $inn->check_out)}}">
<br>
    </div>
     <div class="col">
        <label for="inputAddress"class="font-weight-bold">宿のHP</label>
      <input type="url" class="form-control" placeholder="https://" name="hp" value="{{old('hp', $inn->hp)}}">
    </div> 
    <div>
        <button type="submit" class="btn btn-primary col">更新</button>
        </form>
    </div>
</div>
@endsection