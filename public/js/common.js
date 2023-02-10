// 変数定義
var user_comment = $('.comment').text(),
    user_name = $('.profile_name').text(),
    user_comment_narrow = $('.comment_narrow').text(),
    user_name_narrow = $('.profile_name_narrow').text(),
    user_comment_narrower = $('.comment_narrower').text(),
    user_name_narrower = $('.profile_name_narrower').text(),
    user_workhistory = $('.workhistory').text(),
    user_workhistory_narrow = $('.workhistory_narrow').text(),
    user_workhistory_narrower = $('.workhistory_narrower').text(),
    user = $('.user').val();

// getパラメータ取得
function get_param(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return false;
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function file_name(extension) {
    var s = this.replace(/\\/g, '/');
    s = s.substring(s.lastIndexOf('/') + 1);
    return extension ? s.replace(/[?#].+$/, '') : s.split('.')[0];
}

// ビジーwaitを使う方法
function sleep(waitMsec) {
    var startMsec = new Date();

    // 指定ミリ秒間だけループさせる（CPUは常にビジー状態）
    while (new Date() - startMsec < waitMsec);
}

// クリック時に
function copyToClipboard() {
    // コピー対象をJavaScript上で変数として定義する
    var copyTarget = document.getElementById("test_url");

    // コピー対象のテキストを選択する
    copyTarget.select();

    // 選択しているテキストをクリップボードにコピーする
    document.execCommand("Copy");

    // コピーをお知らせする
    alert("コピーできました！ : " + copyTarget.value);
}

//================================
// フラッシュメッセージ処理
//================================

// フラッシュメッセージを表示させる
$(function() {
    $message = ('.flash_message');
    setTimeout(function() { $($message).slideToggle('slow'); }, 2000);
});

//=====================================================
// <img>要素 → Base64形式の文字列に変換
//   img       : HTMLImageElement
//   mime_type : string "image/png", "image/jpeg" など
//=====================================================
function ImageToBase64(img, mime_type) {
    // New Canvas
    var canvas = document.createElement('canvas');
    canvas.width  = img.width;
    canvas.height = img.height;
    // Draw Image
    var ctx = canvas.getContext('2d');
    console.log(img);
    ctx.drawImage(img, 0, 0);
    // To Base64
    return canvas.toDataURL(mime_type);
}

//================================
// 画像処理
//================================

// 画像の選択時、表示処理
$('#my_image').on('change', function(e) {
    var reader = new FileReader();
    $(".my_preview").fadeIn();
    $(".message_text").fadeOut();
    reader.onload = function(e) {
        $(".my_preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

// $('#my_image').on('change', function(e) {
//     //画像を選択した際に、メッセージテキストに画像情報を追加する
//     var img = document.getElementById('my_image');
//     console.log(img);
//     $('#message').val = ImageToBase64(img, "image/jpeg");
// });

$('#edit_image,#edit_image_narrow,#edit_image_narrower').on('change', function(e) {
    var reader = new FileReader();
    $(".edit_preview").fadeIn();
    reader.onload = function(e) {
        $(".edit_preview").attr('src', e.target.result);
        $(".far.fa-image").fadeOut();
    }
    reader.readAsDataURL(e.target.files[0]);
    $('.edit_clear').on('click', function(e) {
        $(".far.fa-image").fadeIn();
    });
});

$('#comment_image,#comment_image_narrow,#comment_image_narrower').on('change', function(e) {
    var reader = new FileReader();
    $(".comment_preview").fadeIn();
    reader.onload = function(e) {
        $(".comment_preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

$('#reply_comment_image').on('change', function(e) {
    var reader = new FileReader();
    $(".reply_comment_preview").fadeIn();
    reader.onload = function(e) {
        $(".reply_comment_preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

$('#edit_profile_img,#edit_profile_img_narrow,#edit_profile_img_narrower').on('change', function(e) {
    var reader = new FileReader();
    $(".editing_profile_img").fadeIn();
    reader.onload = function(e) {
        $(".editing_profile_img").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

$(document).on('change', '#my_image', function() {
    $('.far.fa-times-circle.my_clear').show();
    $(document).on('click', '.far.fa-times-circle.my_clear', function() {
        $(".message_text").fadeIn();
        $('#my_image').val('');
        $('.far.fa-times-circle.my_clear').hide();
        $('.my_preview').hide();
        $('#edit_profile_img,#edit_profile_img_narrow,#edit_profile_img_narrower').val('');
    });
});

$(document).on('change', '#edit_profile_img,#edit_profile_img_narrow,#edit_profile_img_narrower', function() {
    $('.far.fa-times-circle.profile_clear').show();
    $('#edit_profile_img').attr('name', 'image_name');
    $(document).on('click', '#profile_clear', function() {
        $('#edit_profile_img,#edit_profile_img_narrow,#edit_profile_img_narrower').hide();
        $('.far.fa-times-circle.profile_clear').hide();
        $('.editing_profile_img').attr('src','');
        $('#edit_profile_img').attr('name', 'edit_image_name');
    });
});

$(document).on('change', '#comment_image,#comment_image_narrow,#comment_image_narrower', function() {
    $('.far.fa-times-circle.comment_clear').show();
    $(document).on('click', '.far.fa-times-circle.comment_clear', function() {
        $('#comment_image,#comment_image_narrow,#comment_image_narrower').val('');
        $(this).hide();
        $('.comment_preview').hide();
        $('.far.fa-times-circle.comment_clear').hide();
    });
});

$(document).on('change', '#reply_comment_image', function() {
    $('.far.fa-times-circle.reply_comment_clear').show();
    $(document).on('click', '.far.fa-times-circle.reply_comment_clear', function() {
        $('#reply_comment_image').val('');
        $(this).hide();
        $('.reply_comment_preview').hide();
        $('.far.fa-times-circle.edit_clear').hide();
    });
});

$(document).on('change', '#edit_image,#edit_image_narrow,#edit_image_narrower', function() {
    $('.far.fa-times-circle.edit_clear').show();
    $(document).on('click', '.far.fa-times-circle.edit_clear', function() {
        $('#edit_image,#edit_image_narrow,#edit_image_narrower').val('');
        $(this).hide();
        $('.edit_preview').hide();
        $('.far.fa-times-circle.edit_clear').hide();
    });
});

$('#edit_profile_img,#edit_profile_img_narrow,#edit_profile_img_narrower').on('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
        file_name = $(".editing_profile_img").attr('src', e.target.result).file_name();
    }
    reader.readAsDataURL(e.target.files[0]);
});

//================================
// ajax処理
//================================

// いいね機能処理
$(document).on('click', '.favorite_btn', function(e) {
    e.stopPropagation();
    var $this = $(this),
        post_id = $this.prev().val();
    $.ajax({
        type: 'POST',
        url: '../ajax_post_favorite_process.php',
        dataType: 'json',
        data: {
            post_id: post_id
        }
    }).done(function() {}).fail(function() {});
});

// フォロー機能処理
$(document).on('click', '.follow_btn', function(e) {
    e.stopPropagation();
    var $this = $(this),
        current_user_id = $('.current_user_id').val(),
        user_id = $this.prev().val();
    $.ajax({
        type: 'POST',
        url: '../ajax_follow_process.php',
        dataType: 'text',
        data: {
            current_user_id: current_user_id,
            user_id: user_id
        }
    }).done(function() {
        if ($this.children().next()[0].textContent == 'フォロー解除') {
            $('#follow_label').replaceWith('<span id="follow_label">フォローする</span>');
            $('.follower_count')[0].textContent--;
        } else {
            $('#follow_label').replaceWith('<span id="follow_label">フォロー解除</span>');
            $('.follower_count')[0].textContent++;
        }
    }).fail(function() {});
});

//================================
// モーダルウィンドウ処理
//================================

// ウィンドウ横のモーダルウィンドウ処理
$('.slide_menu').show();
$('.show_menu').on('click', function() {
    scroll_position = $(window).scrollTop();
    $('.modal_footer').fadeIn();
    if(location.pathname != "/match/match"){
        $('body').addClass('fixed').css({ 'top': -scroll_position });
    }
    if(location.pathname=="/"){
        $('.modal_footer').css({ 'z-index': '9' });
    }
    $('.slide_menu').addClass('open');
    $('.top_title').css({ 'position': 'unset' });
    $('.smartphone_header').fadeOut();
    $('.page_title').css({ 'margin-top': '4.5rem' });
    $('.top_logo').css({ 'top': '3%' });
    $('.message_disp .message').css({ 'margin-top': '8rem' });
    $('.message_disp .message_disp_div').css({ 'margin-top': '0rem','position': 'unset' });
})

$('.slide_prof').on('click', function() {
    scroll_position = $(window).scrollTop();
    $('body').addClass('fixed').css({ 'top': -scroll_position });
    $('.slide_prof').addClass('open');
})

// モーダル画面キャンセルボタン押下時の処理
$(document).on('click', ".modal_close", function() {
    $('body').removeClass('fixed').css({ 'top': 0 });
    window.scrollTo(0, scroll_position);
    $('.modal').fadeOut();
    $('.modal_post').fadeOut();
    $('.modal_testcase').fadeOut();
    $('.modal_prof').fadeOut();
    $('.modal_withdraw').fadeOut();
    $('.modal_help').fadeOut();
    $('.delete_confirmation').fadeOut();
    $('.post_process').fadeOut();
    $('.testcase_process').fadeOut();
    $('.help_disp').fadeOut();
    $('.withdraw_process').fadeOut();
    $('.post_edit').fadeOut();
    $('.comment_confirmation').fadeOut();
    $('.reply_comment_confirmation').fadeOut();
    $('.edit_comment').replaceWith('<p class="comment">' + user_comment + '</p>');
    $('.edit_comment_narrow').replaceWith('<p class="comment">' + user_comment_narrow + '</p>');
    $('.edit_name_narrow').replaceWith('<h2 class="profile_name">' + user_name_narrow + '</h2>');
    $('.edit_comment_narrower').replaceWith('<p class="comment">' + user_comment_narrower + '</p>');
    $('.edit_name_narrower').replaceWith('<h2 class="profile_name">' + user_name_narrower + '</h2>');
    $('.edit_workhistory_narrow').replaceWith('<p class="workhistory_narrow">' + user_workhistory_narrow + '</p>');
    $('.edit_workhistory_narrower').replaceWith('<p class="workhistory_narrow">' + user_workhistory_narrower + '</p>');
    $('.edit_btn').fadeIn();
    $('.slide_menu').removeClass('open');
    $('.modal_footer').fadeOut();
    $('.top_title').css({ 'position': 'fixed' });
    $('.smartphone_header').fadeIn();
    $('.page_title').css({ 'margin-top': '15rem' });
    $('.message_disp .message').css({ 'margin-top': '17rem','height':'7rem' });
    $('.message_disp .message_disp_div').css({ 'margin-top': '8rem','position':'fixed' });
    $('.top_logo').css({ 'top': '10%' });
});

// // 編集ボタン押下時の処理
// $(document).on('click', '.edit_btn', function() {
//     scroll_position = $(window).scrollTop();
//     $('.edit_btn').fadeOut();
//     $('body').addClass('fixed').css({ 'top': -scroll_position });
//     $('.comment').replaceWith('<textarea class="edit_comment form-control" type="text" name="user_comment" >' + user_comment);
//     $('.profile_name').replaceWith('<input class="edit_name form-control" type="text" name="user_name" value="' + user_name + '">');
//     $('.comment_narrow').replaceWith('<textarea class="edit_comment form-control" type="text" name="user_comment" >' + user_comment_narrow);
//     $('.profile_name_narrow').replaceWith('<input class="edit_name form-control" type="text" name="user_name" value="' + user_name_narrow + '">');
//     $('.comment_narrower').replaceWith('<textarea class="edit_comment form-control" type="text" name="user_comment" >' + user_comment_narrower);
//     $('.profile_name_narrower').replaceWith('<input class="edit_name form-control" type="text" name="user_name" value="' + user_name_narrower + '">');
//     $('.workhistory').replaceWith('<textarea class="edit_workhistory form-control" type="text" name="user_workhistory" >' + user_workhistory);
//     $('.workhistory_narrow').replaceWith('<textarea class="edit_workhistory_narrow form-control" type="text" name="user_workhistory" >' + user_workhistory_narrow);
//     $('.workhistory_narrower').replaceWith('<textarea class="edit_workhistory_narrower form-control" type="text" name="user_workhistory" >' + user_workhistory_narrower);
//     $('.mypage').css('display', 'none');
//     $('.edit_profile_img').css('display', 'inline-block');
//     $('.btn_flex').css('display', 'flex');
//     $('.profile').addClass('editing');
//     $('.form').css('display', 'inline-block');
//     $('.tag').fadeOut();
// });

// モーダル画面出力ボタン押下時の処理
$(document).on('click', '.modal_btn', function() {
    var $target_modal = $(this).data("target")
    scroll_position = $(window).scrollTop();
    $('body').addClass('fixed').css({ 'top': -scroll_position });
    $($target_modal).fadeIn();
    $('.modal').fadeIn();
});

// 投稿モーダル画面出力処理
$(document).on('click', '.post_modal', function() {
    scroll_position = $(window).scrollTop();
    $('body').addClass('fixed').css({ 'top': -scroll_position });
    //   $('#myskills').replaceWith('');
    $('.slide_menu').removeClass('open');
    $('.post_process').fadeIn();
    $('.modal_post').fadeIn();
});

// 投稿モーダル画面出力処理
$(document).on('click', '.testcase_add', function() {
    scroll_position = $(window).scrollTop();
    $('body').addClass('fixed').css({ 'top': -scroll_position });
    $('.testcase_process').fadeIn();
    $('.modal_testcase').fadeIn();
});

$(document).on('click', '.prof_modal', function() {
    scroll_position = $(window).scrollTop();
    $('body').addClass('fixed').css({ 'top': -scroll_position });
    $('.slide_prof').fadeIn();
    $('.modal_prof').fadeIn();
    $('.slide_prof').addClass('open');
});

// ヘルプモーダル画面出力処理
// $(document).on('click', '.help_btn', function() {
//     scroll_position = $(window).scrollTop();
//     $('body').addClass('fixed').css({ 'top': -scroll_position });
//     $('.help_disp').fadeIn();
//     $('.modal_help').fadeIn();
//     $('.far.fa-times-circle.help_clear').fadeIn();
//     $(document).on('click', '.far.fa-times-circle.help_clear', function() {
//         $('.help_disp').fadeOut();
//         $('.modal_help').fadeOut();
//         $('.far.fa-times-circle.help_clear').fadeOut();
//     });
// });

$(document).on('click', '.withdraw', function() {
    scroll_position = $(window).scrollTop();
    $('body').addClass('fixed').css({ 'top': -scroll_position });
    // モーダルウィンドウを開く
    $('.withdraw_process').fadeIn();
    $('.modal_withdraw').fadeIn();
});

$(document).on('click', ".prof_close", function() {
    window.scrollTo(0, scroll_position);
    $('body').removeClass('fixed').css({ 'top': 0 });
    $('.slide_prof').fadeOut();
    $('.modal_prof').fadeOut();
    $('.slide_prof').removeClass('open');
});

//================================
// カウンタ処理
//================================

// テキストエリア内の文字数表示
$('#post_counter').on('input', function() {
    var count = $(this).val().length;
    $('.post_count').text(count);
    if (count > 300) {
        $('.post_count').css('color', '#FF7763');
    } else {
        $('.post_count').css('color', '#000');
    }
});

$('#comment_counter,#comment_counter_narrow,#comment_counter_narrower').on('input', function() {
    var count = $(this).val().length;
    $('.comment_count').text(count);
    if (count > 300) {
        $('comment_count').css('color', '#FF7763');
    } else {
        $('comment_count').css('color', '#FFF');
    }
});

$('#edit_counter,#edit_counter_narrow,#edit_counter_narrower').on('input', function() {
    var count = $(this).val().length;
    $('.post_edit_count').text(count);
    if (count > 300) {
        $('.post_edit_count').css('color', '#FF7763');
    } else {
        $('.post_edit_count').css('color', '#FFF');
    }
});

$('#post_process_counter').on('input', function() {
    var count = $(this).val().length;
    $('.post_process_count').text(count);
    if (count > 300) {
        $('.post_process_count').css('color', '#FF7763');
    } else {
        $('.post_process_count').css('color', '#FFF');
    }
});

$('#message_counter').on('input', function() {
    var count = $(this).val().length;
    $('.message_count').text(count);
    if (count > 300) {
        $('.message_count').css('color', '#FF7763');
    } else {
        $('.message_count').css('color', '#000');
    }
});

// 文字数が0文字、300文字以上以外ボタンを活性化
$(document).on('input', '.textarea', function() {
    if ($(this).val().length !== 0 && $(this).val().length <= 300) {
        $('#post').prop('disabled', false);
    } else {
        $('#post').prop('disabled', true);
    }
});

$(document).on('input', '.textarea', function() {
    if ($(this).val().length !== 0 && $(this).val().length <= 300) {
        $('#post_btn').prop('disabled', false);
    } else {
        $('#post_btn').prop('disabled', true);
    }
});

//================================
// スキルタグ処理（大画面）
//================================

var skill_list = [
    'AWS',
    'Bootstrap',
    'C',
    'CakePHP',
    'C#',
    'C++',
    'COBOL',
    'CSS',
    'Docker',
    'Go',
    'Git',
    'HTTP',
    'HTML',
    'iOS',
    'Java',
    'JavaScript',
    'JIRA',
    'Kotlin',
    'Laravel',
    'MATLAB',
    'MySQL',
    'Oracle Database',
    'Perl',
    'PHP',
    'PostgreSQL',
    'Python',
    'R',
    'React',
    'Ruby',
    'Ruby on Rails',
    'Rust',
    'SVN',
    'SSL',
    'SQLite',
    'TypeScript',
    'Vue.js'
];

$(function() {
    $("#skill_input").autocomplete({
        source: skill_list,
    });
});

$(function() {
    $("#skill_input_narrow").autocomplete({
        source: skill_list,
    });
});

// $(function() {
//     $("#skill_input_narrower").autocomplete({
//         source: "../autocomplete_skill.php"
//     });
// });
if (document.getElementById('skill_input') != null || document.getElementById('skill_input_narrow') != null) { // || document.getElementById('skill_input_narrower') != null) {
    let skill_input = document.getElementById('skill_input');
    let skill_input_narrow = document.getElementById('skill_input_narrow');
    // let skill_input_narrower = document.getElementById('skill_input_narrower');

    //skill_input.addEventListener('change', inputChange_skill);
    skill_input_narrow.addEventListener('change', inputChange_skill_narrow);
    // skill_input_narrower.addEventListener('change', inputChange_skill);

    var //skill = document.getElementById("skill"),
        skill_narrow = document.getElementById("skill_narrow"),
        // skill_narrower = document.getElementById("skill_narrower"),
        //spans = skill.getElementsByTagName("span"),
        spans_narrow = skill_narrow.getElementsByTagName("span_narrow");
    // spans_narrower = skill_narrower.getElementsByTagName("span_narrower");

    // 初期状態のタグ数でskill_countの値を決める
    // if (document.getElementById('skill_count').val) {
    //     if (spans.length > 3) {
    //         skill_count_val = spans.length % 3;
    //         switch (skill_count_val) {
    //             case 0:
    //                 document.getElementById('skill_count').val = 3;
    //                 break;

    //             case 1:
    //                 document.getElementById('skill_count').val = 1;
    //                 break;

    //             case 2:
    //                 document.getElementById('skill_count').val = 2;
    //                 break;

    //             default:
    //         }
    //     }
    // }

    // 初期状態のタグ数でskill_countの値を決める
    if (document.getElementById('skill_count_narrow').val === undefined) {
        if (spans_narrow.length > 3) {
            skill_count_val_narrow = spans_narrow.length % 3;
            switch (skill_count_val_narrow) {
                case 0:
                    document.getElementById('skill_count_narrow').val = 3;
                    break;

                case 1:
                    document.getElementById('skill_count_narrow').val = 1;
                    break;

                case 2:
                    document.getElementById('skill_count_narrow').val = 2;
                    break;

                default:
            }
        }
    }

    // 初期状態のタグ数でskill_countの値を決める
    // if (document.getElementById('skill_count_narrower').val === undefined) {
    //     if (spans_narrower.length > 3) {
    //         skill_count_val_narrower = spans.length % 3;
    //         switch (skill_count_val_narrower) {
    //             case 0:
    //                 document.getElementById('skill_count_narrower').val = 3;
    //                 break;

    //             case 1:
    //                 document.getElementById('skill_count_narrower').val = 1;
    //                 break;

    //             case 2:
    //                 document.getElementById('skill_count_narrower').val = 2;
    //                 break;

    //             default:
    //         }
    //     }
    // }
}

function inputChange_skill_narrow() {
    var fome_x_name = $('#skill_input').val(),
        fome_x_name_narrow = $('#skill_input_narrow').val(),
        // fome_x_name_narrower = $(this).val(),
        //skill = document.getElementById("skill"),
        skill_narrow = document.getElementById("skill_narrow"),
        // skill_narrower = document.getElementById("skill_narrower"),
        //skills = new Array(),
        skills_narrow = new Array(),
        // skills_narrower = new Array(),
        //spans = skill.getElementsByTagName("span"),
        spans_narrow = skill_narrow.getElementsByTagName("span");
    // spans_narrower = skill_narrower.getElementsByTagName("span");
    // for (i = 0; i < spans.length; i++) {
    //     skills[i] = spans[i].textContent;
    // }

    for (i = 0; i < spans_narrow.length; i++) {
        skills_narrow[i] = spans_narrow[i].textContent;
    }

    // for (i = 0; i < spans_narrower.length; i++) {
    //     skills_narrower[i] = spans_narrower[i].textContent;
    // }

    //skills = skills.join('');
    skills_narrow = skills_narrow.join('');
    // skills_narrower = skills_narrower.join('');

    // 既に入力済みのものはタグ追加しない
    // if (fome_x_name != '' && skills.indexOf(fome_x_name) != -1) { //|| skills_narrower.indexOf(fome_x_name_narrower) != -1) {
    //     return false;
    // }
    if (fome_x_name_narrow != '' && skills_narrow.indexOf(fome_x_name_narrow) != -1) { //|| skills_narrower.indexOf(fome_x_name_narrower) != -1) {
        return false;
    }
    // 入力した文字列がlistと合えばタグ追加
    if (skill_list.indexOf(fome_x_name_narrow) != -1) { // || skill_list.indexOf(fome_x_name_narrower) != -1) {

        var //span_element = document.createElement("span"),
            span_element_narrow = document.createElement("span"),
            // span_element_narrower = document.createElement("span"),
            //label_element = document.createElement("label"),
            label_element_narrow = document.createElement("label"),
            // label_element_narrower = document.createElement("label"),
            //i_element = document.createElement("i"),
            i_element_narrow = document.createElement("i"),
            // i_element_narrower = document.createElement("i"),
            //input_element = document.createElement("input"),
            input_element_narrow = document.createElement("input"),
            // input_element_narrower = document.createElement("input"),
            //newContent = document.createTextNode(fome_x_name),
            newContent_narrow = document.createTextNode(fome_x_name_narrow),
            // newContent_narrower = document.createTextNode(fome_x_name_narrower),
            //div_element = document.createElement("div"),
            div_element_narrow = document.createElement("div"),
            // div_element_narrower = document.createElement("div"),
            //parentDiv = document.getElementById("skill"),
            parentDiv_narrow = document.getElementById("skill_narrow"),
            // parentDiv_narrower = document.getElementById("skill_narrower"),
            //skill_count = document.getElementById('skill_count').val,
            skill_count_narrow = document.getElementById('skill_count_narrow').val;
        // skill_count_narrower = document.getElementById('skill_count_narrower').val;

        //span_element.appendChild(newContent);
        span_element_narrow.appendChild(newContent_narrow);
        // span_element_narrower.appendChild(newContent_narrower);
        //span_element.setAttribute("id", "child-span" + i + "");
        span_element_narrow.setAttribute("id", "child-span_narrow" + i + "");
        // span_element_narrower.setAttribute("id", "child-span_narrower" + i + "");
        //span_element.setAttribute("class", "skill_tag");
        span_element_narrow.setAttribute("class", "skill_tag");
        // span_element_narrower.setAttribute("class", "skill_tag");
        //span_element.setAttribute("style", "margin-right:4px;");
        span_element_narrow.setAttribute("style", "margin-right:4px;");
        // span_element_narrower.setAttribute("style", "margin-right:4px;");
        //div_element.setAttribute("id", "span" + i + "");
        div_element_narrow.setAttribute("id", "span_narrow" + i + "");
        // div_element_narrower.setAttribute("id", "span_narrower" + i + "");
        //i_element.setAttribute("class", "far fa-times-circle skill");
        i_element_narrow.setAttribute("class", "far fa-times-circle skill");
        // i_element_narrower.setAttribute("class", "far fa-times-circle skill");
        //input_element.setAttribute("type", "button");
        input_element_narrow.setAttribute("type", "button");
        input_element_narrow.setAttribute("style", "display:none;");
        // input_element_narrower.setAttribute("type", "button");

        // タグの改行があった場合
        if (0 < document.getElementById('skill_count_narrow').val) { //|| 0 < document.getElementById('skill_count_narrower').val) {
            i--;
            //var skills = new Array();
            var skills_narrow = new Array();
            // var skills_narrower = new Array();

            // 改行した列で再度文字数取得
            // for (k = 0; k < skill_count; k++) {
            //     skills[k] = spans[i].textContent;
            //     i--;
            // }

            // // 改行した列で再度文字数取得
            for (k = 0; k < skill_count_narrow; k++) {
                skills_narrow[k] = spans[i].textContent;
                i--;
            }

            // // 改行した列で再度文字数取得
            // for (k = 0; k < skill_count_narrower; k++) {
            //     skills_narrower[k] = spans[i].textContent;
            //     i--;
            // }
            //spans = '';
            spans_narrow = '';
            // spans_narrower = '';
            //skills = skills.join('');
            skills_narrow = skills_narrow.join('');
            // skills_narrower = skills_narrower.join('');

            // skill_countの値で改行後のタグ数を決める
            // switch (skill_count) {
            //     case 2:
            //         i += 1;
            //         spans = '@@';
            //         break;

            //     case 3:
            //         i += 2;
            //         spans = '@@@';
            //         break;
            //     case 4:
            //         i += 3;
            //         spans = '@@@@';
            //         break;

            //     case 5:
            //         i += 4;
            //         spans = '@@@@@';
            //         break;
            //     default:
            // }

            // // skill_countの値で改行後のタグ数を決める
            switch (skill_count_narrow) {
                case 2:
                    i += 1;
                    spans_narrow = '@@';
                    break;

                case 3:
                    i += 2;
                    spans_narrow = '@@@';
                    break;
                case 4:
                    i += 3;
                    spans_narrow = '@@@@';
                    break;

                case 5:
                    i += 4;
                    spans_narrow = '@@@@@';
                    break;
                default:
            }
            // // skill_countの値で改行後のタグ数を決める
            // switch (skill_count_narrower) {
            //     case 2:
            //         i += 1;
            //         spans_narrower = '@@';
            //         break;

            //     case 3:
            //         i += 2;
            //         spans_narrower = '@@@';
            //         break;
            //     case 4:
            //         i += 3;
            //         spans_narrower = '@@@@';
            //         break;

            //     case 5:
            //         i += 4;
            //         spans_narrower = '@@@@@';
            //         break;
            //     default:
            // }
            i++;
            //document.getElementById('skill_count').val += 1;
            document.getElementById('skill_count_narrow').val += 1;
            // document.getElementById('skill_count_narrower').val += 1;
        }

        // タグ数が３つ以上または、タグの文字数が９文字以上は改行
        if ((3 <= spans_narrow.length || 9 <= skills_narrow.length)) { //|| (3 <= spans_narrower.length || 9 <= skills_narrower.length)) {　　
            i--;
            if (document.getElementById('child-span' + i + '') !== null) { //|| document.getElementById('child-span_narrow' + i + '') !== null | document.getElementById('child-span_narrower' + i + '') !== null) {
                //parentDiv.insertBefore(div_element, document.getElementById('child-span' + i + ''));
                parentDiv_narrow.appendChild(div_element_narrow, document.getElementById('child-span_narrow' + i + ''));
                // parentDiv_narrower.appendChild(div_element_narrower, document.getElementById('child-span_narrower' + i + ''));
            }
            i++;
            //document.getElementById('skill_count').val = 1;
            document.getElementById('skill_count_narrow').val = 1;
            // document.getElementById('skill_count_narrower').val = 1;
        }
        i++;

        //parentDiv.insertBefore(span_element, parentDiv.firstChild);
        parentDiv_narrow.insertBefore(span_element_narrow, parentDiv_narrow.firstChild);
        // parentDiv_narrower.appendChild(span_element_narrower, parentDiv_narrower.firstChild);
        //span_element.appendChild(label_element, span_element.firstChild);
        span_element_narrow.appendChild(label_element_narrow, span_element_narrow.firstChild);
        // span_element_narrower.appendChild(label_element_narrower, span_element_narrower.firstChild);
        //label_element.insertBefore(i_element, label_element.firstChild);
        label_element_narrow.insertBefore(i_element_narrow, label_element_narrow.firstChild);
        // label_element_narrower.insertBefore(i_element_narrower, label_element_narrower.firstChild);
        //label_element.insertBefore(input_element, label_element.firstChild);
        label_element_narrow.insertBefore(input_element_narrow, label_element_narrow.firstChild);
        // label_element_narrower.insertBefore(input_element_narrower, label_element_narrower.firstChild);
        $(this).val('');
    }
}

// タグのバツ印がクリックされた場合
// $(document).on('click', '.far.fa-times-circle.skill', function() {
//     var k = 0,
//         skills = new Array(),
//         skill = document.getElementById("skill"),
//         spans = skill.getElementsByTagName("span"),
//         span = $(this).parents(".skill_tag")[0].textContent;

//     // skill_countの値を元に最終行のタグ情報を取得
//     switch (document.getElementById('skill_count').val) {
//         case 1:
//             var spans_count = spans.length - 1;
//             break;

//         case 2:
//             var spans_count = spans.length - 2;
//             break;

//         case 3:
//             var spans_count = spans.length - 3;
//             break;

//         default:
//     }
//     for (i = spans_count; i < spans.length; i++) {
//         skills[k] = spans[i].textContent;
//         k++;
//     }
//     $(this).parents(".skill_tag").remove();

//     skills = skills.join('');
//     if (skills.indexOf(span) != -1) {
//         document.getElementById('skill_count').val -= 1;
//     }
// });

// タグのバツ印がクリックされた場合
$(document).on('click', '.far.fa-times-circle.skill_narrow', function() {
    var k = 0,
        skills_narrow = new Array(),
        skill_narrow = document.getElementById("skill_narrow"),
        spans_narrow = skill_narrow.getElementsByTagName("span"),
        span_narrow = $(this).parents(".skill_tag")[0].textContent;

    // skill_countの値を元に最終行のタグ情報を取得
    switch (document.getElementById('skill_count_narrow').val) {
        case 1:
            var spans_count_narrow = spans_narrow.length - 1;
            break;

        case 2:
            var spans_count_narrow = spans_narrow.length - 2;
            break;

        case 3:
            var spans_count_narrow = spans_narrow.length - 3;
            break;

        default:
    }
    for (i = spans_count_narrow; i < spans_narrow.length; i++) {
        skills_narrow[k] = spans_narrow[i].textContent;
        k++;
    }
    $(this).parents(".skill_tag").remove();

    skills_narrow = skills_narrow.join('');
    if (skills_narrow.indexOf(span_narrow) != -1) {
        document.getElementById('skill_count_narrow').val -= 1;
    }
});

// タグのバツ印がクリックされた場合
// $(document).on('click', '.far.fa-times-circle.skill_narrower', function() {
//     var k = 0,
//         skills_narrower = new Array(),
//         skill_narrower = document.getElementById("skill_narrower"),
//         spans_narrower = skill_narrower.getElementsByTagName("span"),
//         span_narrower = $(this).parents(".skill_tag")[0].textContent;

//     // skill_countの値を元に最終行のタグ情報を取得
//     switch (document.getElementById('skill_count_narrower').val) {
//         case 1:
//             var spans_count_narrower = spans_narrower.length - 1;
//             break;

//         case 2:
//             var spans_count_narrower = spans_narrower.length - 2;
//             break;

//         case 3:
//             var spans_count_narrower = spans_narrower.length - 3;
//             break;

//         default:
//     }
//     for (i = spans_count_narrower; i < spans_narrower.length; i++) {
//         skills_narrower[k] = spans_narrower[i].textContent;
//         k++;
//     }
//     $(this).parents(".skill_tag").remove();

//     skills_narrower = skills_narrower.join('');
//     if (skills_narrower.indexOf(span_narrower) != -1) {
//         document.getElementById('skill_count_narrower').val -= 1;
//     }
// });

$(document).on('click', '.post_process_btn', function() {
    var //skill = document.getElementById("skill"),
        skill_narrow = document.getElementById("skill_narrow"),
        // skill = document.getElementById("skill_narrower"),
        //skill_div = document.getElementById("skills"),
        skill_div_narrow = document.getElementById("skills_narrow"),
        // skill_div_narrower = document.getElementById("skills_narrower"),
        //spans = skill.getElementsByTagName("span"),
        skills = new Array();
    document.getElementById('skill_count').val = 4;

    // for (i = 0; i < spans.length; i++) {
    //     skills[i] = spans[i].textContent;
    // }
    // skills = skills.join(' ');
    // skill_div.value = skills;
    skill_div_narrow.value = skills;
    // skill_div_narrower.value = skills;
});

// $(function() {
//     $("#skill_myprofile_input").autocomplete({
//         source: "/public/js/autocomplete/autocomplete_skill.php"
//     });
// });

// $("#skill_myprofile_input").autocomplete({
//     source: function(req, resp) {
//         $.ajax({
//             url: '/public/js/autocomplete/',
//             type: 'POST',
//             cache: false,
//             dataType: 'json',
//             data: {
//                 str: req.term
//             },
//             success: function(o) {
//                 resp(o.data);
//             },
//             error: function(xhr, ts, err) {
//                 resp(err);
//             }
//         });
//     },
//     //ここにAutocompleteのオプションを設定
// });

$(function() {
    $("#skill_myprofile_input").autocomplete({
        source: skill_list,
    });
});

if (document.getElementById('skill_myprofile_input') != null) {
    let skill_myprofile_input = document.getElementById('skill_myprofile_input'),
        myprofile_skill = document.getElementById("myprofile_skill"),
        myprofile_spans = myprofile_skill.getElementsByTagName("span");

    skill_myprofile_input.addEventListener('change', inputChange_skill);

    // 初期状態のタグ数でmyprofile_skill_countの値を決める
    if (document.getElementById('myprofile_skill_count').val) {
        if (myprofile_spans.length > 3) {
            myprofile_skill_count_val = myprofile_spans.length % 3;
            switch (myprofile_skill_count_val) {
                case 0:
                    document.getElementById('myprofile_skill_count').val = 3;
                    break;

                case 1:
                    document.getElementById('myprofile_skill_count').val = 1;
                    break;

                case 2:
                    document.getElementById('myprofile_skill_count').val = 2;
                    break;

                default:
            }
        }
    }
}

function inputChange_skill() {
    var fome_x_name_myprofile = $(this).val(),
        skill_myprofile = document.getElementById("myprofile_skill"),
        skills_myprofile = new Array(),
        spans_myprofile = skill_myprofile.getElementsByTagName("span");

    for (i = 0; i < spans_myprofile.length; i++) {
        skills_myprofile[i] = spans_myprofile[i].textContent;
    }

    skills_myprofile = skills_myprofile.join('');

    // 既に入力済みのものはタグ追加しない
    if (skills_myprofile.indexOf(fome_x_name_myprofile) != -1) {
        return false;
    }
    // 入力した文字列がlistと合えばタグ追加
    if (skill_list.indexOf(fome_x_name_myprofile) != -1) {
        var span_element_myprofile = document.createElement("span"),
            label_element_myprofile = document.createElement("label"),
            i_element_myprofile = document.createElement("i"),
            input_element_myprofile = document.createElement("input"),
            newContent_myprofile = document.createTextNode(fome_x_name_myprofile),
            div_element_myprofile = document.createElement("div"),
            parentDiv_myprofile = document.getElementById("myprofile_skill"),
            skill_count_myprofile = document.getElementById('myprofile_skill_count').val;

        span_element_myprofile.appendChild(newContent_myprofile);
        span_element_myprofile.setAttribute("id", "child-span_myprofile" + i + "");
        span_element_myprofile.setAttribute("class", "skill_tag");
        span_element_myprofile.setAttribute("style", "margin-right:4px;");
        div_element_myprofile.setAttribute("id", "span" + i + "");
        i_element_myprofile.setAttribute("class", "far fa-times-circle skill_myprofile");
        input_element_myprofile.setAttribute("type", "button");
        input_element_myprofile.setAttribute("style", "display:none;");

        // タグの改行があった場合
        if (0 < document.getElementById('myprofile_skill_count').val) {
            i--;
            var skills_myprofile = new Array();

            // 改行した列で再度文字数取得
            for (k = 0; k < skill_count_myprofile; k++) {
                skills_myprofile[k] = spans[i].textContent;
                i--;
            }
            spans_myprofile = '';
            skills_myprofile = skills.join('');

            // skill_countの値で改行後のタグ数を決める
            switch (skill_count_myprofile) {
                case 2:
                    i += 1;
                    spans_myprofile = '@@';
                    break;

                case 3:
                    i += 2;
                    spans_myprofile = '@@@';
                    break;
                case 4:
                    i += 3;
                    spans_myprofile = '@@@@';
                    break;

                case 5:
                    i += 4;
                    spans_myprofile = '@@@@@';
                    break;
                default:
            }

            i++;
            document.getElementById('myprofile_skill_count').val += 1;
        }

        // タグ数が３つ以上または、タグの文字数が９文字以上は改行
        // if ((3 <= spans_myprofile.length || 22 <= skills_myprofile.length)) {
        //     i--;
        //     if (document.getElementById('child-span_myprofile' + i + '') !== null) {
        //         parentDiv.insertBefore(div_element, document.getElementById('child-span_myprofile' + i + ''));
        //         parentDiv_myprofile.insertBefore(div_element_myprofile, document.getElementById('child-span_myprofile' + i + ''));
        //     }
        //     i++;
        //     document.getElementById('myprofile_skill_count').val = 1;
        // }
        i++;

        parentDiv_myprofile.insertBefore(span_element_myprofile, parentDiv_myprofile.firstChild);
        span_element_myprofile.appendChild(label_element_myprofile, span_element_myprofile.firstChild);
        label_element_myprofile.insertBefore(i_element_myprofile, label_element_myprofile.firstChild);
        label_element_myprofile.insertBefore(input_element_myprofile, label_element_myprofile.firstChild);
        $(this).val('');
    }
}

// タグのバツ印がクリックされた場合
$(document).on('click', '.far.fa-times-circle.skill_myprofile', function() {
    var k = 0,
        skills_myprofile = new Array(),
        skill_myprofile = document.getElementById("myprofile_skill"),
        spans_myprofile = skill_myprofile.getElementsByTagName("myprofile_span"),
        span_myprofile = $(this).parents(".skill_tag")[0].textContent;

    // skill_countの値を元に最終行のタグ情報を取得
    switch (document.getElementById('myprofile_skill_count').val) {
        case 1:
            var spans_count_myprofile = spans_myprofile.length - 1;
            break;

        case 2:
            var spans_count_myprofile = spans_myprofile.length - 2;
            break;

        case 3:
            var spans_count_myprofile = spans_myprofile.length - 3;
            break;

        default:
    }
    for (i = spans_count_myprofile; i < spans_myprofile.length; i++) {
        skills_myprofile[k] = spans_myprofile[i].textContent;
        k++;
    }
    $(this).parents(".skill_tag").remove();

    skills_myprofile = skills_myprofile.join('');
    if (skills_myprofile.indexOf(span_myprofile) != -1) {
        document.getElementById('myprofile_skill_count').val -= 1;
    }
});

//================================
// 資格タグ処理
//================================

const licence_list = new Array(
    'ITパスポート',
    '基本情報技術者',
    '応用情報技術者',
    'ITストラテジスト',
    'ITサービスマネージャー',
    'プロジェクトマネージャー',
    'システム監査技術者',
    'エンベデッドシステムスペシャリスト',
    'システムアーキテクト',
    'データベーススペシャリスト',
    'ネットワークスペシャリスト',
    '情報セキュリティスペシャリスト'
);

$(function() {
    $("#licence_input").autocomplete({
        source: licence_list,
    });
});

$(function() {
    $("#licence_input_narrow").autocomplete({
        source: licence_list,
    });
});

// $(function() {
//     $("#licence_input_narrower").autocomplete({
//         source: "../autocomplete_licence.php"
//     });
// });

if (document.getElementById('licence_input') != null || document.getElementById('licence_input_narrow') != null || document.getElementById('licence_input_narrower') != null) {
    let licence_input = document.getElementById('licence_input'),
        licence_input_narrow = document.getElementById('licence_input_narrow');
    // licence_input_narrower = document.getElementById('licence_input_narrower');
    licence_input.addEventListener('change', inputChange_licence);
    licence_input_narrow.addEventListener('change', inputChange_licence);
    // licence_input_narrower.addEventListener('change', inputChange_licence);

    var licence = document.getElementById("licence"),
        licence_narrow = document.getElementById("licence_narrow");
    // licence_narrower = document.getElementById("licence_narrower"),
    spans = licence.getElementsByTagName("span");
    spans_narrow = licence_narrow.getElementsByTagName("span");
    // spans_narrower = licence_narrower.getElementsByTagName("span");

    // 初期状態のタグ数でlicence_countの値を決める
    if (document.getElementById('licence_count').val === undefined || document.getElementById('licence_count_narrow').val) { // || document.getElementById('licence_count_narrower').val) {
        if (spans.length > 3 || spans_narrow.length > 3) { //|| spans_narrower.length > 3) {
            licence_count_val = spans.length % 3;
            licence_count_val_narrow = spans_narrow.length % 3;
            // licence_count_val_narrower = spans_narrower.length % 3;
            switch (licence_count_val) {
                case 0:
                    document.getElementById('licence_count').val = 3;
                    break;

                case 1:
                    document.getElementById('licence_count').val = 1;
                    break;

                case 2:
                    document.getElementById('licence_count').val = 2;
                    break;

                default:
            }

            switch (licence_count_val_narrow) {
                case 0:
                    document.getElementById('licence_count_narrow').val = 3;
                    break;

                case 1:
                    document.getElementById('licence_count_narrow').val = 1;
                    break;

                case 2:
                    document.getElementById('licence_count_narrow').val = 2;
                    break;

                default:
            }
            // switch (licence_count_val_narrower) {
            //     case 0:
            //         document.getElementById('licence_count_narrower').val = 3;
            //         break;

            //     case 1:
            //         document.getElementById('licence_count_narrower').val = 1;
            //         break;

            //     case 2:
            //         document.getElementById('licence_count_narrower').val = 2;
            //         break;

            //     default:
            // }
        }
    }
}

function inputChange_licence() {
    var fome_x_name = $(this).val(),
        fome_x_name_narrow = $(this).val(),
        // fome_x_name_narrower = $(this).val(),
        licence = document.getElementById("licence"),
        licence_narrow = document.getElementById("licence_narrow"),
        // licence_narrower = document.getElementById("licence_narrower"),
        licences = new Array(),
        licences_narrow = new Array(),
        // licences_narrower = new Array(),
        spans = licence.getElementsByTagName("span"),
        spans_narrow = licence_narrow.getElementsByTagName("span");
    // spans_narrower = licence_narrower.getElementsByTagName("span");

    for (i = 0; i < spans.length; i++) {
        licences[i] = spans[i].textContent;
    }

    for (i = 0; i < spans_narrow.length; i++) {
        licences_narrow[i] = spans_narrow[i].textContent;
    }

    // for (i = 0; i < spans_narrower.length; i++) {
    //     licences_narrower[i] = spans_narrower[i].textContent;
    // }

    licences = licences.join('');
    licences_narrow = licences_narrow.join('');
    // licences_narrower = licences_narrower.join('');

    // 既に入力済みのものはタグ追加しない
    if (licences.indexOf(fome_x_name) != -1) {
        return false;
    }

    // // 既に入力済みのものはタグ追加しない
    if (licences_narrow.indexOf(fome_x_name_narrow) != -1) {
        return false;
    }
    // // 既に入力済みのものはタグ追加しない
    // if (licences_narrower.indexOf(fome_x_name_narrower) != -1) {
    //     return false;
    // }
    // 入力した文字列がlistと合えばタグ追加
    if (licence_list.indexOf(fome_x_name) != -1) { // || licence_lists.indexOf(fome_x_name_narrow) != -1 || licences_list.indexOf(fome_x_name_narrower) != -1) {

        var span_element = document.createElement("span"),
            span_element_narrow = document.createElement("span"),
            // span_element_narrower = document.createElement("span"),
            label_element = document.createElement("label"),
            label_element_narrow = document.createElement("label"),
            // label_element_narrower = document.createElement("label"),
            i_element = document.createElement("i"),
            i_element_narrow = document.createElement("i"),
            // i_element_narrower = document.createElement("i"),
            input_element = document.createElement("input"),
            input_element_narrow = document.createElement("input"),
            // input_element_narrower = document.createElement("input"),
            newContent = document.createTextNode(fome_x_name),
            newContent_narrow = document.createTextNode(fome_x_name_narrow),
            // newContent_narrower = document.createTextNode(fome_x_name_narrower),
            div_element = document.createElement("div"),
            div_element_narrow = document.createElement("div"),
            // div_element_narrower = document.createElement("div"),
            parentDiv = document.getElementById("licence"),
            parentDiv_narrow = document.getElementById("licence_narrow"),
            // parentDiv_narrower = document.getElementById("licence_narrower"),
            licence_count = document.getElementById('licence_count').val;
        licence_count_narrow = document.getElementById('licence_count_narrow').val,
            // licence_count_narrower = document.getElementById('licence_count_narrower').val;

            span_element.appendChild(newContent);
        span_element_narrow.appendChild(newContent_narrow);
        // span_element_narrower.appendChild(newContent_narrower);
        span_element.setAttribute("id", "child-span" + i + "");
        span_element_narrow.setAttribute("id", "child-span_narrow" + i + "");
        // span_element_narrower.setAttribute("id", "child-span_narrower" + i + "");
        span_element.setAttribute("class", "licence_tag");
        span_element_narrow.setAttribute("class", "licence_tag_narrow");
        // span_element_narrower.setAttribute("class", "licence_tag_narrower");
        span_element.setAttribute("style", "margin-right:4px;");
        span_element_narrow.setAttribute("style", "margin-right:4px;");
        // span_element_narrower.setAttribute("style", "margin-right:4px;");
        div_element.setAttribute("id", "span" + i + "");
        div_element_narrow.setAttribute("id", "span_narrow" + i + "");
        // div_element_narrower.setAttribute("id", "span_narrower" + i + "");
        i_element.setAttribute("class", "far fa-times-circle licence");
        i_element_narrow.setAttribute("class", "far fa-times-circle licence_narrow");
        // i_element_narrower.setAttribute("class", "far fa-times-circle licence_narrower");
        input_element.setAttribute("type", "button");
        input_element_narrow.setAttribute("type", "button");
        input_element.setAttribute("style", "display:none;");
        input_element_narrow.setAttribute("style", "display:none;");
        // input_element_narrower.setAttribute("type", "button");

        // タグの改行があった場合
        if (0 < document.getElementById('licence_count').val || 0 < document.getElementById('licence_count_narrow').val) { //|| 0 < document.getElementById('licence_count_narrower').val) {
            i--;
            var licences = new Array();
            var licences_narrow = new Array();
            // var licences_narrower = new Array();

            // 改行した列で再度文字数取得
            for (k = 0; k < licence_count; k++) {
                licences[k] = spans[i].textContent;
                i--;
            }

            // // 改行した列で再度文字数取得
            for (k = 0; k < licence_count_narrow; k++) {
                licences_narrow[k] = spans_narrow[i].textContent;
                i--;
            }
            // // 改行した列で再度文字数取得
            // for (k = 0; k < licence_count_narrower; k++) {
            //     licences_narrower[k] = spans_narrower[i].textContent;
            //     i--;
            // }
            spans = '';
            spans_narrow = '';
            // spans_narrower = '';
            licences = licences.join('');
            licences_narrow = licences_narrow.join('');
            // licences_narrower = licences_narrower.join('');

            // licence_countの値で改行後のタグ数を決める
            switch (licence_count) {
                case 2:
                    i += 1;
                    spans = '@@';
                    break;

                case 3:
                    i += 2;
                    spans = '@@@';
                    break;
                case 4:
                    i += 3;
                    spans = '@@@@';
                    break;

                case 5:
                    i += 4;
                    spans = '@@@@@';
                    break;
                default:
            }

            // licence_countの値で改行後のタグ数を決める
            switch (licence_count_narrow) {
                case 2:
                    i += 1;
                    spans_narrow = '@@';
                    break;

                case 3:
                    i += 2;
                    spans_narrow = '@@@';
                    break;
                case 4:
                    i += 3;
                    spans_narrow = '@@@@';
                    break;

                case 5:
                    i += 4;
                    spans_narrow = '@@@@@';
                    break;
                default:
            }

            // // licence_countの値で改行後のタグ数を決める
            // switch (licence_count_narrower) {
            //     case 2:
            //         i += 1;
            //         spans_narrower = '@@';
            //         break;

            //     case 3:
            //         i += 2;
            //         spans_narrower = '@@@';
            //         break;
            //     case 4:
            //         i += 3;
            //         spans_narrower = '@@@@';
            //         break;

            //     case 5:
            //         i += 4;
            //         spans_narrower = '@@@@@';
            //         break;
            //     default:
            // }

            i++;
            document.getElementById('licence_count').val += 1;
            document.getElementById('licence_count_narrow').val += 1;
            // document.getElementById('licence_count_narrower').val += 1;
        }

        // タグ数が３つ以上または、タグの文字数が９文字以上は改行
        if ((3 <= spans.length || 9 <= licences.length) || (3 <= spans_narrow.length || 9 <= licences_narrow.length)) { //|| (3 <= spans_narrower.length || 9 <= licences_narrower.length)) {　　
            i--;
            if (document.getElementById('child-span' + i + '') !== null || document.getElementById('child-span_narrow' + i + '') !== null) { //|| document.getElementById('child-span_narrower' + i + '') !== null) {
                parentDiv.appendChild(div_element, document.getElementById('child-span' + i + ''));
                parentDiv_narrow.appendChild(div_element_narrow, document.getElementById('child-span_narrow' + i + ''));
                // parentDiv_narrower.appendChild(div_element_narrower, document.getElementById('child-span_narrower' + i + ''));
            }
            i++;

            document.getElementById('licence_count').val = 1;
            document.getElementById('licence_count_narrow').val = 1;
            // document.getElementById('licence_count_narrower').val = 1;
        }
        i++;

        parentDiv.insertBefore(span_element, parentDiv.firstChild);
        parentDiv_narrow.insertBefore(span_element_narrow, parentDiv_narrow.firstChild);
        // parentDiv_narrower.appendChild(span_element_narrower, parentDiv_narrower.firstChild);
        span_element.appendChild(label_element, span_element.firstChild);
        span_element_narrow.appendChild(label_element_narrow, span_element_narrow.firstChild);
        // span_element_narrower.appendChild(label_element_narrower, span_element_narrower.firstChild);
        label_element.insertBefore(i_element, label_element.firstChild);
        label_element_narrow.insertBefore(i_element_narrow, label_element_narrow.firstChild);
        // label_element_narrower.insertBefore(i_element_narrower, label_element_narrower.firstChild);
        label_element.insertBefore(input_element, label_element.firstChild);
        label_element_narrow.insertBefore(input_element_narrow, label_element_narrow.firstChild);
        // label_element_narrower.insertBefore(input_element_narrower, label_element_narrower.firstChild);

        $(this).val('');
    }
}

$(document).on('click', '.far.fa-times-circle.licence', function() {
    var k = 0,
        licences = new Array(),
        licence = document.getElementById("licence"),
        spans = licence.getElementsByTagName("span"),
        span = $(this).parents(".licence_tag")[0].textContent;

    // skill_countの値を元に最終行のタグ情報を取得
    switch (document.getElementById('licence_count').val) {
        case 1:
            var spans_count = spans.length - 1;
            break;

        case 2:
            var spans_count = spans.length - 2;
            break;

        case 3:
            var spans_count = spans.length - 3;
            break;

        default:
    }

    for (i = spans_count; i < spans.length; i++) {
        licences[k] = spans[i].textContent;
        k++;
    }

    $(this).parents(".licence_tag").remove();

    licences = licences.join('');

    if (licences.indexOf(span) != -1) {
        document.getElementById('licence_count').val -= 1;
    }
});


$(document).on('click', '.far.fa-times-circle.licence_narrow', function() {
    var k = 0,
        licences_narrow = new Array(),
        licence_narrow = document.getElementById("licence_narrow"),
        spans_narrow = licence_narrow.getElementsByTagName("span"),
        span_narrow = $(this).parents(".licence_tag_narrow")[0].textContent;

    // skill_countの値を元に最終行のタグ情報を取得
    switch (document.getElementById('licence_count_narrow').val) {
        case 1:
            var spans_count_narrow = spans_narrow.length - 1;
            break;

        case 2:
            var spans_count_narrow = spans_narrow.length - 2;
            break;

        case 3:
            var spans_count_narrow = spans_narrow.length - 3;
            break;

        default:
    }

    for (i = spans_count_narrow; i < spans_narrow.length; i++) {
        licences_narrow[k] = spans_narrow[i].textContent;
        k++;
    }

    $(this).parents(".licence_tag_narrow").remove();

    licences_narrow = licences_narrow.join('');

    if (licences_narrow.indexOf(span_narrow) != -1) {
        document.getElementById('licence_count_narrow').val -= 1;
    }
});


// $(document).on('click', '.far.fa-times-circle.licence_narrower', function() {
//     var k = 0,
//         licences_narrower = new Array(),
//         licence_narrower = document.getElementById("licence_narrower"),
//         spans_narrower = licence_narrower.getElementsByTagName("span"),
//         span_narrower = $(this).parents(".licence_tag_narrower")[0].textContent;

//     // skill_countの値を元に最終行のタグ情報を取得
//     switch (document.getElementById('licence_count_narrower').val) {
//         case 1:
//             var spans_count_narrower = spans_narrower.length - 1;
//             break;

//         case 2:
//             var spans_count_narrower = spans_narrower.length - 2;
//             break;

//         case 3:
//             var spans_count_narrower = spans_narrower.length - 3;
//             break;

//         default:

//             for (i = spans_count_narrower; i < spans_narrower.length; i++) {
//                 licences_narrower[k] = spans_narrower[i].textContent;
//                 k++;
//             }
//     }
//     $(this).parents(".licence_tag_narrower").remove();

//     licences_narrower = licences_narrower.join('');

//     if (licences_narrower.indexOf(span_narrower) != -1) {
//         document.getElementById('licence_count_narrower').val -= 1;
//     }
// });

$(document).on('click', '.edit_done', function() {
    var skill_narrow = document.getElementById("skill_narrow"),
        myprofile_skill = document.getElementById("myprofile_skill"),
        licence = document.getElementById("licence"),
        licence_narrow = document.getElementById("licence_narrow"),
        // licence_narrower = document.getElementById("licence_narrower"),
        skill_div_narrow = document.getElementById("skills_narrow"),
        myprofile_skill_div = document.getElementById("myprofile_skills"),
        licence_div = document.getElementById("myprofile_licences"),
        licence_div_narrow = document.getElementById("licences_narrow"),
        // licence_div_narrower = document.getElementById("licences_narrower"),
        spans_skill_narrow = skill_narrow.getElementsByTagName("span"),
        myprofile_spans = myprofile_skill.getElementsByTagName("span"),
        spans = licence.getElementsByTagName("span"),
        spans_licence_narrow = licence_narrow.getElementsByTagName("span"),
        // spans_narrower = licence_narrower.getElementsByTagName("span"),
        skills_narrow = new Array(),
        myprofile_skills = new Array(),
        licences = new Array(),
        licences_narrow = new Array(),
        // licences_narrower = new Array(),s
        workhistory_count = $('.edit_workhistory').val().length;

    // skills = skills.join(' ');
    // skill_div.value = skills;
    // skill_div_narrow.value = skills;
    // skill_div_narrower.value = skills;

    if (100 < workhistory_count) {
        $('.edit_workhistory')[0].setAttribute("style", "border-color: #dc3545;");
        $('.error_workhistory').fadeIn();
        return false;
    }

    document.getElementById('skill_count_narrow').val = 4;
    document.getElementById('myprofile_skill_count').val = 4;
    document.getElementById('licence_count').val = 4;
    document.getElementById('licence_count_narrow').val = 4;
    // document.getElementById('licence_count_narrower').val = 4;

    for (i = 0; i < spans_skill_narrow.length; i++) {
        skills_narrow[i] = spans_skill_narrow[i].textContent;
    }
    for (i = 0; i < myprofile_spans.length; i++) {
        myprofile_skills[i] = myprofile_spans[i].textContent;
    }
    for (i = 0; i < spans.length; i++) {
        licences[i] = spans[i].textContent;
    }
    for (i = 0; i < spans_licence_narrow.length; i++) {
        licences_narrow[i] = spans_licence_narrow[i].textContent;
    }
    // for (i = 0; i < spans_narrower.length; i++) {
    //     licences_narrower[i] = spans_narrower[i].textContent;
    // }
    skills_narrow = skills_narrow.join(' ');
    myprofile_skills = myprofile_skills.join(' ');
    licences = licences.join(' ');
    licences_narrow = licences_narrow.join(' ');
    // licences_narrower = licences_narrower.join(' ');
    //skill_div_narrow.value = skills_narrow;
    if ($(window).width() <= 980) {
        myprofile_skill_div.value = $('.skill_select')[0].value;
        licence_div.value = $('.licence_select')[0].value;
    }else{
        myprofile_skill_div.value = myprofile_skills;
        licence_div.value = licences;
    }
    // licence_div_narrow.value = licences_narrow;
    // licence_div_narrower.value = licences_narrower;

    //$('.workhistory').val() = $('.edit_workhistory').val;

    // var error=0;
    // if ($('.edit_age')[0].value == '') {
    //     $('.edit_age')[0].setAttribute("style", "border-color: #dc3545;width: 35%;display: inline-block;margin-right: 0.5rem;");
    //     $('.user_age_error').fadeIn();
    //     error++;
    // }
    // if($('.edit_profile')[0].value == ''){
    //     $('.edit_profile')[0].setAttribute("style", "border-color: #dc3545;height: 30%;width: 126%;");
    //     $('.user_profile_error').fadeIn();
    //     error++;
    // }
    // if ($('.edit_address')[0].value == '') {
    //     $('.edit_address')[0].setAttribute("style", "border-color: #dc3545;");
    //     $('.user_address_error').fadeIn();
    //     error++;
    // }
    // if ($('.edit_occupation')[0].value == '') {
    //     $('.edit_occupation')[0].setAttribute("style", "border-color: #dc3545;width:auto;");
    //     $('.user_occupation_error').fadeIn();
    //     error++;
    // }
    // if ($('.edit_workhistory')[0].value == '') {
    //     $('.edit_workhistory')[0].setAttribute("style", "border-color: #dc3545;height: 40%;width: 75%;");
    //     $('.user_workhistory_error').fadeIn();
    //     error++;
    // }
    // if(0 < error){
    //     return false;
    // }
});

// 必須チェック解除
$(document).ready(function() {
    $('.edit_age').change(function() {
        var str = $(this).value;
        if (str != '') {
            $('.edit_age')[0].setAttribute("style", "border-color: #ced4da;width: 35%;display: inline-block;margin-right: 0.5rem;");
            $('.user_age_error').fadeOut();
        }
    });
    $('.edit_address').change(function() {
        var str = $(this).value;
        if (str != '') {
            $('.edit_address')[0].setAttribute("style", "border-color: #ced4da;");
            $('.user_address_error').fadeOut();
        }
    });
    $('.edit_occupation').change(function() {
        var str = $(this).value;
        if (str != '') {
            $('.edit_occupation')[0].setAttribute("style", "border-color: #ced4da;width:auto;");
            $('.user_occupation_error').fadeOut();
        }
    });
    $('.edit_profile').change(function() {
        var str = $(this).value;
        if (str != '') {
            $('.edit_profile')[0].setAttribute("style", "border-color: #ced4da;height: 30%;width: 126%;");
            $('.user_profile_error').fadeOut();
        }
    });
    $('.edit_workhistory').change(function() {
        var str = $(this).value;
        if (str != '') {
            $('.edit_workhistory')[0].setAttribute("style", "border-color: #ced4da;height: 40%;width: 75%;");
            $('.user_workhistory_error').fadeOut();
        }
    });
});

$('.skill_btn').on('click', function() {
    if ($('.skill_btn').hasClass('closed')) {
        $('.skill_btn').attr('class', 'fas fa-plus skill_btn');
        $('.skill_tag.extra').fadeOut(1000);
    } else {
        $('.skill_btn').attr('class', 'fas fa-minus skill_btn closed');
        $('.skill_tag').fadeIn(1000);
    }
});

$('.skill_btn_narrow').on('click', function() {
    if ($('.skill_btn_narrow').hasClass('closed')) {
        $('.skill_btn_narrow').attr('class', 'fas fa-plus skill_btn_narrow');
        $('.skill_tag.extra').fadeOut(1000);
    } else {
        $('.skill_btn_narrow').attr('class', 'fas fa-minus skill_btn_narrow closed');
        $('.skill_tag').fadeIn(1000);
    }
});

$('.myprofile_skill_btn').on('click', function() {
    if ($('.myprofile_skill_btn').hasClass('closed')) {
        $('.myprofile_skill_btn').attr('class', 'fas fa-plus myprofile_skill_btn');
        $('.skill_tag.extra').fadeOut(1000);
    } else {
        $('.myprofile_skill_btn').attr('class', 'fas fa-minus myprofile_skill_btn closed');
        $('.skill_tag').fadeIn(1000);
    }
});

$('.licence_btn').on('click', function() {
    if ($('.licence_btn').hasClass('closed')) {
        $('.licence_btn').attr('class', 'fas fa-plus licence_btn');
        $('.licence_tag.extra').fadeOut(1000);
    } else {
        $('.licence_btn').attr('class', 'fas fa-minus licence_btn closed');
        $('.licence_tag').fadeIn(1000);
    }
});

$('.licence_btn_narrow').on('click', function() {
    if ($('.licence_btn_narrow').hasClass('closed')) {
        $('.licence_btn_narrow').attr('class', 'fas fa-plus licence_btn_narrow');
        $('.licence_tag.extra').fadeOut(1000);
    } else {
        $('.licence_btn_narrow').attr('class', 'fas fa-minus licence_btn_narrow closed');
        $('.licence_tag').fadeIn(1000);
    }
});

$('.myprofile_licence_btn').on('click', function() {
    if ($('.myprofile_licence_btn_narrow').hasClass('closed')) {
        $('.myprofile_licence_btn_narrow').attr('class', 'fas fa-plus myprofile_licence_btn_narrow');
        $('.myprofile_licence_tag.extra').fadeOut(1000);
    } else {
        $('.myprofile_licence_btn_narrow').attr('class', 'fas fa-minus myprofile_licence_btn_narrow closed');
        $('.myprofile_licence_tag').fadeIn(1000);
    }
});

//================================
// その他
//================================

// 省略されている投稿の高さを取得
$(document).on('click', '.show_all', function() {
    $(document).find('.post_text').removeClass('ellipsis');
    $(this).remove();
});

// メッセージリンク押下時の処理
$(document).on('click', "#message_link", function() {
    $('#message_count').fadeOut();
});

$(document).on('focus', '.textarea', function() {
    $('#post').prop('disabled', false);
});

$(document).on('focus', '.textarea', function() {
    $('#post_btn').prop('disabled', false);
});

// 省略されているスレッドの表示
$(document).on('click', '.thread_btn', function() {
    var $target_modal = $(this).data("target"),
        omit_height = $(this).parent().height();
    scroll_position = $(window).scrollTop();
    $(this).remove();
    $($target_modal).fadeIn();
    $(this).parent().height(omit_height);
});

$(document).on('click', '#next', function() {
    $('.my_post').fadeIn();
    $('.woman').fadeOut();
});

$(document).on('click', '#before', function() {
    $('.my_post').fadeOut();
    $('.woman').fadeIn();
});

/**
* タッチ操作での拡大縮小禁止
*/
function no_scaling() {
    document.addEventListener("touchmove", mobile_no_scroll, { passive: false });
}

/**
* タッチ操作での拡大縮小禁止解除
*/
function return_scaling() {
    document.removeEventListener('touchmove', mobile_no_scroll, { passive: false });
}

/**
* 拡大縮小禁止
*/
function mobile_no_scroll(event) {
    // ２本指での操作の場合
    if (event.touches.length >= 2) {
        // デフォルトの動作をさせない
        event.preventDefault();
    }
}

// 各種ツールチップ処理
$('[data-toggle="favorite"]').tooltip();
$('[data-toggle="post"]').tooltip();
$('[data-toggle="edit"]').tooltip();
$('[data-toggle="delete"]').tooltip();
$('[data-toggle="reply"]').tooltip();