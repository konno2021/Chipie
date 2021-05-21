@extends('commons.template')

@section('content')
<form action="{{route('inns.index')}}" method="get">
@csrf
    <div class="container">
    <div class="row">
        <div class="col-5">
        <p><h4>エリアで探す</h4><br>
    
            <p><h6>北海道・東北</h6>
            <label><input type="checkbox" name="area[]" value="1">北海道</option></label><br>
            <label><input type="checkbox" name="area[]" value="2">青森</option></label>
            <label><input type="checkbox" name="area[]" value="3">岩手</option></label>
            <label><input type="checkbox" name="area[]" value="4">宮城</option></label>
            <label><input type="checkbox" name="area[]" value="5">秋田</option></label>
            <label><input type="checkbox" name="area[]" value="6">山形</option></label>
            <label><input type="checkbox" name="area[]" value="7">福島</option></label></p>
            <p><h6>関東</h6>
            <label><input type="checkbox" name="area[]" value="8">茨城</option></label>
            <label><input type="checkbox" name="area[]" value="9">栃木</option></label>
            <label><input type="checkbox" name="area[]" value="10">群馬</option></label>
            <label><input type="checkbox" name="area[]" value="11">埼玉</option></label>
            <label><input type="checkbox" name="area[]" value="12">千葉</option></label>
            <label><input type="checkbox" name="area[]" value="13">東京</option></label>
            <label><input type="checkbox" name="area[]" value="14">神奈川</option></label></p>
            <p><h6>北陸</h6>
            <label><input type="checkbox" name="area[]" value="15">新潟</option></label>
            <label><input type="checkbox" name="area[]" value="16">富山</option></label>
            <label><input type="checkbox" name="area[]" value="17">石川</option></label>
            <label><input type="checkbox" name="area[]" value="18">福井</option></label>
            <label><input type="checkbox" name="area[]" value="19">山梨</option></label>
            <label><input type="checkbox" name="area[]" value="20">長野</option></label><p>
             <p><h6>東海</h6>
            <label><input type="checkbox" name="area[]" value="21">岐阜</option></label>
            <label><input type="checkbox" name="area[]" value="22">静岡</option></label>
            <label><input type="checkbox" name="area[]" value="23">愛知</option></label>
            <label><input type="checkbox" name="area[]" value="24">三重</option></label></p>
            <p><h6>近畿</h6>
            <label><input type="checkbox" name="area[]" value="25">滋賀</option></label>
            <label><input type="checkbox" name="area[]" value="26">京都</option></label>
            <label><input type="checkbox" name="area[]" value="27">大阪</option></label>
            <label><input type="checkbox" name="area[]" value="28">奈良</option></label>
            <label><input type="checkbox" name="area[]" value="29">兵庫</option></label>
            <label><input type="checkbox" name="area[]" value="30">和歌山</option></label></p>
            <p><h6>中国</h6>
            <label><input type="checkbox" name="area[]" value="31">鳥取</option></label>
            <label><input type="checkbox" name="area[]" value="32">島根</option></label>
            <label><input type="checkbox" name="area[]" value="33">岡山</option></label>
            <label><input type="checkbox" name="area[]" value="34">広島</option></label>
            <label><input type="checkbox" name="area[]" value="35">山口</option></label></p>
             <p><h6>四国</h6>
            <label><input type="checkbox" name="area[]" value="36">徳島</option></label>
            <label><input type="checkbox" name="area[]" value="37">香川</option></label>
            <label><input type="checkbox" name="area[]" value="38">愛媛</option></label>
            <label><input type="checkbox" name="area[]" value="39">高知</option></label></p>
             <p><h6>九州・沖縄</h6>
            <label><input type="checkbox" name="area[]" value="40">福岡</option></label>
            <label><input type="checkbox" name="area[]" value="41">佐賀</option></label>
            <label><input type="checkbox" name="area[]" value="42">長崎</option></label>
            <label><input type="checkbox" name="area[]" value="43">熊本</option></label>
            <label><input type="checkbox" name="area[]" value="44">大分</option></label>
            <label><input type="checkbox" name="area[]" value="45">宮城</option></label>
            <label><input type="checkbox" name="area[]" value="46">鹿児島</option></label>
            <label><input type="checkbox" name="area[]" value="47">沖縄</option></label></p>
            
            </p>
        </div>

        <div class="col-5">
        <p><h4>条件で探す</h4><br></p>
        <dl>
            <dd>
                <dt>宿タイプ</dt>
                    <select name="inn_type" size="1">
                        <option value="1">シティホテル</option>
                        <option value="2">リゾートホテル</option>
                        <option value="3">ビジネスホテル</option>
                        <option value="4">旅館</option>
                        <option value="5">民宿</option> 
                        <option value="6">ペンション</option>
                    </select>
            </dd>
        </dl>
        <dl>
            <dt>価格</dt>
            <dd>
                <input type="number" name="min_price" placeholder="円">
                <span>～</span>
                <input type="number" name="max_price" placeholder="円">
            </dd>
        </dl>
        <dl>
            <dt>宿泊期間</dt>
            <dd>
                <input type="date" name="check_in" placeholder="日">
                <span>～</span>
                <input type="date" name="check_out" placeholder="日">
            </dd>
        </dl>
        <dl>
            <dt>キーワード</dt>
            <dd><input type="text" name="keyword" placeholder="例)宿名・住所"></dd>
        </dl>
    <p><input type="submit" value="検索"></p>
    </div>

    <div class="col-2">
    <p><h4>今週の<br>おすすめ宿</h4><br></p>
    </div>
    </div>
    </div>
</form>
@endsection