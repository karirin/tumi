@extends('layouts.top')
@section('title', 'tumi tumi')
@section('header')
@parent
@endsection
@section('content')
<div class="modal_help"></div>
<div id="splash"></div>
<i class="fa-solid fa-circle-plus tumi_plus"></i>
<i class="fa-regular fa-circle-xmark tumi_detail_close" style="display: none;"></i>
<div class="row tumi_top" style="display: none;">
    <h3 class="serach tumi_tittle">{{$goal_class->goal_tittle($goal_id)}}</h3>
    <div class="col-10 offset-1">
        @foreach ($tumis as $tumi)
        @if($tumi->goal_id==$goal_id)
        <div class="tumi">
            <div id="tumi" data-target="#tumi_{{$tumi->id}}" data-toggle="tumi">
                <div id="tumi_{{$tumi->id}}">
                    <span class="tumi_image"><img src="{{asset($tumi->image)}}"></span>
                    <div style="padding: 0.5rem;">
                        <div class="tumi_created" style="color: #7b7b7b;"><i class="fa-solid fa-clock" style="margin-right: 0.2rem;"></i>{{$tumi->year}}/{{$tumi->mouth}}/{{$tumi->day}}</div>
                        <div id="tumi_tittle" style="font-weight: bold;">{{$tumi->tittle}}</div>
                        <span class="tumi_text">{!! GitDown::parseAndCache($tumi->text) !!}</span>
                        <input type="hidden" class="tumi_markdown_text" value="{{$tumi->text}}">
                    </div>
                    </form>
                    <input type="hidden" class="tumi_image_data" value="{{$tumi->image}}">
                </div>
            </div>
            @if($tumi->user_id == $current_user->id)
            <div style="text-align: right;">
                <i class="far fa-trash-alt tumi_delete_btn" id="tumi_delete_btn" data-target="#tumi_{{$tumi->id}}" data-toggle="tumi" style="vertical-align: sub;"></i>
            </div>
            @endif
        </div>
        @endif
        @endforeach
    </div>
</div>
<div class="tumi_delete">
    <div style="font-size: 1.6rem;margin-bottom: 1rem;">こちらの投稿を削除しますか。</div>
    <div class="tumi tumi_delete_detail" style="margin: 0;"></div>
    <form method="post" action="{{ asset('tumi/delete') }}">
        @csrf
        <input type="hidden" name="tumi_id" class="tumi_delete_id">
        <input type="hidden" name="goal_id" value="{{$goal_id}}">
        <div style="text-align:right;margin-top:2rem;">
            <button class="btn btn btn-outline-dark return_delete_btn" type="button" style="font-size: 1.5rem;margin-right: 1.5rem;">戻る</button>
            <button class="btn btn btn-outline-dark" type="submit" style="font-size: 1.5rem;">削除</button>
        </div>
    </form>
</div>
<div class="tumi_add" id="app1" style="display:none;">
    <form method="post" action="{{ asset('tumi/add') }}" enctype="multipart/form-data" style="margin-bottom: 0;height: 35rem;">
        @csrf
        <div class="row" style="height: 92%;">
            <div class="col-6" style="padding:0;max-width: 49%;">
                <div style="font-size:1.3rem;">タイトル</div>
                <input type="text" name="tumi_tittle" class="tumi_tittle_add form-control" style="width: 100%;" placeholder="PHPの勉強">
                <div class="error_text_form" style="height: 27px;text-align:left;">
                    <span class="tumi_tittle_error" style="display:none;color: #dc3545;">タイトルを入力してください</span>
                </div>
                <div style="font-size:1.3rem;">積み上げ内容</div>
                <textarea type="text" name="tumi_text" id="edit_tumi_text input-field" style="height: 18rem;" class="tumi_text_add form-control" v-model="input" placeholder="PHPについて勉強した。

