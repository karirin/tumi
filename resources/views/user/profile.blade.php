@extends('layouts.top')
@section('title', 'pair code')
@section('header')
@parent
@endsection
@section('content')
<<<<<<< HEAD
<form method="post" action="{{ asset('user/edit') }}" class="profile_top_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="current_name" value="{{$current_user->name}}">
    <input type="hidden" name="current_age" value="{{$current_user->age}}">
    <input type="hidden" name="current_occupation" value="{{$current_user->occupation}}">
    <input type="hidden" name="current_address" value="{{$current_user->address}}">
    <input type="hidden" name="current_skill" value="{{$current_user->skill}}">
    <input type="hidden" name="current_licence" value="{{$current_user->licence}}">
    <input type="hidden" name="current_workhistory" value="{{$current_user->workhistory}}">
    <div id="splash">Loading...</div>
    <div class="profile_top" style="display: none;">
        <h3 class="page_title profile_title">プロフィール</h3>
        <div class="tag" style="display: block;">
            <div class="row">
                <div class="col-6">
                    <img src="{{asset($current_user->image)}}" class="mypage" style="margin-top: 1rem;">
                    <h3 class="profile_name_prof">{{$current_user->name}}</h3>
                    <input type="hidden" class="current_user_id" value="{{$current_user->id}}">
                    <input type="hidden" value="{{$current_user->id}}">
                    <div class="tags" style="width: 60%;">
=======
<div class="container">
    <form method="post" action="{{ asset('user/edit') }}" class="profile_top_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="current_name" value="{{$current_user->name}}">
        <input type="hidden" name="current_age" value="{{$current_user->age}}">
        <input type="hidden" name="current_occupation" value="{{$current_user->occupation}}">
        <input type="hidden" name="current_address" value="{{$current_user->address}}">
        <input type="hidden" name="current_skill" value="{{$current_user->skill}}">
        <input type="hidden" name="current_licence" value="{{$current_user->licence}}">
        <input type="hidden" name="current_workhistory" value="{{$current_user->workhistory}}">
        <div id="splash"></div>
        <div class="profile_top" style="height: 93%;margin-left: 19%;padding-left: 3rem;width:70%;display: none;">
            <h3 class="page_title profile_title">プロフィール</h3>
            <div class="tag" style="display: block;">
                <div class="row profile_top">
                    <div class="col-3">
                        <img src="{{asset($current_user->image)}}" class="mypage" style="margin-top: 1rem;">
                        <h3 class="profile_name_prof">{{$current_user->name}}</h3>
                        <input type="hidden" class="current_user_id" value="{{$current_user->id}}">
                        <input type="hidden" value="{{$current_user->id}}">
                        <div class="age" style="margin-bottom: 1rem;">
                            <p class="tag_tittle">年齢</p>
                            <div class="user_age">{{$current_user->age}}歳</div>
                        </div>
                        <div class="address" style="margin-bottom: 1rem;">
                            <p class="tag_tittle" style="display: inline-block;">住所</p>
                            <div class="user_address">{{$current_user->address}}</div>
                        </div>
                        <div class="occupation" style="margin-bottom: 1rem;">
                            <p class="tag_tittle" style="display: inline-block;">職種</p>
                            <div class="user_occupation">{{$current_user->occupation}}</div>
                        </div>
                    </div>
                    <div class="col-8" style="margin-top: 1rem;margin-left: 1rem;">
                        <div class="tags">
                            <div class="tag_skill" style="margin-bottom: 1rem;">
                                <p class="tag_tittle" style="margin-top: 0;">スキル</p>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($skills as $skill)@if($skill!='')
                                @if (3 <= $i) <span id="child-span_myprofile" class="skill_tag extra" style="display: none;">
                                    {{$skill}}</span>
                                    @else
                                    <span id="child-span_myprofile" class="skill_tag">{{$skill}}</span>
                                    @endif
                                    @php
                                    $i++
                                    @endphp
                                    @endif
                                    @endforeach
                                    <i class="fas fa-plus skill_btn"></i>
                            </div>
                            <div class="tag_licence" style="margin-bottom: 1rem;">
                                <p class="tag_tittle">取得資格</p>
                                @php
                                $j = 0;
                                @endphp
                                @foreach ($licences as $licence)
                                @if($licence!='')
                                @if (3 <= $j) <span id="child-span" class="licence_tag extra" style="display: none;">
                                    {{$licence}}</span>
                                    @else
                                    <span id="child-span" class="licence_tag">{{$licence}}</span>
                                    @endif
                                    @php
                                    $j++
                                    @endphp
                                    @endif
                                    @endforeach
                                    <i class="fas fa-plus licence_btn"></i>
                            </div>
                        </div>
