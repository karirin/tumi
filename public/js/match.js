// // 変数定義
// var user_age = $('.form .age').text(),
//     user_age_narrow = $('.form .age_narrow').text(),
//     user_occupation = $('.form .occupation').text(),
//     user_occupation_narrow = $('.form .occupation_narrow').text(),
//     user_address = $('.form .address').text(),
//     user_address_narrow = $('.form .address_narrow').text(),
//     user_workhistory = $('.form .workhistory').text(),
//     user_workhistory_narrow = $('.form .workhistory_narrow').text(),
//     user_profile = $('.user_profile').text();
//     if ($('.myskills').length) {
//         user_skill = $('.myskills')[0].value;
//     }
//     if ($('.mylicences').length) {
//         user_licence = $('.mylicences')[0].value;
//     }

window.onload = function() {
    $("#splash").delay(100).fadeOut('slow'); //ローディング画面を1.5秒（1500ms）待機してからフェードアウト
    $("#splash_logo").delay(100).fadeOut('slow'); //ロゴを1.2秒（1200ms）待機してからフェードアウト
    $("#splash-logo").delay(1200).fadeOut('slow'); //ロゴを1.2秒でフェードアウトする記述

    //=====ここからローディングエリア（splashエリア）を1.5秒でフェードアウトした後に動かしたいJSをまとめる
    $("#splash").delay(1500).fadeOut('slow', function() { //ローディングエリア（splashエリア）を1.5秒でフェードアウトする記述
        $('body').addClass('appear'); //フェードアウト後bodyにappearクラス付与
    });
    //=====ここまでローディングエリア（splashエリア）を1.5秒でフェードアウトした後に動かしたいJSをまとめる

    //=====ここから背景が伸びた後に動かしたいJSをまとめたい場合は
    $('.splashbg').on('animationend', function() {
        //この中に動かしたいJSを記載
    });

//     switch (location.pathname) {
//         case "/":
//         case "/user/test_login":
//             $('.sagasu')[0].setAttribute("style", 'background-color: antiquewhite;');
//             $('.smartphone_header .sagasu')[0].setAttribute("style", 'color: #000;');
//             break;
//         case "/match/match":
//             $('.oaitekara')[0].setAttribute("style", 'background-color: antiquewhite;');
//             $('.smartphone_header .oaitekara')[0].setAttribute("style", 'color: #000;');
//             break;
//         case "/message/message_top":
//             $('.messe-ji')[0].setAttribute("style", 'background-color: antiquewhite;');
//             $('.smartphone_header .messe-ji')[0].setAttribute("style", 'color: #000;');
//             break;
//         case "/message/message":
//         case "/message/add":
//             $('.messe-ji')[0].setAttribute("style", 'background-color: antiquewhite;');
//             $('.smartphone_header .messe-ji')[0].setAttribute("style", 'color: #000;');
//             break;
//         case "/user/profile":
//             $('.profile')[0].setAttribute("style", 'background-color: antiquewhite;');
//             $('.smartphone_header .profile')[0].setAttribute("style", 'color: #000;');
//             break;
//         case "/":
//             $('.sagasu')[0].setAttribute("style", 'background-color: antiquewhite;');
//             $('.smartphone_header .sagasu')[0].setAttribute("style", 'color: #000;');
//             break;
//     }

//     // 職種ごとで色分け
//     for (i = 0; i < $('.match_user').length; i++) {
//         switch ($('.match_user_occupation')[i].textContent) {
//             case "ネットワークエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #cb30ff2b;');
//                 break;
//             case "Webエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #0005ff2b;');
//                 break;
//             case "フロントエンドエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #4cfceb2b;');
//                 break;
//             case "インフラエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #edcf312b;');
//                 break;
//             case "サーバーエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #b100a72b;');
//                 break;
//             case "データベースエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #c571272b;');
//                 break;
//             case "IoTエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #b6082c2b;');
//                 break;
//             case "制御・組み込みエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #1ab53d2b;');
//                 break;
//             case "テストエンジニア":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #0057212b;');
//                 break;
//             case "その他":
//                 $('.match_user_occupation')[i].setAttribute("style", 'background-color: #3738372b');
//                 break;
//             default:
//         }
//     }

//     // メッセージ出力処理
//     if ($('.login_message').length) {
//         if ($('.login_message')[0].textContent !== "") {
//             $('.login_message').fadeIn();
//             $('.login_message').fadeOut(3000);
//         }
//     }

//     if ($('.top_message').length) {
//         if ($('.top_message')[0].textContent !== "") {
//             $('.top_message').fadeIn();
//             $('.top_message').fadeOut(3000);
//         }
//     }

//     if ($('.add_message').length) {
//         if ($('.add_message')[0].textContent !== "") {
//             $('.add_message').fadeIn();
//             $('.add_message').fadeOut(3000);
//         }
//     }

//     if ($('.mail_message').length) {
//         if ($('.mail_message')[0].textContent !== "") {
//             $('.mail_message').fadeIn();
//             $('.mail_message').fadeOut(3000);
//         }
//     }
}

