
$(document).on('click', '.tumi_submit', function() {
    if ($('.tumi_tittle_add')[0].value == '' && $('.tumi_text_add')[0].value == '') {
        $('.tumi_tittle_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_text_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_text_error').fadeIn();
        $('.tumi_tittle_error').fadeIn();
        return false;
    }
    if ($('.tumi_tittle_add')[0].value == '') {
        $('.tumi_tittle_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_tittle_error').fadeIn();
        return false;
    }
    if ($('.tumi_text_add')[0].value == '') {
        $('.tumi_text_add')[0].setAttribute("style", "border-color: #dc3545;");
        $('.tumi_text_error').fadeIn();
        return false;
    }
});