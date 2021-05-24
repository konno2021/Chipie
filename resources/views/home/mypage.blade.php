@extends('commons.template')

@section('content')
 <div class="container">
    <div class="row">
        <div class="col-6">
        <p><h4>アカウント情報</h4><br></p>
        <dl>
            <dd>
                <dt>名前</dt>
                {{ Auth::user()->name }}
            </dd>
        </dl>
        <dl>
            <dt>住所</dt>
            <dd>
                {{ Auth::user()->address }}
            </dd>
        </dl>
        <dl>
            <dt>メールアドレス</dt>
            <dd>
                {{ Auth::user()->email }}
            </dd>
        </dl>
        <dl>
            <dt>生年月日</dt>
            <dd>
                {{ Auth::user()->birthday }}
            </dd>
        </dl>
        {{-- <dl>
            <dt>パスワード</dt>
            <dd>
                {{ Auth::user()->password }}
            </dd>
        </dl> --}}
        <p>
        <a href={{ route('users.edit', Auth::user()) }}>編集する</a>
        <a href={{ route('users.destroy', Auth::user()) }} onclick="deleteUser()">削除する</a>
        <form action="{{ route('users.destroy', Auth::user()) }}" method="post" id="delete-form">
        @csrf
        @method('delete')
        </form>
            <script type="text/javascript">
                function deleteUser() {
                    event.preventdefault();
                    if (window.confirm('本当に削除しますか？')) {
                        document.getElementById('delete-form').submit();
                    }
                }   
            </script>
        </p>
        </div>

        <div class="col-6">
        <p><h4>〇〇様の予約履歴</h4></p>
            {{-- @foreach($reservations as $reservation) 
            @endforeach --}}
        <a href="/">検索画面へ</a>
        </div>
    </div>
    </div>
@endsection