// // 編集ボタン押下時の処理
// $(document).on('click', '.profile_edit_btn', function() {
//     scroll_position = $(this).scrollTop();
//     $('.profile_edit_btn').hide();
//     $('.myprofile_count').hide();
//     $('.follow_user').hide();
//     $('.comment').replaceWith('<textarea class="edit_comment form-control" type="text" name="user_comment" >' + user_comment);
//     $('.profile_name').replaceWith('<input class="edit_name form-control" type="text" name="user_name" value="' + user_name + '">');
//     $('.profile_name_narrow').replaceWith('<input class="edit_name form-control" type="text" name="user_name_narrow" value="' + user_name_narrow + '">');
//     $('.form .age').replaceWith('<input class="edit_age form-control" type="number" name="user_age" value="' + user_age + '" style="width: 30%;display: inline-block;margin-right: 0.5rem;">');
//     $('.form .age_narrow').replaceWith('<input class="edit_age form-control" type="number" name="user_age_narrow" value="' + user_age_narrow + '" style="width: 30%;display: inline-block;margin-right: 0.5rem;">');
//     $('.form .occupation').replaceWith('<select name="occupation" class="form-control edit_occupation" style="width: 93%;" value="' + user_occupation + '"><option value="">--選択してください--</option><option value="ネットワークエンジニア">ネットワークエンジニア</option><option value="Webエンジニア">Webエンジニア</option><option value="フロントエンドエンジニア">フロントエンドエンジニア</option><option value="インフラエンジニア">インフラエンジニア</option><option value="サーバーエンジニア">サーバーエンジニア</option><option value="データベースエンジニア">データベースエンジニア</option><option value="IoTエンジニア">IoTエンジニア</option><option value="制御・組み込みエンジニア">制御・組み込みエンジニア</option><option value="テストエンジニア">テストエンジニア</option><option value="その他">その他</option></select>');
//     $('.form .occupation_narrow').replaceWith('<select name="occupation_narrow" class="form-control edit_occupation" value="' + user_occupation_narrow + '"><option value="">--選択してください--</option><option value="ネットワークエンジニア">ネットワークエンジニア</option><option value="Webエンジニア">Webエンジニア</option><option value="フロントエンドエンジニア">フロントエンドエンジニア</option><option value="インフラエンジニア">インフラエンジニア</option><option value="サーバーエンジニア">サーバーエンジニア</option><option value="データベースエンジニア">データベースエンジニア</option><option value="IoTエンジニア">IoTエンジニア</option><option value="制御・組み込みエンジニア">制御・組み込みエンジニア</option><option value="テストエンジニア">テストエンジニア</option><option value="その他">その他</option></select>');    
//     $(".form .edit_occupation option[value='" + user_occupation + "']").prop('selected', true);
//     $('.form .address').replaceWith('<select name="address" class="form-control edit_address" value="' + user_address + '"><option value="">--選択してください--</option><option value="北海道">北海道</option><option value="青森県">青森県</option><option value="岩手県">岩手県</option><option value="宮城県">宮城県</option><option value="秋田県">秋田県</option><option value="山形県">山形県</option><option value="福島県">福島県</option><option value="茨城県">茨城県</option><option value="栃木県">栃木県</option><option value="群馬県">群馬県</option><option value="埼玉県">埼玉県</option><option value="千葉県">千葉県</option><option value="東京都">東京都</option><option value="神奈川県">神奈川県</option><option value="新潟県">新潟県</option><option value="富山県">富山県</option><option value="石川県">石川県</option><option value="福井県">福井県</option><option value="山梨県">山梨県</option><option value="長野県">長野県</option><option value="岐阜県">岐阜県</option><option value="静岡県">静岡県</option><option value="愛知県">愛知県</option><option value="三重県">三重県</option><option value="滋賀県">滋賀県</option><option value="京都府">京都府</option><option value="大阪府">大阪府</option><option value="兵庫県">兵庫県</option><option value="奈良県">奈良県</option><option value="和歌山県">和歌山県</option><option value="鳥取県">鳥取県</option><option value="島根県">島根県</option><option value="岡山県">岡山県</option><option value="広島県">広島県</option><option value="山口県">山口県</option><option value="徳島県">徳島県</option><option value="香川県">香川県</option><option value="愛媛県">愛媛県</option><option value="高知県">高知県</option><option value="福岡県">福岡県</option><option value="佐賀県">佐賀県</option><option value="長崎県">長崎県</option><option value="熊本県">熊本県</option><option value="大分県">大分県</option><option value="宮崎県">宮崎県</option><option value="鹿児島県">鹿児島県</option><option value="沖縄県">沖縄県</option></select>');
//     $('.form .address_narrow').replaceWith('<select name="address_narrow" class="form-control edit_address" value="' + user_address_narrow + '"><option value="">--選択してください--</option><option value="北海道">北海道</option><option value="青森県">青森県</option><option value="岩手県">岩手県</option><option value="宮城県">宮城県</option><option value="秋田県">秋田県</option><option value="山形県">山形県</option><option value="福島県">福島県</option><option value="茨城県">茨城県</option><option value="栃木県">栃木県</option><option value="群馬県">群馬県</option><option value="埼玉県">埼玉県</option><option value="千葉県">千葉県</option><option value="東京都">東京都</option><option value="神奈川県">神奈川県</option><option value="新潟県">新潟県</option><option value="富山県">富山県</option><option value="石川県">石川県</option><option value="福井県">福井県</option><option value="山梨県">山梨県</option><option value="長野県">長野県</option><option value="岐阜県">岐阜県</option><option value="静岡県">静岡県</option><option value="愛知県">愛知県</option><option value="三重県">三重県</option><option value="滋賀県">滋賀県</option><option value="京都府">京都府</option><option value="大阪府">大阪府</option><option value="兵庫県">兵庫県</option><option value="奈良県">奈良県</option><option value="和歌山県">和歌山県</option><option value="鳥取県">鳥取県</option><option value="島根県">島根県</option><option value="岡山県">岡山県</option><option value="広島県">広島県</option><option value="山口県">山口県</option><option value="徳島県">徳島県</option><option value="香川県">香川県</option><option value="愛媛県">愛媛県</option><option value="高知県">高知県</option><option value="福岡県">福岡県</option><option value="佐賀県">佐賀県</option><option value="長崎県">長崎県</option><option value="熊本県">熊本県</option><option value="大分県">大分県</option><option value="宮崎県">宮崎県</option><option value="鹿児島県">鹿児島県</option><option value="沖縄県">沖縄県</option></select>');
//     $(".form .edit_address option[value='" + user_address + "']").prop('selected', true);
//     //$('.form .skill_select').replaceWith('<select name="skills" class="form-control edit_skill_select" style="width: 93%;" value="' + user_occupation + '"><option value="">--選択してください--</option><option value="AWS">AWS</option><option value="Bootstrap">Bootstrap</option><option value="C">C</option><option value="CakePHP">CakePHP</option><option value="C#">C#</option><option value="C++">C++</option><option value="COBOL">COBOL</option><option value="CSS">CSS</option><option value="Docker">Docker</option><option value="Go">Go</option><option value="Git">Git</option><option value="HTTP">HTTP</option><option value="HTML">HTML</option><option value="iOS">iOS</option><option value="Java">Java</option><option value="JavaScript">JavaScript</option><option value="JIRA">JIRA</option><option value="Kotlin">Kotlin</option><option value="Laravel">Laravel</option><option value="MATLAB">MATLAB</option><option value="MySQL">MySQL</option><option value="Oracle Database">Oracle Database</option><option value="Perl">Perl</option><option value="PHP">PHP</option><option value="PostgreSQL">PostgreSQL</option><option value="Python">Python</option><option value="R">R</option><option value="React">React</option><option value="Ruby">Ruby</option><option value="Ruby on Rails">Ruby on Rails</option><option value="Rust">Rust</option><option value="SVN">SVN</option><option value="SSL">SSL</option><option value="SQLite">SQLite</option><option value="TypeScript">TypeScript</option><option value="Vue.js">Vue.js</option></select>');
//     $('.form .skill_select').replaceWith('<input type="text" class="skill_select" name="skills" value="'+user_skill+'" placeholder="PHP JavaScript">');
//     $('.form .licence_select').replaceWith('<input type="text" class="licence_select" name="licences" value="'+user_licence+'" placeholder="ITパスポート 基本情報技術者試験">');
//     $('.workhistory').replaceWith('<textarea class="edit_workhistory form-control" type="text" style="width: 60%;height: auto;" name="user_workhistory" value="' + user_workhistory + '">' + user_workhistory);
//     $('.workhistory_narrow').replaceWith('<textarea class="edit_workhistory form-control" type="text" name="user_workhistory_narrow" value="' + user_workhistory_narrow + '">' + user_workhistory_narrow);
//     $('.workhistory_narrower').replaceWith('<textarea class="edit_workhistory form-control" type="text" name="user_workhistory_narrower" >' + user_workhistory_narrower);
//     $('.edit_profile').replaceWith('<textarea class="edit_profile form-control" type="text" style="width: 60%;height: auto;" name="user_profile" value="' + user_profile + '">' + user_profile);
//     $('.mypage').css('display', 'none');
//     $('.edit_profile_img').css('display', 'inline-block');
//     $('.btn_flex').css('display', 'flex');
//     $('.profile').addClass('editing');
//     $('.form').css('display', 'inline-block');
//     // $('.tag').fadeOut();
//     $('.tag').hide();
//     $('.col-3').css('margin-top', '-2rem');
//     // $('.edit_btns').fadeIn();
//     $('.edit_btns').show();
//     // $('.profile_count').fadeOut();
//     $('.profile_count').hide();
//     $('.edit_workhistory').change(function() {
//         var str = $('.edit_workhistory')[0].value.length;
//         if (str < 100) {
//             $('.edit_workhistory')[0].setAttribute("style", "border-color: #ced4da;");
//             $('.error_workhistory').fadeOut();
//         }
//     });
// });

