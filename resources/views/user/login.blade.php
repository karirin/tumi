@extends('layouts.top')
@section('title', 'pair code')
@section('header')
@parent
@endsection
@section('content')
<div class="row">
    <div class="col-6 offset-3 center user_login_top">
        <h2 style="margin-top: 2rem;">ログイン</h2>
        <form action="/user/login" method="post">
            @csrf
            <div class="user_title">ユーザー名</div>
            <input type="text" name="name" class="user_name_input form-control" autocomplete="off">
            <div class="error_name_form" style="height: 27px;text-align:left;margin: 0 20%;">
                <span class="user_name_error" style="display:none;color: #dc3545;">ユーザー名を入力してください</span>
            </div>
            <div class="user_title">パスワード</div>
            <input type="password" name="password" class="user_pass_input form-control" autocomplete="off">
            <div class="error_pass_form" style="height: 27px;text-align:left;margin: 0 20%;">
                <span class="user_pass_error" style="display:none;color: #dc3545;">パスワードを入力してください</span>
            </div>
            <div class="flex_btn" style="margin-top: 0.5rem;">
                <input class="btn btn-outline-dark edit_detail_top_btn" type="button" onclick="history.back()" value="戻る">
                <input class="btn btn-outline-info submit_btn edit_detail_top_btn" type="submit" value="ログイン">
            </div>
        </form>
        <a href="/auth/twitter" class="btn-social-long-twitter">
            <i class="fa-brands fa-twitter edit_detail_top_btn" style="margin-right: 1rem;"></i><span class="twitter_login">Twitterでログイン</span>
        </a>
    </div>

</div>

<p class="login_message">{{$message}}</p>
@endsection
@section('footer')
@parent
@endsection