PHPでは文末にセミコロン「;」を使って文を区切る
文字列などを出力するときは「echo」と書く
出力したい文字列はシングルクォーテーションかダブルクォーテーションで囲む"></textarea>
                <div class="error_text_form" style="height: 27px;text-align:left;">
                    <span class="tumi_text_error" style="display:none;color: #dc3545;">積み上げた内容を入力してください</span>
                </div>
                <div style="font-size: 1.3rem;">画像</div>
                <label class="image_label">
                    <i class="far fa-image"></i>
                    <input type="file" name="image" id="my_image" style="display:none;">
                </label>
                <!-- <span style="margin-left: 1rem;">※（縦横200px×200px以上推奨、5MB未満）</span> -->
                <input type="button" id="my_clear" value="ファイルをクリアする">
                <div style="height: 8.5rem;display: inline-block;">
                    <div class="preview_img"><img class="my_preview" style="margin-left: 3rem;margin-top: -1rem;"></div>
                </div>
            </div>
            <div class="col-6" style="padding:0;max-width: 49%;">
                <div style="margin-top: 6rem;"><i class="fa-solid fa-eye" style="margin-right: 0.2rem;font-size: 1.3rem;"></i><span style="font-size:1.3rem;">プレビュー</span></div>
                <div id="preview-field" class="add_preview-field" v-html="convertMarkdown" style="height: 18rem;"></div>
            </div>
        </div>
        <div style="text-align: right;">
            <button class="btn btn btn-outline-dark tumi_submit" style="z-index: 10;position: relative;">投稿</button>
        </div>
        <input type="hidden" name="goal_id" value="{{$goal_id}}">
    </form>
</div>
<div class="tumi_detail" id="app2" style="display:none;">
    <div class="tumi_detail_noedit">
        <div style="font-size: 1.3rem;">タイトル</div>
        <div class="tumi_tittle_detail"></div>
        <div style="font-size: 1.3rem;">積み上げ内容</div>
        <div class="tumi_text_detail"></div>
        <div style="font-size: 1.3rem;">画像</div>
        <div>
            <img class="tumi_img" style="width: 30%;">
        </div>
        <div class="tumi_date"></div>
        <input type="hidden" name="tumi_id" class="tumi_id" value>
        <div class="tumi_editbtn">
            <button class="btn btn btn-outline-dark edit_tumi_btn" type="button" style="font-size: 1.5rem;">編集</button>
        </div>
    </div>
    <div class="tumi_detail_edit" style="display:none;">
        <form method="post" action="{{ asset('tumi/edit') }}" enctype="multipart/form-data">
            @csrf
            <div class="row" style="height: 94%;">
                <div class="col-6" style="padding: 0;max-width: 49%;">
                    <div style="font-size:1.3rem;">タイトル</div>
                    <input type="text" name="edit_tittle" class="edit_tumi_tittle form-control" style="width: 100%;">
                    <div class="error_text_form" style="height: 27px;text-align:left;">
                        <span class="tumi_edittittle_error" style="display:none;color: #dc3545;">タイトルを入力してください</span>
                    </div>
                    <div style="font-size:1.3rem;">積み上げ内容</div>
                    <textarea type="text" name="edit_text" id="edit_tumi_text" class="edit_tumi_text form-control" style="width: 100%;height: 19.2rem;" id="input-field" v-model="input"></textarea>
                    <!-- <input type="hidden" class="edit_tumi_text"> -->
                    <div class="error_text_form" style="height: 27px;text-align:left;">
                        <span class="tumi_edittext_error" style="display:none;color: #dc3545;">積み上げた内容を入力してください</span>
                    </div>
                    <div style="font-size:1.3rem;margin-top: 1rem;margin-bottom: 1rem;">画像</div>
                    <div>
                        <label style="margin: 6% 17%;position: absolute;">
                            <div class="fa-image_range">
                                <i class="far fa-image" style="margin: 30%;"></i>
                            </div>
                            <input type="file" name="image_name" id="edit_profile_img" accept="image/*" multiple>
                        </label>
                        <img class="tumi_img" name="profile_image" style="width: 12rem;">
                        <input type="hidden" name="edit_image" class="edit_image">
                    </div>
                </div>
                <div class="col-6" style="height: 99%;padding: 0;max-width: 49%;">
                    <div style="font-size:1.3rem;margin-top: 6rem;"><i class="fa-solid fa-eye" style="margin-right: 0.2rem;font-size: 1.3rem;"></i>プレビュー</div>
                    <div id="preview-field" class="edit_preview-field" v-html="convertMarkdown" style="height: 19.3rem;"></div>
                </div>
            </div>
            <div class="tumi_editbtn">
                <button class="btn btn btn-outline-dark return_btn" type="button" style="font-size: 1.5rem;margin-right: 1.5rem;">戻る</button>
                <button class="btn btn btn-outline-dark edit_tumi_done" type="submit" style="font-size: 1.5rem;">更新</button>
            </div>
            <input type="hidden" name="edit_tumi_id" class="edit_tumi_id">
            <input type="hidden" name="goal_id" value="{{$goal_id}}">
        </form>
    </div>