// // プロフィール編集のキャンセルボタン押下時
// $(document).on('click', ".profile_close", function() {
//     $('.edit_name').replaceWith('<h2 class="profile_name">' + user_name + '</h2>');
//     $('.edit_workhistory').replaceWith('<p class="workhistory">' + user_workhistory + '</p>');
//     $('.tag .edit_age').replaceWith('<p class="user_age" style="inline-block">' + user_age + '</p>');
//     $('.tag .edit_occupation').replaceWith('<p class="user_occupation">' + user_occupation + '</p>')
//     $('.mypage').css('display', 'inline');
//     $('.edit_profile_img').css('display', 'none');
//     $('.btn_flex').css('display', 'none');
//     $('.profile').removeClass('editing');
//     $('.profile_edit_btn').show();
//     $('.follow_user').show();
//     $('.edit_btns').fadeOut();
//     $('.col-3').css('margin-top', '0rem');
//     // $('.myprofile_btn').fadeIn();
//     $('.myprofile_btn').show();
//     // $('.form').fadeOut();
//     $('.form').hide();
//     // $('.tag').fadeIn();
//     $('.tag').show();
//     // $('.profile_count').fadeIn();
//     $('.profile_count').show();
//     $('.content').css('position','unset');
//     $('#match_btn').prop("disabled", false);
//     $('#unmatch_btn').prop("disabled", false);
//     $('.match_top').css('position', '');
// });

