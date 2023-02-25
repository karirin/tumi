$(document).on('click', '.tumi_submit', function() {
    console.log($('.tumi_tittle_add')[0].value);
    console.log($('.tumi_tittle_add')[0].value.length);
    var error=0;
    if ($('.tumi_tittle_add')[0].value == '' && $('.tumi_text_add')[0].value == '') {
        $('.tumi_tittle_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_text_add')[0].setAttribute("style", "border-color: #dc3545;height: 10rem;");
        $('.tumi_text_error').fadeIn();
        $('.tumi_tittle_error').fadeIn();
        error++;
    }
    if ($('.tumi_tittle_add')[0].value == '') {
        $('.tumi_tittle_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_tittle_error').fadeIn();
        error++;
    }
    if ($('.tumi_text_add')[0].value == '') {
        $('.tumi_text_add')[0].setAttribute("style", "border-color: #dc3545;height: 10rem;");
        $('.tumi_text_error').fadeIn();
        error++;
    }
    if (21 <= $('.tumi_tittle_add')[0].value.length) {
        $('.tumi_tittle_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_tittle_moji_error').fadeIn();
        error++;
    }
        if(0 < error){
        return false;
    }
});

$(document).on('click', '.edit_tumi_done', function() {
    if ($('.edit_tumi_tittle')[0].value == '' && $('.edit_tumi_text')[0].value == '') {
        $('.edit_tumi_tittle')[0].setAttribute("style", "border-color: #dc3545;");
        $('.edit_tumi_text')[0].setAttribute("style", "border-color: #dc3545;height: 19.2rem;");
        $('.tumi_edittext_error').fadeIn();
        $('.tumi_edittittle_error').fadeIn();
        return false;
    }
    if ($('.edit_tumi_tittle')[0].value == '') {
        $('.edit_tumi_tittle')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_edittittle_error').fadeIn();
        return false;
    }
    if ($('.edit_tumi_text')[0].value == '') {
        $('.edit_tumi_text')[0].setAttribute("style", "border-color: #dc3545;height: 19.2rem;");
        $('.tumi_edittext_error').fadeIn();
        return false;
    }
});

    // 必須チェック解除
    $(document).ready(function() {
        $('.edit_tumi_tittle').change(function() {
            var str = $(this).value;
            if (str != '') {
                $('.edit_tumi_tittle')[0].setAttribute("style", "border-color: #ced4da;");
                $('.tumi_edittittle_error').fadeOut();
            }
        });
        $('.edit_tumi_text').change(function() {
            var str = $(this).value;
            if (str != '') {
                $('.edit_tumi_text')[0].setAttribute("style", "border-color: #ced4da;height: 19.2rem;");
                $('.tumi_edittext_error').fadeOut();
            }
        });
    });

    $(document).on('click', '.edit_tumi_btn', function() {
        $('.edit_tumi_tittle')[0].setAttribute("style", "border-color: #ced4da;");
        $('.tumi_edittittle_error').fadeOut();
        $('.edit_tumi_text')[0].setAttribute("style", "border-color: #ced4da;height: 19.2rem;");
        $('.tumi_edittext_error').fadeOut();
    });

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

