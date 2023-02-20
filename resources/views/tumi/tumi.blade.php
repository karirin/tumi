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
    <h3 class="serach tumi_tittle">積み上げ内容</h3>
    <div class="col-10 offset-1">
        @foreach ($tumis as $tumi)
        @if($tumi->goal_id==$goal_id)
        <div class="tumi" data-target="#tumi_{{$tumi->id}}" data-toggle="tumi">
            <div id="tumi_{{$tumi->id}}">
                <span class="tumi_image"><img src="{{asset($tumi->image)}}"></span>
                <div style="padding: 0.5rem;">
                    <div class="tumi_created" style="color: #7b7b7b;"><i class="fa-solid fa-clock" style="margin-right: 0.2rem;"></i>{{$tumi->year}}/{{$tumi->mouth}}/{{$tumi->day}}</div>
                    <div id="tumi_tittle" style="font-weight: bold;">{{$tumi->tittle}}</div>
                    <span class="tumi_text">{!! GitDown::parseAndCache($tumi->text) !!}</span>
                    <input type="hidden" class="tumi_markdown_text" value="{{$tumi->text}}">
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<div class="tumi_add" id="app1" style="display:none;">
    <form method="post" action="{{ asset('tumi/add') }}" enctype="multipart/form-data" style="margin-bottom: 0;height: 35rem;">
        @csrf
        <!-- <div class="row">
            <div class="col-6">
                <div>タイトル</div>
                <input type="text" name="tumi_tittle" class="tumi_tittle_add">
                <div class="error_text_form" style="height: 27px;text-align:left;margin: 0 20%;">
                    <span class="tumi_tittle_error" style="display:none;color: #dc3545;">タイトルを入力してください</span>
                </div>
                <div style="margin-top: 1rem;">積み上げた内容</div>
                <textarea type="text" name="tumi_text"  style="width: 88%;"></textarea>
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
        <input type="hidden" name="goal_id" value="{{$goal_id}}"> -->
        <div class="row" style="height: 92%;">
            <div class="col-6" style="padding:0;max-width: 49%;">
                <div style="font-size:1.3rem;">タイトル</div>
                <input type="text" name="tumi_tittle" class="tumi_tittle_add form-control" style="width: 100%;" placeholder="">
                <div class="error_text_form" style="height: 27px;text-align:left;margin: 0 20%;">
                    <span class="tumi_tittle_error" style="display:none;color: #dc3545;">タイトルを入力してください</span>
                </div>
                <div style="font-size:1.3rem;">積み上げ内容</div>
                <textarea type="text" name="tumi_text" id="edit_tumi_text input-field" class="tumi_text_add form-control" v-model="input"></textarea>
                <div class="error_text_form" style="height: 27px;text-align:left;margin: 0 20%;">
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
        <div class="row" style="height: 94%;">
            <div class="col-6" style="padding: 0;max-width: 49%;">
                <div style="font-size:1.3rem;">タイトル</div>
                <input type="text" name="text" class="edit_tumi_tittle form-control" style="width: 100%;">
                <div class="error_text_form" style="height: 27px;text-align:left;margin: 0 20%;">
                    <span class="tumi_tittle_error" style="display:none;color: #dc3545;">タイトルを入力してください</span>
                </div>
                <div style="font-size:1.3rem;">積み上げ内容</div>
                <!-- <div class="edit_tumi_text">
                </div> -->
                <textarea type="text" name="text" id="edit_tumi_text" class="edit_tumi_text form-control" style="width: 100%;height: 19.2rem;" id="input-field" v-model="input"></textarea>
                <div style="font-size:1.3rem;margin-top: 1rem;margin-bottom: 1rem;">画像</div>
                <div>
                    <label style="margin: 5% 20%;position: absolute;">
                        <div class="fa-image_range">
                            <i class="far fa-image" style="margin: 30%;"></i>
                        </div>
                        <input type="file" name="image_name" id="edit_profile_img" accept="image/*" multiple>
                    </label>
                    <img class="tumi_img" name="profile_image" style="width: 50%;">
                </div>
            </div>
            <div class="col-6" style="height: 99%;padding: 0;max-width: 49%;">
                <div style="font-size:1.3rem;margin-top: 6rem;"><i class="fa-solid fa-eye" style="margin-right: 0.2rem;font-size: 1.3rem;"></i>プレビュー</div>
                <div id="preview-field" class="edit_preview-field" v-html="convertMarkdown" style="height: 19.3rem;"></div>
            </div>
        </div>
        <div class="tumi_editbtn">
            <button class="btn btn btn-outline-dark return_btn" type="button" style="font-size: 1.5rem;margin-right: 1.5rem;">戻る</button>
            <button class="btn btn btn-outline-dark edit_tumi_done" type="button" style="font-size: 1.5rem;">更新</button>
        </div>
    </div>