// $(document).on('click', ".profile_narrow_close", function() {
//     $('.edit_name').replaceWith('<h2 class="profile_name">' + user_name + '</h2>');
//     $('.edit_workhistory').replaceWith('<p class="workhistory">' + user_workhistory + '</p>');
//     $('.mypage').css('display', 'inline');
//     $('.edit_profile_img').css('display', 'none');
//     $('.btn_flex').css('display', 'none');
//     $('.profile').removeClass('editing');
//     $('.profile_edit_btn').fadeIn();
//     $('.edit_btns').fadeOut();
//     $('.col-3').css('margin-top', '0rem');
//     $('.myprofile_btn').fadeIn();
//     $('.form').fadeOut();
//     $('.tag').fadeIn();
//     $('.profile_count').fadeIn();
//     $('.myprofile_count').fadeIn();
// });

// // ユーザー詳細画面
// $(document).on('click', ".match_user", function() {
//     var $target_modal = $(this).data("target");
//     $height = $(window).scrollTop();
//     $('.footer').hide();
//     $('#match_btn').prop("disabled", true);
//     $('#unmatch_btn').prop("disabled", true);
//     $('.match_top.sarch_top').css('position', 'fixed');
//     $('.modal_match').fadeIn();
//     $('.profile_close').fadeIn();
//     $('.matchuser_detaile').fadeIn();
//     $('.matchuser_detaile_prof').fadeIn();
//     $('.matchuser_detaile .matchuser_img').attr('src', $($target_modal + ' > .match_user_img')[0].getAttribute('src'));
//     $('.matchuser_detaile .matchuser_name').replaceWith('<div class="matchuser_name">' + $($target_modal + ' > .match_user_name')[0].value + '</div>');
//     $('.matchuser_detaile .matchuser_age').replaceWith('<span class="matchuser_age">' + $($target_modal + ' > .match_user_profile > div > .match_user_age').text() + '</span>');
//     $('.matchuser_detaile .matchuser_address').replaceWith('<span class="matchuser_address">' + $($target_modal + ' > .match_user_address')[0].value + '</span>');
//     $('.matchuser_detaile .matchuser_profile').replaceWith('<div class="matchuser_profile">' + $($target_modal + ' > .match_user_profile > .match_user_prof').val() + '</div>');
//     $('.matchuser_detaile .matchuser_occupation').replaceWith('<span class="matchuser_occupation">' + $($target_modal + ' > .match_user_occupation')[0].value + '</span>');
//     $('.matchuser_detaile_prof .matchuser_skill').replaceWith('<span id="child-span_myprofile" class="matchuser_skill" style="font-size: 1rem;">' + $($target_modal + ' > .match_user_skill')[0].value + '</span>');
//     $('.matchuser_detaile_prof .matchuser_licence').replaceWith('<span id="child-span_myprofile" class="matchuser_licence" style="font-size: 1rem;">' + $($target_modal + '  > .match_user_licence')[0].value + '</span>');
//     $('.matchuser_detaile_prof .matchuser_workhistory').replaceWith('<span class="matchuser_workhistory" style="font-size: 1rem;">' + $($target_modal + ' > .match_user_workhistory')[0].value + '</span>');
//     $('.matchuser_detaile .user_id').val($($target_modal + ' > .match_user_id')[0].value);
//     $('.matchuser_detaile .matchs_flg').val($($target_modal + ' > .matchs_flg')[0].value);
//     $('.matchuser_detaile_prof').fadeIn();
//     $(window).scrollTop(0);
//     console.log($($target_modal + ' > .click_flg')[0].value);
//     if ($($target_modal + ' > .click_flg')[0].value != 0) {
//         $('.match_good_btn').hide();
//     } else {
//         $('.match_good_btn').show();
//     }
//     $(document).on('click', ".profile_close", function() {
//         $('body').scrollTop($height);
//         $('.footer').show();
//     });
//     $(document).on('click', ".modal_match", function() {
//         $('body').scrollTop($height);
//         $('.footer').show();
//     });
// });