</div>
<p class="tumi_message">{{$tumi_message}}</p>
@endsection
@section('footer')
@parent
<script>
    $(window).on('load', function() {
        if ($('.tumi_message').length) {
            if ($('.tumi_message')[0].textContent !== "") {
                $('.tumi_message').fadeIn();
                $('.tumi_message').fadeOut(3000);
            }
        }
    });

    $(function() {
        $('#edit_profile_img').change(function(e) {
            var reader = new FileReader();
            $(".editing_profile_img").fadeIn();
            reader.onload = function(e) {
                $(".tumi_img").attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });

    setTimeout(function() {
        $(".tumi_top").css("display", "flex");
    }, 840);

    // 投稿詳細画面
    $(document).on('click', "#tumi", function() {
        var $target_modal = $(this).data("target"),
            $tumi_id = $target_modal.slice(6),
            $height = $(window).scrollTop(),
            top = $height + 36;
        $('.tumi_detail .tumi_img').attr('src', $($target_modal + ' > .tumi_image > img')[0].getAttribute('src'));
        $('.tumi_detail .tumi_tittle_detail').replaceWith('<div class="tumi_tittle_detail" style="margin-bottom: 1rem;">' + $($target_modal + ' > div > #tumi_tittle').text() + '</div>');
        $('.tumi_detail .tumi_text_detail').replaceWith('<div class="tumi_text_detail">' + $($target_modal + ' > div > .tumi_text').html() + '</div>');
        $('.tumi_detail .tumi_date').replaceWith('<div class="tumi_date"><i class="fa-solid fa-clock" style="margin:0 0.5rem;"></i>' + $($target_modal + ' > div > .tumi_created').text() + '</div>');
        $('.tumi_detail').fadeIn();
        $('.tumi_detail').offset({
            top: top
        });
        $('.modal_help').fadeIn();
        $('.tumi_detail_close').fadeIn();
        $('.tumi_id').replaceWith('<input type="hidden" class="tumi_id" value="' + $tumi_id + '">');
        $('.edit_tumi_btn').off();
        // 編集ボタンをクリック
        $('.edit_tumi_btn').on('click', function() {
            var $tumi_tittle = $('.tumi_detail .tumi_tittle_detail')[0].textContent,
                $tumi_html_text = $('.tumi_detail .tumi_text_detail').html(),
                $tumi_text = $($target_modal + ' > div > .tumi_markdown_text').val();
            $('.tumi_detail_noedit').fadeOut();
            setTimeout(function() {
                $('.tumi_detail_edit').fadeIn();
                $(window).scrollTop(top - 35);
            }, 300);
            $('.edit_tumi_tittle').val($tumi_tittle);
            $('.edit_tumi_text').val($tumi_text);
            $('.edit_preview-field').append($tumi_html_text);
            $('.edit_tumi_id').val($tumi_id);
            $('.edit_image').val($($target_modal + ' > .tumi_image_data').val());
            $('.edit_tumi_text').scroll(function() {
                $('.edit_preview-field').scrollTop($('.edit_tumi_text').scrollTop());
            });
            $('.edit_preview-field').scroll(function() {
                $('.edit_tumi_text').scrollTop($('.edit_preview-field').scrollTop());
            });
        });
        $(document).on('click', ".modal_help", function() {
            $('.modal_help').fadeOut();
            $('.tumi_detail').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.tumi_detail_noedit').fadeIn();
            $('.tumi_detail_edit').fadeOut();
            $('.edit_preview-field').empty();
        });
        $(document).on('click', ".tumi_detail_close", function() {
            $('.modal_help').fadeOut();
            $('.tumi_detail').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.tumi_detail_noedit').fadeIn();
            $('.tumi_detail_edit').fadeOut();
            $('.edit_preview-field').empty();
        });
        // 戻るボタンクリック
        $(document).on('click', ".return_btn", function() {
            $(window).scrollTop(top - 35);
            $('.tumi_detail_noedit').fadeIn();
            $('.tumi_detail_edit').fadeOut();
            $('.edit_preview-field').empty();
        });
    });

    $(document).on('change', '#edit_profile_img', function(e) {
        var reader = new FileReader();
        $(".editing_profile_img").fadeIn();
        reader.onload = function(e) {
            $(".editing_profile_img").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    $(document).on('change', '#my_image', function(e) {
        var reader = new FileReader();
        $(".my_preview").fadeIn();
        reader.onload = function(e) {
            $(".my_preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    new Vue({

        el: '#app1', // index.htmlでid="app"となっている要素（エレメント）を指定
        data: {
            input: '' // index.htmlでv-model="input"が付与されている要素と双方向データバインディングされている。
        },
        // created: function() {
        // marked.setOptions({
        // langPrefix: '',
        // highlight: function(code, lang) {
        // return hljs.highlightAuto(code, [lang]).value
        // }
        // });
        // },
        computed: {
            convertMarkdown: function() {
                // index.htmlでv-html="convertMarkdown"が付与されている要素（エレメント）とバイディングされている。
                // 入力されたデータをHTMLに変換して表示させる。
                return marked(this.input);
            }
        }
    })

    new Vue({

        el: '#app2', // index.htmlでid="app"となっている要素（エレメント）を指定
        data: {
            input: '' // index.htmlでv-model="input"が付与されている要素と双方向データバインディングされている。
        },
        // created: function() {
        // marked.setOptions({
        // langPrefix: '',
        // highlight: function(code, lang) {
        // return hljs.highlightAuto(code, [lang]).value
        // }
        // });
        // },
        computed: {
            convertMarkdown: function() {
                // index.htmlでv-html="convertMarkdown"が付与されている要素（エレメント）とバイディングされている。
                // 入力されたデータをHTMLに変換して表示させる。
                return marked(this.input);
            }
        }
    })

    $(document).on('click', '.tumi_plus', function() {
        var $height = $(window).scrollTop(),
            top = $height + 20;
        $('.tumi_add').offset({
            top: top
        });
        $('.tumi_add').fadeIn();
        $('.tumi_detail_close').fadeIn();
        $('.modal_help').fadeIn();

        $('.tumi_text_add').scroll(function() {
            $('.add_preview-field').scrollTop($('.tumi_text_add').scrollTop());
        });
        $('.add_preview-field').scroll(function() {
            $('.tumi_text_add').scrollTop($('.add_preview-field').scrollTop());
        });

        $(document).on('click', '.tumi_detail_close', function() {
            $('.tumi_add').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
            $('.tumi_add').offset({
                top: 0
            });
        });
        $(document).on('click', '.modal_help', function() {
            $('.tumi_add').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
            $('.tumi_add').offset({
                top: 0
            });
        });
    });

    $(document).on('click', '.tumi_delete_btn', function(e) {
        var $target_modal = $(this).data("target"),
            $tumi_id = $target_modal.slice(6),
            $tumi_text = $($target_modal + ' > div > .tumi_markdown_text').val(),
            $height = $(window).scrollTop(),
            top = $height + 63;
        $('.tumi_delete').fadeIn();
        $('.tumi_detail_close').fadeIn();
        $('.modal_help').fadeIn();
        $('.tumi_delete_detail').append($($target_modal).html());
        $('.delete_text').text($tumi_text);
        $('.tumi_delete_id').val($tumi_id);
        $('.tumi_delete').offset({
            top: top
        });
        $(document).on('click', '.tumi_detail_close', function() {
            $('.tumi_delete').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
            $('.tumi_delete_detail').empty();
        });
        $(document).on('click', '.modal_help', function() {
            $('.tumi_delete').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
            $('.tumi_delete_detail').empty();
        });
        // 戻るボタンクリック
        $(document).on('click', ".return_delete_btn", function() {
            $('.tumi_delete').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.modal_help').fadeOut();
            $('.tumi_delete_detail').empty();
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
</script>
@endsection