</div>
@endsection
@section('footer')
@parent
<script>
    $(window).on('load', function() {
        //$('html, body').scrollTop(0);
    });
    $('.edit_tumi_text').scroll(function() {
        console.log("scroll!testtest");
    });
    setTimeout(function() {
        $(".tumi_top").css("display", "flex");
    }, 840);

    var edit_tumi_text = $('.tumi_text_add');
    var preview_field = $('.add_preview-field');
    //var scrollDataList = $('.scrollDataList');

    // scrollHeader.scroll(function() {
    // scrollDataList.scrollLeft(scrollHeader.scrollLeft());
    // });
    // $('.add_preview-field').scroll(function() {
    // console.log("test");
    // $('.tumi_text_add').scrollTop($('.add_preview-field').scrollTop());
    // });
    // $('.tumi_text_add').scroll(function() {
    // console.log("test1");
    // //scrollHeader.scrollLeft(scrollDataList.scrollLeft());
    // $('.add_preview-field').scrollTop($('.tumi_text_add').scrollTop());
    // });

    $(".tumi_add_scroll").scroll(function() {
        console.log("testtest");
    });

    // 投稿詳細画面
    $(document).on('click', ".tumi", function() {
        var $target_modal = $(this).data("target"),
            $tumi_id = $target_modal.slice(6),
            edit_tumi_text = $('#edit_tumi_text_' + $tumi_id).val(),
            $height = $(window).scrollTop(),
            top = $height + 36;
        $('.edit_tumi_tittle_detail').val(edit_tumi_text);
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
        // 編集ボタンをクリック
        $(document).on('click', '.edit_tumi_btn', function() {
            var $tumi_tittle = $('.tumi_detail .tumi_tittle_detail')[0].textContent,
                $tumi_html_text = $('.tumi_detail .tumi_text_detail').html(),
                $tumi_text = $($target_modal + ' > div > .tumi_markdown_text').val();
            $('.tumi_detail_noedit').fadeOut();
            setTimeout(function() {
                $('.tumi_detail_edit').fadeIn();
                $(window).scrollTop(top - 35);
            }, 300);
            $('.edit_tumi_tittle').val($tumi_tittle);
            $('.edit_tumi_text').text($tumi_text);
            //$('.edit_tumi_text').replaceWith('<textarea type="text" name="text" id="edit_tumi_text" class="edit_tumi_text form-control" style="width: 100%;height: 19.2rem;" id="input-field" v-model="input">' + $tumi_text + '</textarea>');
            //$('.edit_tumi_text').html($tumi_text);
            // プレビュー用にpタグ用意
            // newContent = document.createTextNode($tumi_text)
            // p_element = document.createElement("p");
            // p_element.appendChild(newContent);
            // $('.edit_preview-field')[0].appendChild(p_element);
            console.log($tumi_html_text);
            $('.edit_preview-field').append($tumi_html_text);
            // 更新ボタンをクリック
            $(document).on('click', '.edit_tumi_done', function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var $tumi_id = $('.tumi_detail .tumi_id')[0].value,
                    $tumi_tittle = $('.tumi_detail .edit_tumi_tittle')[0].value,
                    $tumi_text = $('.tumi_detail .edit_tumi_text')[0].value;
                var fileData = document.getElementById("edit_profile_img").files[0];
                $.ajax({
                    type: 'POST',
                    url: '/ajax_edit_done',
                    dataType: 'text',
                    data: {
                        tumi_id: $tumi_id,
                        tumi_tittle: $tumi_tittle,
                        tumi_text: $tumi_text
                    }
                }).done(function() {}).fail(function() {});
            });
        });
        $(document).on('click', ".modal_help", function() {
            $('.modal_help').fadeOut();
            $('.tumi_detail').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.tumi_detail_noedit').fadeIn();
            $('.tumi_detail_edit').fadeOut();
        });
        $(document).on('click', ".tumi_detail_close", function() {
            $('.modal_help').fadeOut();
            $('.tumi_detail').fadeOut();
            $('.tumi_detail_close').fadeOut();
            $('.tumi_detail_noedit').fadeIn();
            $('.tumi_detail_edit').fadeOut();
        });
        // 戻るボタンクリック
        $(document).on('click', ".return_btn", function() {
            $(window).scrollTop(top - 35);
            $('.tumi_detail_noedit').fadeIn();
            $('.tumi_detail_edit').fadeOut();
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

    // const array_datas = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
    // const data_keys = Object.keys(array_datas); // それぞれのkeyを取得 Object.keys()：引数のカラムを取得している ※取得結果[name,image,text]

    // data_keys.forEach(el => {
    // const chart_id = "myBarChart" + el; // elはdata_keysのそれぞれのkey
    // var ctx = document.getElementById(chart_id);
    // const array_data = Object.values(array_datas[el]);
    // // var myBarChart = new Chart(ctx, {
    // // // それぞれのidごとにchartが生成される。
    // // });
    // });

    // // タイトル入力処理
    // $(document).on('click', '.tumi_detail .tumi_tittle_detail', function() {
    // var $tumi_id = $('.tumi_detail .tumi_id')[0].value,
    // $tumi_tittle = $('.tumi_detail .tumi_tittle_detail')[0].textContent,
    // $tumi_text = $('.tumi_detail .tumi_text_detail')[0].textContent;
    // $(this).replaceWith('<textarea type="text" name="text" id="edit_tumi_' + $tumi_id + '" class="edit_tumi" style="width: 100%;">' + $tumi_tittle);
    //     $('#edit_tumi_' + $tumi_id).on('mouseout', function(e) {
    //         $.ajaxSetup({
    //             headers: {
    //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //             },
    //         });
    //         var edit_tumi_tittle = $('#edit_tumi_' + $tumi_id).val();
    //         if (edit_tumi_tittle == '') {
    //             $('#edit_tumi_' + $test_id)[0].setAttribute("style", "border-color: #dc3545;border-style: solid;width: 100%;");
    //             $('.tumi_disp .tumi_error').fadeIn();
    //             $('.tumi_disp .tumi_clear')[0].disabled = true;
    //             return false;
    //         }
    //         $.ajax({
    //             type: 'POST',
    //             url: '/ajax_edit_tittle',
    //             dataType: 'text',
    //             data: {
    //                 tumi_id: $tumi_id,
    //                 tumi_tittle: edit_tumi_tittle
    //             }
    //         }).done(function() {
    //             $('#edit_tumi_' + $tumi_id).replaceWith('<span class="tumi_tittle_detail">' + edit_tumi_tittle + '</span>');
    //             //$('#tumi_' + $tumi_id + ' .testcase_text').replaceWith('<span class="tumi_text">' + edit_tumi_text + '</span>');
    //             //$('.testcase_disp .testcase_clear')[0].disabled = false;
    //             //$('.testcase_disp .testcase_error').fadeOut();
    //         }).fail(function() {});
    //     });
    // });

    // // 積み上げ内容入力処理
    // $(document).on('click', '.tumi_detail .tumi_text_detail', function() {
    //     var $tumi_id = $('.tumi_detail .tumi_id')[0].value,
    //         $tumi_text = $('.tumi_detail .tumi_text_detail')[0].textContent;
    //     //$tumi_text = $('.tumi_detail .tumi_text_detail')[0].textContent;
    //     $(this).replaceWith('<textarea type="text" style="width: 100%;" name="input-field"id="edit_tumi_text_' + $tumi_id + '" id="input-field" v-model="input">');
    //     $('#edit_tumi_text_' + $tumi_id).on('mouseout', function(e) {
    //         $.ajaxSetup({
    //             headers: {
    //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //             },
    //         });
    //         var edit_tumi_text = $('#edit_tumi_text_' + $tumi_id).val();
    //         if (edit_tumi_text == '') {
    //             $('#edit_tumi_text_' + $test_id)[0].setAttribute("style", "border-color: #dc3545;border-style: solid;width: 100%;");
    //             $('.tumi_disp .tumi_error').fadeIn();
    //             $('.tumi_disp .tumi_clear')[0].disabled = true;
    //             return false;
    //         }
    //         $.ajax({
    //             type: 'POST',
    //             url: '/ajax_edit_text',
    //             dataType: 'text',
    //             data: {
    //                 tumi_id: $tumi_id,
    //                 tumi_text: edit_tumi_text
    //             }
    //         }).done(function() {
    //             $('#edit_tumi_text_' + $tumi_id).replaceWith('<span class="tumi_text_detail">' + edit_tumi_text + '</span>');
    //             $('#tumi_' + $tumi_id + ' .tumi_text').replaceWith('<span class="tumi_text">' + edit_tumi_text + '</span>');
    //             //$('.testcase_disp .testcase_clear')[0].disabled = false;
    //             //$('.testcase_disp .testcase_error').fadeOut();
    //         }).fail(function() {});
    //     });
    // });
</script>
@endsection