// // モーダル画面の灰色の背景をクリックしたら戻るように
// $(document).on('click', ".modal_match", function() {
//     $('.modal_match').fadeOut();
//     $('.matchuser_detaile').fadeOut();
//     $('.matchuser_detaile_prof').fadeOut();
//     $('.match_top').css('position', '');
//     $('#match_btn').prop("disabled", false);
//     $('#unmatch_btn').prop("disabled", false);
// });

// // モーダル画面の×印をクリック
// $(document).on('click', ".far.fa-times-circle", function() {
//     $('.modal_match').fadeOut();
//     $('.matchuser_detaile').fadeOut();
//     $('.matchuser_detaile_prof').fadeOut();
// });

// // いいねをクリックしたとき
// $(document).one('click', ".match_good_btn", function() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });

//     var user_id = $(this).next().next().val(),
//         user_name = $(this).parent().prev().prev().prev().prev().prev().text(),
//         matchs_flg = $(this).next().next().next()[0].value,
//         match_good_btn = $(this);
//     $.ajax({
//         type: 'POST',
//         url: '/ajax_match_process',
//         dataType: 'text',
//         data: {
//             user_id: user_id
//         }
//     }).done(function() {
//         if (matchs_flg == 0) {
//             $('.match_message').fadeIn();
//             $('.match_message').text(user_name + 'さんにいいねを送りました');
//             $('.match_message').fadeOut(5000);
//         } else {
//             $('.match_message').fadeIn();
//             $('.match_message').text(user_name + 'さんとマッチしました！');
//             $('.match_message').fadeOut(5000);
//             $('.fas.fa-comment').css('margin-right', '');
//             if (!$('.new_mark').length) {
//                 $('.fas.fa-comment').after('<span class="new_mark"></span>');
//                 $('.new_mark').after('<span style="margin-left: 2rem;"></span>');
//             }
//         }
//         match_good_btn.fadeOut();
//         $('#matchuser_' + user_id + ' > .click_flg').val(1);
//     }).fail(function() {});
// });