>>>>>>> 29e5689a371c8c7fa23ec3daed1644895d121451
                        <div class="profile" style="margin-bottom: 1rem;">
                            <p class="tag_tittle">自己紹介</p>
                            <p class="user_profile" style="width: 70%;">{{$current_user->profile}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <input type="button" class="chart_btn" value="月別">
                    <span id="year_pulldown"></span>
                    <span id="month_pulldown" style="display: none;"></span>
                    <canvas id="tumi"></canvas>
                </div>
                <button class="btn btn btn-outline-dark profile_edit_btn" type="button" name="follow">プロフィール編集</button>
            </div>
<<<<<<< HEAD
        </div>
        <div class="form" style="width: 100%;">
            <div class="row">
                <div class="col-4">
                    <div class="edit_profile_img">
                        <label style="position: absolute;z-index: 10;top: 10%;left: 19%;">
                            <div class="fa-image_range">
                                <i class="far fa-image"></i>
                            </div>
                            <input type="file" name="image_name" id="edit_profile_img" accept="image/*" multiple>
                        </label>
                        <img class="editing_profile_img" src="{{asset($current_user->image)}}" name="profile_image">
                        <label>
                            <i class="far fa-times-circle profile_clear"></i>
                            <input type="button" id="profile_clear">
                        </label>
                    </div>
                    <h3 class="profile_name">{{$current_user->name}}</h3>
                    <div class="background">
                        <p class="tag_tittle">自己紹介</p>
                        <p class="edit_profile">{{$current_user->workhistory}}</p>
                    </div>
                </div>
                <div class="col-8">
                    <div class="edit_btns">
                        <input type="submit" class="btn btn-outline-dark edit_done" value="編集完了">
                        <button class="btn btn-outline-dark profile_close" type="button">閉じる</button>
                        <button class="btn btn-outline-dark profile_narrow_close" type="button">閉じる</button>
=======
            <div class="form" style="width: 100%;">
                <div class="row">
                    <div class="col-4">
                        <div class="edit_profile_img">
                            <label style="position: absolute;z-index: 10;top: 10%;left: 23%;">
                                <div class="fa-image_range">
                                    <i class="far fa-image"></i>
                                </div>
                                <input type="file" name="image_name" id="edit_profile_img" accept="image/*" multiple>
                            </label>
                            <img class="editing_profile_img" src="{{asset($current_user->image)}}" name="profile_image">
                            <label>
                                <i class="far fa-times-circle profile_clear"></i>
                                <input type="button" id="profile_clear">
                            </label>
                        </div>
                        <div class="user_name">
                            <p class="tag_tittle">名前</p>
                            <h3 class="profile_name">{{$current_user->name}}</h3>
                        </div>
                        <div class="user_name_narrow" style="display: none;">
                            <span class="tag_tittle" style="margin-right: 7rem;">名前</span>
                            <h3 class="profile_name_narrow">{{$current_user->name}}</h3>
                        </div>
                        <div class="user_age">
                            <p class="tag_tittle" style="margin-top: 0.5rem;">年齢</p>
                            <div class="age">{{$current_user->age}}</div>歳
                        </div>
                        <div class="user_address">
                            <p class="tag_tittle" style="display: inline-block;">住所</p>
                            <div class="address">{{$current_user->address}}</div>
                        </div>
                        <div class="user_occupation">
                            <p class="tag_tittle" style="display: inline-block;">職種</p>
                            <div class="occupation">{{$current_user->occupation}}</div>
                        </div>
                    </div>
                    <div class="col-8">
                        <p class="tag_tittle">スキル</p>
                        <div id="myprofile_skill" style="width: 60%;">
                            @php
                            $k = 0;
                            @endphp
                            @foreach($skills as $skill)@if($skill!='')@if(3 <= $k)<span id="child-span_myprofile" class="skill_tag extra" style="display: none;">
                                {{$skill}}<label><input type="button" style="display:none;"><i class="far  fa-times-circle skill_myprofile"></i></label></span>
                                @else<span id="child-span_myprofile" class="skill_tag">{{$skill}}<label><input type="button" style="display:none;"><i class="far  fa-times-circle skill_myprofile"></i></label></span>
                                @endif
                                @endif
                                @php
                                $k++
                                @endphp
                                @endforeach<i class="fas fa-plus myprofile_skill_btn"></i>
                        </div>
                        <input placeholder="PHP　JavaScript" name="skills" id="skill_myprofile_input" style="display:block;" />
                        <div class="skill_smartphone" style="display:none;">
                            <input type="hidden" class="skill_select">
                            <div class="image_size" style="font-size:0.9rem;">※スキル単位で半角スペースを空けてください</div>
                        </div>
                        <input type="hidden" name="myprofile_skills" id="myprofile_skills">
                        <input type="hidden" name="skill_count" id="myprofile_skill_count">
                        <input type="hidden" name="myskills" class="myskills" value="{{$current_user->skill}}">
                        <p class="tag_tittle">取得資格</p>
                        <div id="licence">
                            @php
                            $l = 0;
                            @endphp
                            @foreach ($licences as $licence)@if($licence!='')@if(3 <= $l)<span id="child-span" class="licence_tag extra" style="display: none;">{{$licence}}<label><input type="button" style="display:none;"><i class="far fa-times-circle licence"></i></label></span>@else
                                <span id="child-span" class="licence_tag">{{$licence}}<label><input type="button" style="display:none;"><i class="far fa-times-circle licence"></i></label></span>
                                @endif
                                @endif
                                @php
                                $l++
                                @endphp
                                @endforeach<i class="fas fa-plus myprofile_licence_btn"></i>
                        </div>
                        <input placeholder="ITパスポート　基本情報技術者" name="name" id="licence_input" />
                        <div class="licence_smartphone" style="display:none;">
                            <input type="hidden" class="licence_select">
                            <div class="image_size" style="font-size:0.9rem;">※資格単位で半角スペースを空けてください</div>
                        </div>
                        <input type="hidden" name="myprofile_licences" id="myprofile_licences">
                        <input type="hidden" name="licence_count" id="licence_count">
                        <input type="hidden" name="mylicences" class="mylicences" value="{{$current_user->licence}}">
                        <div class="background">
                            <p class="tag_tittle">自己紹介</p>
                            <p class="edit_profile">{{$current_user->workhistory}}</p>
                        </div>
                        <div class="background">
                            <p class="tag_tittle">職歴</p>
                            <p class="workhistory">{{$current_user->workhistory}}</p>
                            <div class="error_workhistory" style="display: none;">
                                <span style="color:rgb(220, 53, 69);">100文字以内で入力してください</span>
                            </div>
                        </div>
                        <div class="edit_btns">
                            <button class="btn btn-outline-dark profile_close profile" type="button">閉じる</button>
                            <input type="submit" class="btn btn-outline-dark edit_done" value="編集完了">
                            <button class="btn btn-outline-dark profile_narrow_close" type="button">閉じる</button>
                        </div>
>>>>>>> 29e5689a371c8c7fa23ec3daed1644895d121451
                    </div>
                </div>
            </div>
        </div>

</form>
@endsection
@section('footer')
@parent
<script>
    window.onload = function() {
        setTimeout(function() {
            $(".profile_top").css("display", "inline-block");
        }, 840);
        $("#splash").delay(100).fadeOut('slow');
        const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
        const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
        const day = [];
        const tumi_number = [];
        /* ///////////////////////// */


        /*      　　　月間　          */


        /* ///////////////////////// */

        for (var $i = 0; $i < 12; $i++) {
            tumi_number[$i] = 0;
        }
        tumi_keys.forEach(el => {
            const tumi_data = Object.values(tumis[el]);
            if (tumi_data[4] == 2023) {
                tumi_number[tumi_data[5] - 1]++;
            }
        });
        let context = document.querySelector("#tumi").getContext('2d');
        myChart = new Chart(context, {
            type: 'line',
            data: {
                labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                datasets: [{
                    label: "2023年",
                    data: tumi_number,
                    borderColor: '#ff6347',
                    backgroundColor: '#ff6347',
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: { // 目盛り
                            min: 0, // 最小値
                            max: 25, // 最大値
                            stepSize: 5, // 軸間隔
                            fontColor: "blue", // 目盛りの色
                            fontSize: 14 // フォントサイズ
                        }
                    }]
                }
            }
        });

        $(function() {
            // 現在日時
            var current = new Date();

            var year_val = current.getFullYear();
            var month_val = current.getMonth() + 1;

            // プルダウン生成
            $('#year_pulldown').html('<select name="year">');
            // 昇順
            for (var i = 2023; i <= year_val + 1; i++) {
                $('#year_pulldown select').append('<option value="' + i + '">' + i + '</option>');
            }
            $('#year_pulldown').append('年');

            $('#month_pulldown').html('<select name="month">');
            for (var i = 1; i <= 12; i++) {
                $('#month_pulldown select').append('<option value="' + i + '">' + i + '</option>');
            }
            $('#month_pulldown').append('月');

            // デフォルト
            $('select[name=year] option[value=' + year_val + ']').prop('selected', true);
            $('select[name=month] option[value=' + month_val + ']').prop('selected', true);
        });
    }

    $(document).on('click', ".chart_btn", function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        if (myChart) {
            myChart.destroy();
        }
        $.ajax({}).done(function(data) {
            const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
            const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
            const day = [];
            const tumi_number = [];
            $year = $('[name=year]').val();
            $month = $('[name=month]').val();
            if ($('.chart_btn').val() == '月別') {
                $('.chart_btn').val('日別');
                $('#month_pulldown').show();
                for (var $i = 0; $i < 31; $i++) {
                    tumi_number[$i] = 0;
                }
                tumi_keys.forEach(el => {
                    const tumi_data = Object.values(tumis[el]);
                    if (tumi_data[4] == $year && tumi_data[5] == $month) {
                        tumi_number[tumi_data[6] - 1]++;
                    }
                });
                let context = document.querySelector("#tumi").getContext('2d');
                myChart = new Chart(context, {
                    type: 'line',
                    data: {
                        labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                        datasets: [{
                            label: $year,
                            data: tumi_number,
                            borderColor: '#ff6347',
                            backgroundColor: '#ff6347',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: { // 目盛り
                                    min: 0, // 最小値
                                    max: 25, // 最大値
                                    stepSize: 5, // 軸間隔
                                    fontColor: "blue", // 目盛りの色
                                    fontSize: 14 // フォントサイズ
                                }
                            }]
                        }
                    }
                });
            } else {
                $('.chart_btn').val('月別');
                $('#month_pulldown').hide();
                for (var $i = 0; $i < 12; $i++) {
                    tumi_number[$i] = 0;
                }
                tumi_keys.forEach(el => {
                    const tumi_data = Object.values(tumis[el]);
                    if (tumi_data[4] == $year) {
                        tumi_number[tumi_data[5] - 1]++;
                    }
                });
                let context = document.querySelector("#tumi").getContext('2d');
                myChart = new Chart(context, {
                    type: 'line',
                    data: {
                        labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                        datasets: [{
                            label: $year,
                            data: tumi_number,
                            borderColor: '#ff6347',
                            backgroundColor: '#ff6347',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: { // 目盛り
                                    min: 0, // 最小値
                                    max: 25, // 最大値
                                    stepSize: 5, // 軸間隔
                                    fontColor: "blue", // 目盛りの色
                                    fontSize: 14 // フォントサイズ
                                }
                            }]
                        }
                    }
                });
            }
        }).fail(function() {});
    });

    $(document).on('change', "#year_pulldown", function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        if (myChart) {
            myChart.destroy();
        }
        $.ajax({}).done(function(data) {
            const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
            const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
            const day = [];
            const tumi_number = [];
            if ($('.chart_btn').val() == '月別') {
                $year = $('[name=year]').val();
                $month = $('[name=month]').val();
                $('.chart_btn').val('日別');
                for (var $i = 0; $i < 31; $i++) {
                    tumi_number[$i] = 0;
                }
                tumi_keys.forEach(el => {
                    const tumi_data = Object.values(tumis[el]);
                    if (tumi_data[4] == $year && tumi_data[5] == $month) {
                        tumi_number[tumi_data[6] - 1]++;
                    }
                });
                let context = document.querySelector("#tumi").getContext('2d');
                myChart = new Chart(context, {
                    type: 'line',
                    data: {
                        labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                        datasets: [{
                            label: $year + '年' + $month + '月',
                            data: tumi_number,
                            borderColor: '#ff6347',
                            backgroundColor: '#ff6347',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: { // 目盛り
                                    min: 0, // 最小値
                                    max: 25, // 最大値
                                    stepSize: 5, // 軸間隔
                                    fontColor: "blue", // 目盛りの色
                                    fontSize: 14 // フォントサイズ
                                }
                            }]
                        }
                    }
                });
            } else {
                $year = $('[name=year]').val();
                $('.chart_btn').val('月別');
                for (var $i = 0; $i < 12; $i++) {
                    tumi_number[$i] = 0;
                }
                tumi_keys.forEach(el => {
                    const tumi_data = Object.values(tumis[el]);
                    if (tumi_data[4] == $year) {
                        tumi_number[tumi_data[5] - 1]++;
                    }
                });
                let context = document.querySelector("#tumi").getContext('2d');
                myChart = new Chart(context, {
                    type: 'line',
                    data: {
                        labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                        datasets: [{
                            label: $year + '年',
                            data: tumi_number,
                            borderColor: '#ff6347',
                            backgroundColor: '#ff6347',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: { // 目盛り
                                    min: 0, // 最小値
                                    max: 25, // 最大値
                                    stepSize: 5, // 軸間隔
                                    fontColor: "blue", // 目盛りの色
                                    fontSize: 14 // フォントサイズ
                                }
                            }]
                        }
                    }
                });
            }
        }).fail(function() {});
    });

    $(document).on('change', "#month_pulldown", function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        if (myChart) {
            myChart.destroy();
        }
        $.ajax({}).done(function(data) {
            const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
            const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
            const day = [];
            const tumi_number = [];
            $year = $('[name=year]').val();
            $month = $('[name=month]').val();
            $('.chart_btn').val('日別');
            for (var $i = 0; $i < 31; $i++) {
                tumi_number[$i] = 0;
            }
            tumi_keys.forEach(el => {
                const tumi_data = Object.values(tumis[el]);
                if (tumi_data[4] == $year && tumi_data[5] == $month) {
                    tumi_number[tumi_data[6] - 1]++;
                }
            });
            let context = document.querySelector("#tumi").getContext('2d');
            myChart = new Chart(context, {
                type: 'line',
                data: {
                    labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                    datasets: [{
                        label: $year + '年' + $month + '月',
                        data: tumi_number,
                        borderColor: '#ff6347',
                        backgroundColor: '#ff6347',
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: { // 目盛り
                                min: 0, // 最小値
                                max: 25, // 最大値
                                stepSize: 5, // 軸間隔
                                fontColor: "blue", // 目盛りの色
                                fontSize: 14 // フォントサイズ
                            }
                        }]
                    }
                }
            });
        }).fail(function() {});
    });
</script>
@endsection