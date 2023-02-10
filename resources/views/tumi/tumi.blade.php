@extends('layouts.top')
@section('title', 'pair code')
@section('header')
@parent
@endsection
@section('content')
<div class="modal_help"></div>
<div id="splash"></div>
<i class="fa-solid fa-circle-plus tumi_plus"></i>
<i class="fa-regular fa-circle-xmark tumi_detail_close" style="display: none;"></i>
<div class="row tumi_top" style="display: none;">
    <div class="col-10 offset-1">
        <h3 class="page_title serach tumi_tittle">積み上げ内容</h3>
        @foreach ($tumis as $tumi)
        @if($tumi->goal_id==$goal_id)
        <div class="tumi" data-target="#tumi_{{$tumi->id}}" data-toggle="tumi">
            <div id="tumi_{{$tumi->id}}">
                <span class="tumi_image"><img src="{{asset($tumi->image)}}"></span>
                <span class="tumi_tittle">{{$tumi->tittle}}</span>
                <span class="tumi_text">{!! GitDown::parseAndCache($tumi->text) !!}</span>
            </div>
        </div>
        @endif
        @endforeach
        <div class="row">
            <div class="col-6 m-1">
                <textarea name="body" id="markdown_editor_textarea" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="col-6 m-1">
                <div id="markdown_preview"></div>
            </div>
        </div>
        <div class="post-page-footer">
            <input type="submit" class="post-button m-1" value="投稿">
        </div>
    </div>
</div>
<div class="tumi_add" style="display:none;">
    <form method="post" action="{{ asset('tumi/add') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div>タイトル</div>
                <input type="text" name="tumi_tittle" class="tumi_tittle_add">
                <div class="error_text_form" style="height: 27px;text-align:left;margin: 0 20%;">
                    <span class="tumi_tittle_error" style="display:none;color: #dc3545;">タイトルを入力してください</span>
                </div>
                <div style="margin-top: 1rem;">積み上げた内容</div>
                <textarea type="text" name="tumi_text" class="tumi_text_add" style="width: 88%;"></textarea>
                <div class="error_text_form" style="height: 27px;text-align:left;margin: 0 20%;">
                    <span class="tumi_text_error" style="display:none;color: #dc3545;">積み上げた内容を入力してください</span>
                </div>
            </div>
            <div class="col-6">
                <div>画像</div>
                <div class=" post_btn" style="justify-content: unset;">
                    <label>
                        <i class="far fa-image"></i>
                        <input type="file" name="image" id="my_image" style="display:none;">
                    </label>
                </div>
                <div class="image_size" style="font-size:0.9rem;">※（縦横200px×200px以上推奨、5MB未満）</div>
                <p class="preview_img"><img class="my_preview"></p>
                <input type="button" id="my_clear" value="ファイルをクリアする">
            </div>
        </div>
        <button class="btn btn-outline-primary tumi_submit" name="post" value="post" id="post">送信</button>
        <input type="hidden" name="goal_id" value="{{$goal_id}}">
    </form>
</div>
<div class="tumi_detail" style="display:none;">
    <img class="tumi_img">
    <div>タイトル</div>
    <div class="tumi_tittle_detail"></div>
    <div>積み上げ内容</div>
    <div class="tumi_text_detail"></div>
    <input type="hidden" name="tumi_id" class="tumi_id" value>
</div>

<!-- <div class="matchuser_detaile">
    <i class="far fa-times-circle profile_close" style="display:inline;top: -11.5%;"></i>
    <img class="matchuser_img">
    <div style="padding: 1rem;">
        <div class="matchuser_name"></div>
        <span class="matchuser_age"></span>
        <span class="matchuser_address"></span>
        <span class="matchuser_occupation"></span>
        <div class="matchuser_profile"></div>
        <div style="text-align:right;">
            <a href="#" class="match_good_btn" id="match_good_btn"><i class="fas fa-thumbs-up"></i>いいね</a>
            <a href="#" class="good_btn" id="good_btn" style="display: none;"><i class="fas fa-thumbs-up"></i>いいね</a>
            <input type="hidden" class="user_id">
            <input type="hidden" class="matchs_flg">
        </div>
    </div>