// $('#my_image').on('change', function(e) {
//     $('.message_submit').attr('class','btn btn-outline-primary message_img_submit');
// });

// $(document).on('click', ".message_img_submit", function() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//         // アップロードするファイルのデータ取得
//         var fileData = document.getElementById("my_image").files[0];
//         // フォームデータを作成する
//         var form = new FormData();

//         form.append("file", fileData);
//         $.ajax({
//         type: 'POST',
//         url: '/ajax_message_process',
//         dataType: 'text',
//         processData: false,
//         contentType: false,
//         data: form
//     }).done(function() {
//     }).fail(function() {});
// });

// // メッセージを送信したとき
// $(document).on('click', ".message_submit", function() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     var current_user_id= $('.current_user_id').val(),
//         user_id = $('.destination_user_id').val(),
//         text = $('#message_counter').val(),
//         current_user_img = $('.image')[0].value,
//         date=new Date(),
//         h = date.getHours(),
//         mi = date.getMinutes(),
//         hh = ('0' + h).slice(-2),
//         mmi = ('0' + mi).slice(-2),
//         day = hh + ':' + mmi;
//         // //アップロードするファイルのデータ取得
//         //var fileData = document.getElementById("my_image").files[0];
//         // //フォームデータを作成する
//         // var form = new FormData();

//         // form.append("file", fileData);
//         let input = document.getElementById('my_image');
//         $.ajax({
//         type: 'POST',
//         url: '/ajax_message_process',
//         dataType: 'text',
//         data: {
//             text: text,
//             user_id: user_id
//         }
//     }).done(function() {
//         $('.message_add').replaceWith('<div class="my_message"><div class="mycomment right"><span class="message_created_at"> '+ day +' </span><p>'+text+'</p><img class="message_user_img" src="'+current_user_img+'"></div></div><input type="hidden" class="message_add">');
//         $('#message_counter').val('');
//         $('html, body').scrollTop($(document).height());
//     }).fail(function() {});
// });


// // マッチ機能処理
// $(document).on('click', '#match_btn', function() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     var current_user_id = $('.match_user_id').val(),
//         target_modal = $(this).data("target"),
//         match_modal = $(this).data("match"),
//         card = $('.match_card:last')[0],
//         user_id = card.id.substr(5),
//         user_name = $('#' + card.id + ' > #matchuser_'+ user_id +' > .profile_name').text();
//     $('#' + card.id + ' > .match_card_color').fadeIn();
//     $('#' + card.id + ' > #matchuser_'+ user_id +' > .profile_name').css({'z-index': '15'});
//     $(function() {
//         setInterval(function() {
//             $(card)[0].animate({
//                 "marginLeft": "50px",
//                 transform: 'rotate(100deg)'
//             }, 1000);
//             $(card).fadeOut().removeClass('match_card');
//         }, 1000);
//     });
//     $.ajax({
//         type: 'POST',
//         url: '/ajax_match_process',
//         dataType: 'text',
//         data: {
//             current_user_id: current_user_id,
//             user_id: user_id
//         }
//     }).done(function() {
//         $('.match_message').fadeIn();
//         $('.match_message').text(user_name + 'さんとマッチしました！');
//         $('.match_message').fadeOut(5000);
//         $('.fas.fa-comment').css('margin-right', '');
//         if ($('.new_mark').css('display') == 'none') {
//             $('.new_mark').fadeIn();
//             $('.new_mark').next('span').css('margin-left', '2rem');
//         }
//     }).fail(function() {});
// });

