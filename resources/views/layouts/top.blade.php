<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @if(app('env') == 'production')
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/match.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/tumi.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/match.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tumi.css') }}" rel="stylesheet">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style src='highlightjs/styles/dracula.css'></style>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4898800212808837" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
</head>

<body style="height: auto;">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('header')
    @if (Auth::check())
    @if(request()->path()!='privacy_poricy' && request()->path()!='terms_of_service' && request()->path()!='user/edit_detail' && request()->path()!='auth/twitter/callback')
    <div class="top_title">
        <nav class="navbar navbar-dark">
            <ul class="main_ul">
                <li class="top_link">
                    <a style="margin: -0.5rem 0 0 -1.2rem;" href="{{ asset('/') }}" class="top_link_header_login">
                        <image src="../storage/top/Pair Code.png" style="width:26.5%;">
                    </a>
                </li>
                <!-- <li class="header_menu_wide"><a class="profile" href="{{ asset('user/profile') }}" style="vertical-align: middle;"><i class="fas fa-users" style="margin-right: 0.5rem;font-size: 1.5rem;"></i>プロフィール編集</a>
                </li>-->
                <li class="header_menu_wide" style="vertical-align: middle;"><a href="{{asset('user/logout')}}" style="vertical-align: middle;"><i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i>ログアウト</a>
                </li>
        </nav>
        <ul style="display: inline-block;width: auto;margin-left: 24rem;vertical-align: middle;z-index: 30;">
            <li class="show_menu" style="margin: 0;"><i class="fas fa-bars" style="font-size: 4rem;margin-left: -1rem;"></i>
                <div class="slide_menu">
                    <a class="modal_close" href="#">
                        <p style="margin-bottom: -2rem;"><i class="fas fa-angle-left" style="font-size: 5rem;"></i></p>
                    </a>
                    <ul>
                        <a href="https://forms.gle/eLx24ykodQaRKqiV9">
                            <li>お問い合わせ</li>
                        </a>
                        <a href="{{ asset('privacy_poricy') }}">
                            <li class="slide_menu_message">
                                プライバシーポリシー
                            </li>
                        </a>
                        <a href="{{ asset('terms_of_service') }}" class="slide_menu_message post_modal">
                            <li>利用規約</li>
                        </a>
                        <a href="https://twitter.com/ryoya3948" class="test_helpbtn">
                            <li>Twitter</li>
                        </a>
                        <li>© 2023 Pair Code.</li>
                    </ul>
                </div>
            </li>
        </ul>
        </li>
        @else
        <div>
            <ul>
                <li class="top_link" style="margin: 0 auto 0 0;">
                    <a sytle="margin: -0.5rem 0 0 -1.2rem;" href="{{ asset('/') }}" class="top_link_header_login">
                        <image src="/storage/top/Pair Code.png" style="width:17.5%;">
                    </a>
                </li>
                @endif


            </ul>
        </div>
        @else


        <nav class="navbar navbar-dark">
            <ul class="main_ul">
                <li class="top_link" style="margin: 0 auto 0 0;">
                    <a sytle="margin: -0.5rem 0 0 -1.2rem;" href="{{ asset('/') }}" class="top_link_header">
                        <image src="../storage/top/Pair Code.png" style="width:40%;">
                    </a>
                </li>
                <li class="header" style="margin: 0;"><a href="{{ asset('user/login') }}" style="vertical-align: middle;"><i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>ログイン</a></li>
                <li class="header" style="margin: 0;"><a href="{{ asset('user/add') }}" style="vertical-align: middle;"><i class="fas fa-user-plus" style="margin-right: 0.5rem;"></i>新規登録</a></li>
            </ul>
        </nav>
        @endif


        @show @yield('profile') <div class="content">
            @yield('content')
        </div>

        @section('footer')
        <div class="modal_match"></div>
        <div class="modal_top"></div>
        <div class="modal_footer"></div>
    </div>

    <p class="match_message">
    </p>

    <div class="footer">
        <a href="https://forms.gle/eLx24ykodQaRKqiV9">お問い合わせ</a> / <a href="{{ asset('privacy_poricy') }}">プライバシーポリシー</a> / <a href="{{ asset('terms_of_service') }}">利用規約</a> /
        <a href="https://twitter.com/ryoya3948">Twitter</a> / <span style="color: white;">© 2023 Pair Code.</span>
    </div>
    <script src=" https://code.jquery.com/jquery-3.4.1.min.js "></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.4.0/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="{{ asset('/js/common.js') }}"></script>
    <script src="{{ asset('/js/match.js') }}"></script>
    <script src="{{ asset('/js/tumi.js') }}"></script>

    @show
</body>


</html>