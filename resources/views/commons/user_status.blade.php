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