// $(document).on('click', '#unmatch_btn', function() {
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     var current_user_id = $('.unmatch_user_id').val(),
//         target_modal = $(this).data("target"),
//         card = $('.match_card:last')[0],
//         user_id = card.id.substr(5, 2);
//     $('#' + card.id + ' > .unmatch_card_color').fadeIn();
//     $('#' + card.id + ' > #matchuser_'+ user_id +' > .profile_name').css({'z-index': '15'});
//     $(function() {
//         setInterval(function() {
//             $(card)[0].animate({
//                 "marginLeft": "-50px",
//                 transform: 'rotate(-100deg)'
//             }, 1000);
//             $(card).fadeOut().removeClass('match_card');
//         }, 1000);
//     });
//     $.ajax({
//         type: 'POST',
//         url: '/ajax_unmatch_process',
//         dataType: 'text',
//         data: {
//             current_user_id: current_user_id,
//             user_id: user_id
//         }
//     }).done(function() {}).fail(function() {});
// });


// // 必須チェック解除
// $(document).ready(function() {
//     $('.user_name_input').change(function() {
//         var str = $(this).value;
//         if (str != '') {
//             $('.user_name_input')[0].setAttribute("style", "border-color: #ced4da;");
//             $('.user_name_error').fadeOut();
//         }
//     });
//     $('.user_pass_input').change(function() {
//         var str = $(this).value;
//         if (str != '') {
//             $('.user_pass_input')[0].setAttribute("style", "border-color: #ced4da;");
//             $('.user_pass_error').fadeOut();
//         }
//     });
//     $('.user_mail_input').change(function() {
//         var str = $(this).value;
//         if (str != '') {
//             $('.user_mail_input')[0].setAttribute("style", "border-color: #ced4da;");
//             $('.user_mail_error').fadeOut();
//         }
//     });
// });

// $(document).on('click', '.submit_btn', function() {
//     var error=0;
//     if ($('.user_name_input')[0].value == '' && $('.user_pass_input')[0].value == '') {
//         $('.user_name_input')[0].setAttribute("style", "border-color: #dc3545;");
//         $('.user_pass_input')[0].setAttribute("style", "border-color: #dc3545;");
//         $('.user_name_error').fadeIn();
//         $('.user_pass_error').fadeIn();
//     }
//     if ($('.user_name_input')[0].value == '') {
//         $('.user_name_input')[0].setAttribute("style", "border-color: #dc3545;");
//         $('.user_name_error').fadeIn();
//         error++;
//     }
//     if ($('.user_pass_input')[0].value == '') {
//         $('.user_pass_input')[0].setAttribute("style", "border-color: #dc3545;");
//         $('.user_pass_error').fadeIn();
//         error++;
//     }
//     if ($('.user_mail_input')[0].value == '') {
//         $('.user_mail_input')[0].setAttribute("style", "border-color: #dc3545;");
//         $('.user_mail_error').fadeIn();
//         error++;
//     }
//     if(0 < error){
//         return false;
//     }
// });

// $(document).on('click', '.edit_done', function() {
//     console.log("teste");
//     //console.log($('.edit_age')[0].value);
//     // if ($('.edit_age')[0].value == '' && $('.edit_profile')[0].value == '') {
//     //     $('.user_name_input')[0].setAttribute("style", "border-color: #dc3545;");
//     //     $('.user_pass_input')[0].setAttribute("style", "border-color: #dc3545;");
//     //     $('.user_name_error').fadeIn();
//     //     $('.user_pass_error').fadeIn();
//     // }
//     // if ($('.user_name_input')[0].value == '') {
//     //     $('.user_name_input')[0].setAttribute("style", "border-color: #dc3545;");
//     //     $('.user_name_error').fadeIn();
//     //     return false;
//     // }
//     // if ($('.user_pass_input')[0].value == '') {
//     //     $('.user_pass_input')[0].setAttribute("style", "border-color: #dc3545;");
//     //     $('.user_pass_error').fadeIn();
//     //     return false;
//     // }
// });