<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <header>
        {{-- 非会員と会員 --}}
        <?php
            $user_status = -1;

            if(Auth::check() === false){
                $user_status = 0;  // 非会員
            }
            else if(Auth::user()->inn_id !== null){
                $user_status = 2;  // 宿管理者
            }
            else if(Auth::user()->is_admin){
                $user_status = 3;    // 管理者
            }
            else{
                $user_status = 1;
            }
        ?>
        @if($user_status === 0 || $user_status === 1)
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Chipie</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link <?php if($user_status === 1) {echo 'disabled';} ?>" href="#">ログイン</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?php if($user_status === 1) {echo 'disabled';} ?>" href="#">会員登録</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?php if($user_status === 0) {echo 'disabled';} ?>" href="#">マイページ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?php if($user_status === 0) {echo 'disabled';} ?>" href="#">ログアウト</a>
                    </li>
                </ul>
                </div>
            </nav>
        @endif
        @yield('content')
        <footer id="footer" class="footer bg-dark text-center pt-3 pb-2">
            <a class="text-light" href="#">宿アカウント登録申請画面</a>
            <p class="text-white-50 pt-2 mb-0">Copyright © 2021 1班(しぴ) Inc.</p>
        </footer>
    </header>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
</body>
</html>