$(document).ready(function () {
    var $sliderCurrentValue = 50;
    $("#ex6").slider();
    $("#ex6").on("slide", function (slideEvt) {
        $sliderCurrentValue = slideEvt.value;
        $("#price-slider").text($sliderCurrentValue);
    });

    function productLoop($checkElem){
        $('.product').each(function() {
            if($checkElem.is(":checked") && $checkElem.val() == $(this).attr("data-franchise") && parseFloat($(this).attr("data-price")) <= $sliderCurrentValue){
                $(this).parent().attr('style', 'display: flex !important');
            } else if(!$checkElem.is(":checked") && $checkElem.val() == $(this).attr("data-franchise") || parseFloat($(this).attr("data-price")) > $sliderCurrentValue){
                $(this).parent().attr('style', 'display: none !important');
            }
        });
    }

    $('.form-check-franchise').change(function() {
        $('.form-check-franchise-container').children('div').children('input').each(function () {
            if($(this).is(":checked") && $(this).val() == $(this).attr("data-franchise")){
                $(this).attr('checked', false);
            } else if(!$(this).is(":checked") && $(this).val() == $(this).attr("data-franchise")){
                $(this).attr('checked', true);
            }
        });
    });

    $('.show-result').click(function(){
        $('.form-check-franchise-container').children('div').children('input').each(function () {
            productLoop($(this));
        });
    });
    
});