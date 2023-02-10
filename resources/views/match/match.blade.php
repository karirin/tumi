@extends('layouts.top')
@section('title', 'pair code')
@section('header')
@parent
@endsection
@section('content')
<div id="splash"></div>
<div class="col-9.5 match_top aite_top" style="margin-left: 22%;height: 94%;margin-left: 23%;padding-left: 3rem;display: none;">
    <div class="help_message3" style="display:none;">
        <span class="help-title">マッチングの流れ</span>
        「いいね」ボタンをクリックすると</br>
        マッチングすることができます
    </div>
    <div class="help_message4" style="display:none;">
        <span class="help-title">マッチングの流れ</span>
        「スキップ」ボタンをクリックすると</br>
        マッチングをキャンセルすることができます
    </div>
    <h3 class="page_title match_title">もらったいいね</h3>
    <i class="fa-solid fa-circle-question help_btn" style="position: absolute;right: 3%;top: 8%;font-size: 2rem;"></i>
    <input type="hidden" class="match_sample_user">
    <input type="hidden" class="m_flg" value="{{$current_user->match_flg}}">
    <i class="fa-solid fa-arrow-pointer pointer3" id="pointer3" style="display: none;"></i>
    <i class="fa-solid fa-arrow-pointer pointer4" id="pointer4" style="display: none;"></i>
    <i class="fa-regular fa-circle-xmark help_close" style="display: none;"></i>
    @foreach ($users as $user)
    @if($user_class->check_match($current_user->id,$user->id))
    @if($user_class->check_unmatch($current_user->id,$user->id)==0)
    @if($user_class->check_matchs($current_user->id,$user->id)!=2)
    <div id="match{{$user->id}}" class="match_card card match_user" data-target="#matchuser_{{$user->id}}" data-toggle="matchuser" style="display: flex;">
        <span class="match_card_color" style="display:none;">
            <i class="fa-regular fa-thumbs-up" style="margin:40% 0;font-size: 3rem;">
                <div style="font-size: 1.8rem;font-weight:900;margin-top: 0.5rem;">いいねしました</div>
            </i>
        </span>
        <span class="unmatch_card_color" style="display:none;">
            <i class="fa-solid fa-reply" style="margin:40% 0;font-size: 3rem;">
                <div style="font-size: 1.8rem;font-weight:900;margin-top: 0.5rem;">スキップしました</div>
            </i>
        </span>
        <span class="back_card_color" style="background:linear-gradient(rgb(0 0 0 / 0%) 0, #000 2000px);">
        </span>
        <div id="matchuser_{{$user->id}}" style="height: 100%;">
            <input type="hidden" class="match_flg" value="{{$user->check_match($user->id,$current_user->id)}}">
            <input type="hidden" class="matchs_flg" value="{{$user->check_matchs($user->id,$current_user->id)}}">
            <input type="hidden" class="match_user_id" value="{{$user->id}}">
            <input type="hidden" class="match_user_name" value="{{$user->name}}">
            <input type="hidden" class="match_user_address" value="{{$user->address}}">
            <input type="hidden" class="match_user_occupation" value="{{$user->occupation}}">
            <input type="hidden" class="match_user_skill" value="{{$user->skill}}">
            <input type="hidden" class="match_user_licence" value="{{$user->licence}}">
            <input type="hidden" class="match_user_workhistory" value="{{$user->workhistory}}">
            <div class="match_user_profile" style="display: none;">
                <div>
                    <span class="match_user_age">{{$user->age}}歳</span>
                </div>
                <input type="hidden" class="match_user_prof" value="{{$user->profile}}">
            </div>
            <input type="hidden" class="click_flg" value="1">
            <img src="{{asset($user->image)}}" class="match_user_img" style="width: 100%;height: 100%;border-radius: 8px;">
            <label>
                <i class="far fa-times-circle profile_clear"></i>
                <input type="button" id="profile_clear">
            </label>
            <h3 class="profile_name" style="color: #fff;">{{$user->name}}</h3>
            <input type="hidden" class="unmatch_user_id" value="{{$current_user->id}}">
            <input type="hidden" id="match{{$user->id}}_userid" value="{{$user->id}}">
            <input type="hidden" class="match_user_id" value="{{$current_user->id}}">
        </div>
    </div>
    @endif
    @endif
    @endif
    @endforeach
    <div class="matching_btn">
        <label>
            <div class="fa-image_range fa" style="margin-right: 8rem;">
                <i class="fa-solid fa-reply" style="font-size: 25px;"></i>
            </div>
            <input type="button" id="unmatch_btn" style="display:none;">
        </label>
        <label>
            <div class="fa-image_range fa" style="margin-right: 0;">
                <i class="fas fa-thumbs-up" style="font-size: 25px;"></i>
            </div>
            <input type="button" id="match_btn" style="display:none">
        </label>
    </div>
    <div class="modal_help"></div>
    @endsection
    @section('footer')
    @parent
    <script>
        setTimeout(function() {
            $(".match_top").css("display", "inline-block");
        }, 840);
        if ($('.m_flg').val() == '') {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: 'POST',
                url: '/ajax_m_flg',
                dataType: 'text'
            }).done(function() {
                setTimeout(function() {
                    $('.modal_help').fadeIn();
                    $('#pointer3').addClass('pointer3');
                    $('#match_btn').attr('id', 'sample_match_btn');
                    $('#unmatch_btn').attr('id', 'sample_unmatch_btn');
                    $('#sample_unmatch_btn').prop("disabled", true);
                    $('.help_close').fadeIn();
                    $('.help_message3').fadeIn();
                    $('.match_sample_user').replaceWith('<div id="match0" class="match_card card match_user" data-target="#matchuser_0" data-toggle="matchuser" style="display: flex;z-index:20;pointer-events: none;"><span class="match_card_color" style="display:none;"><i class="fa-regular fa-thumbs-up" style="margin:40% 0;font-size: 3rem;"><div style="font-size: 1.8rem;font-weight:900;margin-top: 0.5rem;">いいねしました</div></i></span><span class="unmatch_card_color" style="display:none;"><i class="fa-solid fa-reply" style="margin:40% 0;font-size: 3rem;"><div style="font-size: 1.8rem;font-weight:900;margin-top: 0.5rem;">スキップしました</div></i></span><span class="back_card_color" style="background:linear-gradient(rgb(0 0 0 / 0%) 0, #000 2000px);"></span><div id="matchuser_0"><img src="../storage/user/sample_user.png" class="match_user_img" style="width: 100%;height: 100%;border-radius: 8px;"><label><i class="far fa-times-circle profile_clear"></i><input type="button" id="profile_clear"></label><h3 class="profile_name" style="color: #fff;">サンプルユーザー</h3></div></div>');
                    $('.matching_btn').css({
                        'z-index': '20'
                    });
                    $('.fa-image_range.fa').css({
                        'background-color': '#fff'
                    });
                    if ($(window).width() <= 980) {
                        setInterval(function() {
                            $('.pointer3').animate({
                                'left': '71%',
                                'top': '77%'
                            });
                            $('.pointer3').fadeOut();
                            $('.pointer3').animate({
                                'left': '63%',
                                'top': '82%'
                            });
                            $('.pointer3').fadeIn();
                        }, 1000);
                    } else {
                        setInterval(function() {
                            $('.pointer3').animate({
                                'left': '61%',
                                'top': '80%'
                            });
                            $('.pointer3').fadeOut();
                            $('.pointer3').animate({
                                'left': '55%',
                                'top': '88%'
                            });
                            $('.pointer3').fadeIn();
                        }, 1000);
                    }
                    $(document).on('click', '#sample_match_btn', function() {
                        $('.profile_name').css({
                            'z-index': '15'
                        });
                        $('.help_message3').fadeOut();
                        $('#pointer3').removeClass('pointer3');
                        $('#pointer3').fadeOut();
                        $('#pointer4').addClass('pointer4');
                        $('.help_message4').fadeIn();
                        $('#match0 > .match_card_color').fadeIn();
                        $('#sample_match_btn').prop("disabled", true);
                        $('#sample_unmatch_btn').prop("disabled", false);
                        $('#match0')[0].animate({
                            "marginLeft": "50px",
                            transform: 'rotate(50deg)'
                        }, 1000);
                        if ($(window).width() <= 980) {
                            setInterval(function() {
                                $('.pointer4').animate({
                                    'left': '35%',
                                    'top': '77%'
                                });
                                $('.pointer4').fadeOut();
                                $('.pointer4').animate({
                                    'left': '27%',
                                    'top': '82%'
                                });
                                $('.pointer4').fadeIn();
                            }, 1000);
                        } else {
                            setInterval(function() {
                                $('.pointer4').animate({
                                    'left': '46%',
                                    'top': '80%'
                                });
                                $('.pointer4').fadeOut();
                                $('.pointer4').animate({
                                    'left': '40%',
                                    'top': '88%'
                                });
                                $('.pointer4').fadeIn();
                            }, 1000);
                        }
                        $(document).on('click', '#sample_unmatch_btn', function() {
                            $('#pointer4').removeClass('pointer4');
                            $('#pointer4').fadeOut();
                            $('#match0 > .match_card_color').fadeOut();
                            $('#match0 > .unmatch_card_color').fadeIn();
                            $('#match0')[0].animate({
                                "marginLeft": "-50px",
                                transform: 'rotate(-50deg)'
                            }, 1000);
                            $('#sample_unmatch_btn').prop("disabled", true);
                        });
                    });
                    $(document).on('click', ".help_close", function() {
                        $('.content').css('position', 'unset');
                        $('#sample_match_btn').prop("disabled", false);
                        $('#sample_unmatch_btn').prop("disabled", false);
                        $('#sample_match_btn').attr('id', 'match_btn'); //最後にこれを設定するとチュートリアル中に押した場合、イベントが発生してしまう
                        $('#sample_unmatch_btn').attr('id', 'unmatch_btn'); //最後にこれを設定するとチュートリアル中に押した場合、イベントが発生してしまう
                        $('#match0').replaceWith('<input type="hidden" class="match_sample_user">');
                        $('.modal_help').fadeOut();
                        $('.fa-image_range.fa').css({
                            'background-color': 'unset'
                        });
                        $('.help_close').fadeOut();
                        $('#pointer3').removeClass('pointer3');
                        $('#pointer3').fadeOut();
                        $('#pointer4').removeClass('pointer4');
                        $('#pointer4').fadeOut();
                        $('.help_message3').fadeOut();
                        $('.help_message4').fadeOut();
                        $('.profile_name').css({
                            'z-index': '0'
                        });
                    });
                }, 840);
            }).fail(function() {});
        }
        // ヘルプボタンクリック時
        $(document).on('click', '.help_btn', function() {
            $('.modal_help').fadeIn();
            $('#pointer3').addClass('pointer3');
            $('#match_btn').attr('id', 'sample_match_btn');
            $('#unmatch_btn').attr('id', 'sample_unmatch_btn');
            $('#sample_unmatch_btn').prop("disabled", true);
            $('.help_close').fadeIn();
            $('.help_message3').fadeIn();
            $('.match_sample_user').replaceWith('<div id="match0" class="match_card card match_user" data-target="#matchuser_0" data-toggle="matchuser" style="display: flex;z-index:20;pointer-events: none;"><span class="match_card_color" style="display:none;"><i class="fa-regular fa-thumbs-up" style="margin:40% 0;font-size: 3rem;"><div style="font-size: 1.8rem;font-weight:900;margin-top: 0.5rem;">いいねしました</div></i></span><span class="unmatch_card_color" style="display:none;"><i class="fa-solid fa-reply" style="margin:40% 0;font-size: 3rem;"><div style="font-size: 1.8rem;font-weight:900;margin-top: 0.5rem;">スキップしました</div></i></span><span class="back_card_color" style="background:linear-gradient(rgb(0 0 0 / 0%) 0, #000 2000px);"></span><div id="matchuser_0"><img src="../storage/user/sample_user.png" class="match_user_img" style="width: 100%;height: 100%;border-radius: 8px;"><label><i class="far fa-times-circle profile_clear"></i><input type="button" id="profile_clear"></label><h3 class="profile_name" style="color: #fff;">サンプルユーザー</h3></div></div>');
            $('.matching_btn').css({
                'z-index': '20'
            });
            $('.fa-image_range.fa').css({
                'background-color': '#fff'
            });
            if ($(window).width() <= 980) {
                setInterval(function() {
                    $('.pointer3').animate({
                        'left': '71%',
                        'top': '77%'
                    });
                    $('.pointer3').fadeOut();
                    $('.pointer3').animate({
                        'left': '63%',
                        'top': '82%'
                    });
                    $('.pointer3').fadeIn();
                }, 1000);
            } else {
                setInterval(function() {
                    $('.pointer3').animate({
                        'left': '61%',
                        'top': '80%'
                    });
                    $('.pointer3').fadeOut();
                    $('.pointer3').animate({
                        'left': '55%',
                        'top': '88%'
                    });
                    $('.pointer3').fadeIn();
                }, 1000);
            }
            $(document).on('click', '#sample_match_btn', function() {
                $('.profile_name').css({
                    'z-index': '15'
                });
                $('.help_message3').fadeOut();
                $('#pointer3').removeClass('pointer3');
                $('#pointer3').fadeOut();
                $('#pointer4').addClass('pointer4');
                $('.help_message4').fadeIn();
                $('#match0 > .match_card_color').fadeIn();
                $('#sample_match_btn').prop("disabled", true);
                $('#sample_unmatch_btn').prop("disabled", false);
                $('#match0')[0].animate({
                    "marginLeft": "50px",
                    transform: 'rotate(50deg)'
                }, 1000);
                if ($(window).width() <= 980) {
                    setInterval(function() {
                        $('.pointer4').animate({
                            'left': '35%',
                            'top': '77%'
                        });
                        $('.pointer4').fadeOut();
                        $('.pointer4').animate({
                            'left': '27%',
                            'top': '82%'
                        });
                        $('.pointer4').fadeIn();
                    }, 1000);
                } else {
                    setInterval(function() {
                        $('.pointer4').animate({
                            'left': '46%',
                            'top': '80%'
                        });
                        $('.pointer4').fadeOut();
                        $('.pointer4').animate({
                            'left': '40%',
                            'top': '88%'
                        });
                        $('.pointer4').fadeIn();
                    }, 1000);
                }
                $(document).on('click', '#sample_unmatch_btn', function() {
                    $('#pointer4').removeClass('pointer4');
                    $('#pointer4').fadeOut();
                    $('#match0 > .match_card_color').fadeOut();
                    $('#match0 > .unmatch_card_color').fadeIn();
                    $('#match0')[0].animate({
                        "marginLeft": "-50px",
                        transform: 'rotate(-50deg)'
                    }, 1000);
                    $('#sample_unmatch_btn').prop("disabled", true);
                });
            });
            $(document).on('click', ".help_close", function() {
                $('#sample_match_btn').prop("disabled", false);
                $('#sample_unmatch_btn').prop("disabled", false);
                $('#sample_match_btn').attr('id', 'match_btn'); //最後にこれを設定するとチュートリアル中に押した場合、イベントが発生してしまう
                $('#sample_unmatch_btn').attr('id', 'unmatch_btn'); //最後にこれを設定するとチュートリアル中に押した場合、イベントが発生してしまう
                $('#match0').replaceWith('<input type="hidden" class="match_sample_user">');
                $('.modal_help').fadeOut();
                $('.fa-image_range.fa').css({
                    'background-color': 'unset'
                });
                $('.help_close').fadeOut();
                $('#pointer3').removeClass('pointer3');
                $('#pointer3').fadeOut();
                $('#pointer4').removeClass('pointer4');
                $('#pointer4').fadeOut();
                $('.help_message3').fadeOut();
                $('.help_message4').fadeOut();
                $('.profile_name').css({
                    'z-index': '0'
                });
            });
        });
    </script>
    @endsection