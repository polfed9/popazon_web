$(document).ready(function () {
    
    var $sliderCurrentValue = 50;
    $("#ex6").slider();
    $("#ex6").on("slide", function (slideEvt) {
        $sliderCurrentValue = slideEvt.value;
        $("#price-slider").text($sliderCurrentValue);
    });
    
    // array con tutti i prodotti esclusivi
    var exclusiveProductArray = JSON.parse($('.exclusive').text());

    // mappa con k=catP e v=Array(catS)
    var exclusiveCategoriesMap = new Map(); 

    $.each(exclusiveProductArray, function(index, value){
        if(exclusiveCategoriesMap.has(value.catP)) {
            exclusiveCategoriesMap.set(value.catP, new Array());
        }
    });

    $.each(exclusiveProductArray, function(index, value){
        if (!exclusiveCategoriesMap.has(value.catP)) {
            var catsarray = new Array(value.catS);
            exclusiveCategoriesMap.set(value.catP, catsarray);
        } else {
            if(exclusiveCategoriesMap.get(value.catP).indexOf(value.catS) === -1) {
                exclusiveCategoriesMap.get(value.catP).push(value.catS);
            }
        }
    });

    $('.form-check-category').click(function() {
        if($(this).is(":checked")){
            $(this).attr("checked", false);
        } else {
            $(this).attr("checked", true);
        }
    });

    $('.form-check-franchise').click(function() {
        if($(this).is(":checked")){
            $(this).attr("checked", false);
        } else {
            $(this).attr("checked", true);
        }
    });

    function getKeyByVal(map, searchKey) {
        for (let [key, value] of map.entries()) {
          if (key === searchKey)
            return key;
        }
    }

    function categoriesCount(){
        var counter = 0;
        for (const li of document.querySelectorAll("#category-list > li > div > div > input")) {
            if($(li).is(':checked')){
                counter++;
            }
        };
        return counter;
    }

    function productLoop(){
        var arrayWithFilteredProduct = [];
        var selectedFranchises = [];
        
        $('.form-check-franchise').each(function() {
            if($(this).is(":checked")){
                selectedFranchises.push($(this).val());
            } 
        });

        $('.product').each(function() {
            let currentCatP = getKeyByVal(exclusiveCategoriesMap, $(this).attr("data-categoryP"));
            if(document.getElementById(currentCatP).checked == true && parseFloat($(this).attr("data-price")) <= $sliderCurrentValue){
                arrayWithFilteredProduct.push($(this));
            }
        });

        var arrayWithFilteredProductFranchise = [];
       
        arrayWithFilteredProduct.forEach(function (item, index) {
            if(selectedFranchises.indexOf(item.attr("data-franchise")) >=0){
                arrayWithFilteredProductFranchise.push(item.attr("data-id"));
            } 
        });
       
        $('.product').each(function() {
            let currentCatP = getKeyByVal(exclusiveCategoriesMap, $(this).attr("data-categoryP"));
            let currentValues = exclusiveCategoriesMap.get(currentCatP);

            var counter = categoriesCount();

            if (counter == exclusiveCategoriesMap.size && arrayWithFilteredProductFranchise.includes($(this).attr("data-id"))) {
                $(this).parent().attr('style', 'display: flex !important');  
                document.getElementById('franchise-'.concat($(this).attr("data-franchise"))).disabled = false;
            } else if(counter == exclusiveCategoriesMap.size && !arrayWithFilteredProductFranchise.includes($(this).attr("data-id"))) {
                $(this).parent().attr('style', 'display: none !important');  
                document.getElementById('franchise-'.concat($(this).attr("data-franchise"))).disabled = true;
            } 

            else if (arrayWithFilteredProductFranchise.includes($(this).attr("data-id"))) {
                $(this).parent().attr('style', 'display: flex !important');    
                $.each(currentValues, function(index, value){
                    document.getElementById('franchise-'.concat(value)).disabled = false;
                })
            } else if (!arrayWithFilteredProductFranchise.includes($(this).attr("data-id"))) {
                $(this).parent().attr('style', 'display: none !important');
                $.each(currentValues, function(index, value){
                    document.getElementById('franchise-'.concat(value)).disabled = true;
                })
            }      
        });
    }

    $('.show-result').click(function(){
        productLoop($(this));
    });

    $('.clear-filter').click(function(){   
        for (const li of document.querySelectorAll("#franchise-list > li")) {
            li.hidden = false;
            $(li).find('input').prop("checked", true);
            $(li).find('input').prop("disabled", false);
        };

        for (const li of document.querySelectorAll("#category-list > li")) {
            li.hidden = false;
            $(li).find('input').prop("checked", true);
            $(li).find('input').prop("disabled", false);
        };

        for (const prod of document.querySelectorAll("#result > div")) {
            $(prod).attr('style', 'display: flex !important');
        };
    });
});