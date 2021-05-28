@extends('commons.template')

@section('content')
<br>
<svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
<form action="{{route('inns.index')}}" method="get">
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col" class="text-center">エリアで探す</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">
                            <p class="text-center text-primary text-primary">北海道・東北</p>
                            <label><input type="checkbox" name="area[]" value="1">北海道</option></label><br>
                            <label><input type="checkbox" name="area[]" value="2">青森</option></label>
                            <label><input type="checkbox" name="area[]" value="3">岩手</option></label>
                            <label><input type="checkbox" name="area[]" value="4">宮城</option></label>
                            <label><input type="checkbox" name="area[]" value="5">秋田</option></label>
                            <label><input type="checkbox" name="area[]" value="6">山形</option></label>
                            <label><input type="checkbox" name="area[]" value="7">福島</option></label>
                        </th>
                    </tr>
                    <tr>    
                        <th scope="row">
                            <p class="text-center text-primary">関東</p>
                            <label><input type="checkbox" name="area[]" value="8">茨城</option></label>
                            <label><input type="checkbox" name="area[]" value="9">栃木</option></label>
                            <label><input type="checkbox" name="area[]" value="10">群馬</option></label>
                            <label><input type="checkbox" name="area[]" value="11">埼玉</option></label>
                            <label><input type="checkbox" name="area[]" value="12">千葉</option></label>
                            <label><input type="checkbox" name="area[]" value="13">東京</option></label>
                            <label><input type="checkbox" name="area[]" value="14">神奈川</option></label>
                        </th>
                    </tr>
                    <tr>    
                        <th scope="row">
                            <p  class="text-center text-primary">北陸</p>
                            <label><input type="checkbox" name="area[]" value="15">新潟</option></label>
                            <label><input type="checkbox" name="area[]" value="16">富山</option></label>
                            <label><input type="checkbox" name="area[]" value="17">石川</option></label>
                            <label><input type="checkbox" name="area[]" value="18">福井</option></label>
                            <label><input type="checkbox" name="area[]" value="19">山梨</option></label>
                            <label><input type="checkbox" name="area[]" value="20">長野</option></label>
                        </th>
                    </tr>
                    <tr>    
                        <th scope="row">
                            <p  class="text-center text-primary">東海</p>
                            <label><input type="checkbox" name="area[]" value="21">岐阜</option></label>
                            <label><input type="checkbox" name="area[]" value="22">静岡</option></label>
                            <label><input type="checkbox" name="area[]" value="23">愛知</option></label>
                            <label><input type="checkbox" name="area[]" value="24">三重</option></label>
                        </th>
                    </tr>
                        <tr>    
                        <th scope="row">
                            <p  class="text-center text-primary">近畿</p>
                            <label><input type="checkbox" name="area[]" value="25">滋賀</option></label>
                            <label><input type="checkbox" name="area[]" value="26">京都</option></label>
                            <label><input type="checkbox" name="area[]" value="27">大阪</option></label>
                            <label><input type="checkbox" name="area[]" value="28">奈良</option></label>
                            <label><input type="checkbox" name="area[]" value="29">兵庫</option></label>
                            <label><input type="checkbox" name="area[]" value="30">和歌山</option></label>
                        </th>
                    </tr>
                        <tr>    
                        <th scope="row">
                            <p  class="text-center text-primary">中国</p>
                            <label><input type="checkbox" name="area[]" value="31">鳥取</option></label>
                            <label><input type="checkbox" name="area[]" value="32">島根</option></label>
                            <label><input type="checkbox" name="area[]" value="33">岡山</option></label>
                            <label><input type="checkbox" name="area[]" value="34">広島</option></label>
                            <label><input type="checkbox" name="area[]" value="35">山口</option></label>
                        </th>
                    </tr>
                    <tr>    
                        <th scope="row">
                            <p  class="text-center text-primary">四国</p>
                            <label><input type="checkbox" name="area[]" value="36">徳島</option></label>
                            <label><input type="checkbox" name="area[]" value="37">香川</option></label>
                            <label><input type="checkbox" name="area[]" value="38">愛媛</option></label>
                            <label><input type="checkbox" name="area[]" value="39">高知</option></label>
                        </th>
                    </tr>
                    <tr>    
                        <th scope="row">
                            <p  class="text-center text-primary">九州・沖縄</p>
                            <label><input type="checkbox" name="area[]" value="40">福岡</option></label>
                            <label><input type="checkbox" name="area[]" value="41">佐賀</option></label>
                            <label><input type="checkbox" name="area[]" value="42">長崎</option></label>
                            <label><input type="checkbox" name="area[]" value="43">熊本</option></label>
                            <label><input type="checkbox" name="area[]" value="44">大分</option></label>
                            <label><input type="checkbox" name="area[]" value="45">宮城</option></label>
                            <label><input type="checkbox" name="area[]" value="46">鹿児島</option></label>
                            <label><input type="checkbox" name="area[]" value="47">沖縄</option></label>
                        </th>
                    </tr>
                </table>
                <button class="btn btn-primary d-block mx-auto" type="submit">検索</button>
            </div>
            <div class="col-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">条件で探す</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">
                                <dl>
                                    <dt>宿タイプ</dt>
                                    <dd>
                                        <select class="form-control" name="inn_type" size="1">
                                            <option value="0">こだわりなし</option>
                                            <option value="1">シティホテル</option>
                                            <option value="2">リゾートホテル</option>
                                            <option value="3">ビジネスホテル</option>
                                            <option value="4">旅館</option>
                                            <option value="5">民宿</option> 
                                            <option value="6">ペンション</option>
                                        </select>
                                    </dd>
                                </dl>
                            </th>
                            </tr>
                            <tr scope="row">
                                <th>
                                <dl>
                                    <dt>価格</dt>
                                    <dd>
                                        <input class="form-control" type="number" name="min_price" placeholder="円">
                                        <span>～</span>
                                        <input class="form-control" type="number" name="max_price" placeholder="円">
                                    </dd>
                                </dl>
                                </th>
                            </tr>
                            <tr scope="row">
                                <th>
                                <dl>
                                    <dt>宿泊期間</dt>
                                    <dd>
                                        <input class="form-control" type="date" name="check_in" min="{{ date('Y-m-d') }}">
                                        <span>～</span>
                                        <input class="form-control" type="date" name="check_out" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                    </dd>
                                </dl>
                                </th>
                            </tr>
                            <tr scope="row">
                                <th>
                                <dl>
                                    <dt>キーワード</dt>
                                    <dd><input class="form-control" type="text" name="keyword" placeholder="例)宿名・住所"></dd>
                                </dl>
                                </th>
                            </tr>
                        </th>
                    </tr>
                </table>
                <button class="btn btn-primary d-block mx-auto" type="submit">検索</button>
            </div>
            <div class="col-4 ">
            <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">今週のおすすめ宿</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                @foreach($inns as $inn)
                                    <div class="card card-body mb-3  text-center border-secondary"  >
                                        <dl>
                                            <dt>宿名</dt>
                                            <dd><a href="{{ route('inns.show', $inn) }}">{{ $inn->name }}</a></dd>
                                        </dl>
                                        <dl>
                                            <dt>住所</dt>
                                            <dd>{{ $inn->address }}</dd>
                                        </dl>
                                        <dl>
                                            <dt>電話番号</dt>
                                            <dd>{{ $inn->tel }}</dd>
                                        </dl>
                                        <dl>
                                            <dt>メールアドレス</dt>
                                            <dd>{{ $inn->email }}</dd>
                                        </dl>
                                        <dl>
                                            <dt>チェックイン</dt>
                                            <dd>{{ date('H:i', strtotime($inn->check_in)) }}</dd>
                                        </dl>
                                        <dl>
                                            <dt>チェックアウト</dt>
                                            <dd>{{ date('H:i', strtotime($inn->check_out)) }}</dd>
                                        </dl>
                                    </div>
                                @endforeach
                            </th>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection