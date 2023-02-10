<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @if(app('env') == 'production')
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/match.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/match.css') }}" rel="stylesheet">
    @endif
</head>

<body>
    <div class="saling_mail" style="text-align: center;">
        <h2>Pair Codeへのご登録ありがとうございます！</h2>
        <span>下のURLをクリックして、メールアドレスの認証を完了してください。</span>
        <div style="text-align: center;"><a href="{{$url}}" class="btn-square">認証を完了する</a></div>
    </div>
</body>