</div> -->
<!-- <div class="matchuser_detaile_prof">
    <div style="padding: 1rem;">
        <h6>スキル</h6>
        <div class="matchuser_skill"></div>
        <h6 style="margin-top: 1rem;">資格</h6>
        <span class="matchuser_licence"></span>
        <h6 style="margin-top: 1rem;">職歴</h6>
        <span class="matchuser_workhistory"></span>
    </div>
</div> -->

@endsection
@section('footer')
@parent
<script>
    // import marked from 'marked';

    // // マークダウンをプレビュー画面に表示する
    // $(function() {
    //     marked.setOptions({
    //         langPrefix: '',
    //         breaks: true,
    //         sanitize: true,
    //     });

    //     $('#markdown_editor_textarea').keyup(function() {
    //         var html = marked(getHtml($(this).val()));
    //         $('#markdown_preview').html(html);
    //     });

    //     //マークダウンをHTMLに変換する
    //     var target = $('.item-body')
    //     var html = marked(getHtml(target.html()));
    //     $('.item-body').html(html);

    //     // 比較演算子が &lt; 等になるので置換
    //     function getHtml(html) {
    //         html = html.replace(/&lt;/g, '<');
    //         html = html.replace(/&gt;/g, '>');
    //         html = html.replace(/&amp;/g, '&');
    //         return html;
    //     }
    // });

    setTimeout(function() {
        $(".tumi_top").css("display", "flex");
    }, 840);

    // タイトル入力処理
    $(document).on('click', '.tumi_detail .tumi_tittle_detail', function() {
        var $tumi_id = $('.tumi_detail .tumi_id')[0].value,
            $tumi_tittle = $('.tumi_detail .tumi_tittle_detail')[0].textContent;
        //$tumi_text = $('.tumi_detail .tumi_text_detail')[0].textContent;
        $(this).replaceWith('<textarea type="text" name="text" id="edit_tumi_' + $tumi_id + '" class="edit_tumi" style="width: 100%;">' + $tumi_tittle);
        $('#edit_tumi_' + $tumi_id).on('mouseout', function(e) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var edit_tumi_tittle = $('#edit_tumi_' + $tumi_id).val();
            if (edit_tumi_tittle == '') {
                $('#edit_tumi_' + $test_id)[0].setAttribute("style", "border-color: #dc3545;border-style: solid;width: 100%;");
                $('.tumi_disp .tumi_error').fadeIn();
                $('.tumi_disp .tumi_clear')[0].disabled = true;
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '/ajax_edit_tittle',
                dataType: 'text',
                data: {
                    tumi_id: $tumi_id,
                    tumi_tittle: edit_tumi_tittle
                }
            }).done(function() {
                $('#edit_tumi_' + $tumi_id).replaceWith('<span class="tumi_tittle_detail">' + edit_tumi_tittle + '</span>');
                //$('#tumi_' + $tumi_id + ' .testcase_text').replaceWith('<span class="tumi_text">' + edit_tumi_text + '</span>');
                $('.testcase_disp .testcase_clear')[0].disabled = false;
                $('.testcase_disp .testcase_error').fadeOut();
            }).fail(function() {});
        });
    });

    // 積み上げ内容入力処理
    $(document).on('click', '.tumi_detail .tumi_text_detail', function() {
        var $tumi_id = $('.tumi_detail .tumi_id')[0].value,
            $tumi_text = $('.tumi_detail .tumi_text_detail')[0].textContent;
        //$tumi_text = $('.tumi_detail .tumi_text_detail')[0].textContent;
        $(this).replaceWith('<textarea type="text" name="text" id="edit_tumi_text_' + $tumi_id + '" class="edit_tumi" style="width: 100%;">' + $tumi_text);
        $('#edit_tumi_text_' + $tumi_id).on('mouseout', function(e) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var edit_tumi_text = $('#edit_tumi_text_' + $tumi_id).val();
            if (edit_tumi_text == '') {
                $('#edit_tumi_text_' + $test_id)[0].setAttribute("style", "border-color: #dc3545;border-style: solid;width: 100%;");
                $('.tumi_disp .tumi_error').fadeIn();
                $('.tumi_disp .tumi_clear')[0].disabled = true;
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '/ajax_edit_text',
                dataType: 'text',
                data: {
                    tumi_id: $tumi_id,
                    tumi_text: edit_tumi_text
                }
            }).done(function() {
                $('#edit_tumi_text_' + $tumi_id).replaceWith('<span class="tumi_text_detail">' + edit_tumi_text + '</span>');
                $('#tumi_' + $tumi_id + ' .tumi_text').replaceWith('<span class="tumi_text">' + edit_tumi_text + '</span>');
                $('.testcase_disp .testcase_clear')[0].disabled = false;
                $('.testcase_disp .testcase_error').fadeOut();
            }).fail(function() {});
        });
    });

    $(document).on('click', '.tumi_plus', function() {
        $('.tumi_add').fadeIn();
        $('.tumi_detail_close').fadeIn();
        $('.modal_help').fadeIn();
        $(document).on('click', '.tumi_detail_close', function() {
            $('.tumi_add').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
        });
        $(document).on('click', '.modal_help', function() {
            $('.tumi_add').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
        });
    });

    // 必須チェック解除
    $(document).ready(function() {
        $('.tumi_tittle_add').change(function() {
            var str = $(this).value;
            if (str != '') {
                $('.tumi_tittle_add')[0].setAttribute("style", "border-color: #ced4da;");
                $('.tumi_tittle_error').fadeOut();
            }
        });
        $('.tumi_text_add').change(function() {
            var str = $(this).value;
            if (str != '') {
                $('.tumi_text_add')[0].setAttribute("style", "border-color: #ced4da;");
                $('.tumi_text_error').fadeOut();
            }
        });
    });

    // 投稿詳細画面
    $(document).on('click', ".tumi", function() {
        var $target_modal = $(this).data("target");
        $height = $(window).scrollTop();
        $tumi_id = $target_modal.slice(6);
        $('.tumi_detail .tumi_img').attr('src', $($target_modal + ' > .tumi_image > img')[0].getAttribute('src'));
        $('.tumi_detail .tumi_tittle_detail').replaceWith('<div class="tumi_tittle_detail">' + $($target_modal + ' > .tumi_tittle').text() + '</div>');
        $('.tumi_detail .tumi_text_detail').replaceWith('<div class="tumi_text_detail">' + $($target_modal + ' > .tumi_text').text() + '</div>');
        $('.tumi_detail').fadeIn();
        $('.modal_help').fadeIn();
        $('.tumi_detail_close').fadeIn();
        $('.tumi_id').replaceWith('<input type="hidden" class="tumi_id" value="' + $tumi_id + '">');
        $(document).on('click', ".modal_help", function() {
            $('.modal_help').fadeOut();
            $('.tumi_detail').fadeOut();
            $('.tumi_detail_close').fadeOut();
        });
        $(document).on('click', ".tumi_detail_close", function() {
            $('.modal_help').fadeOut();
            $('.tumi_detail').fadeOut();
            $('.tumi_detail_close').fadeOut();
        });
    });

    const array_datas = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
    const data_keys = Object.keys(array_datas); // それぞれのkeyを取得 Object.keys()：引数のカラムを取得している ※取得結果[name,image,text]

    data_keys.forEach(el => {
        const chart_id = "myBarChart" + el; // elはdata_keysのそれぞれのkey
        var ctx = document.getElementById(chart_id);
        const array_data = Object.values(array_datas[el]);
        // var myBarChart = new Chart(ctx, {
        //     // それぞれのidごとにchartが生成される。
        // });
    });
</script>
@endsection