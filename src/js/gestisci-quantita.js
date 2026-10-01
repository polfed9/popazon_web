function updateDBorSession(id, qt, type) {
    $.ajax({
        url: 'api-carrello.php', //This is the current doc
        type: "POST",
        data: {
            "id": id,
            "qt": qt
        },
        success: function (result) {
            //aggiorno il totale
            const oldTot = $("span.totale").text();
            let newTot = 0;
            if (type == "trash") {
                newTot = oldTot - (parseFloat($("p[data-id='" + id + "']").attr("data-prezzo"))*$("input[name='" + id + "']").val());
                const nArt = $("span.articoli").text()-$("input[name='" + id + "']").val();
                $("span.articoli").text(nArt);
                $("input.nArt").val(nArt);
                if(nArt==0){
                    $(location).attr('href',"carrello.php");
                }
            }
            else {
                newTot = type == "minus" ? parseFloat(oldTot) - parseFloat($("p[data-id='" + id + "']").attr("data-prezzo")) : parseFloat(oldTot) + parseFloat($("p[data-id='" + id + "']").attr("data-prezzo"));               
            }
            if (qt == 0) {
                $("div[data-CardId='" + id + "']").remove();
            }
            $(".totale").text(newTot.toFixed(2));
            $("input.totale").val(newTot.toFixed(2));
        }
    });
}

$(document).ready(function () {
    $("button[data-type='minus']").click(function () {
        const id = $(this).attr("data-id");
        const value = $("input[name='" + id + "']").val() - 1;
        $("input[name='" + id + "']").val(value <= 0 ? 0 : value);
        const nArt = $("span.articoli").text()-1;
        $("span.articoli").text(nArt);
        $("input.nArt").val(nArt);
        updateDBorSession(id, value, "minus");
    });

    $("button[data-type='plus']").click(function () {
        const id = $(this).attr("data-id");
        const value = parseInt($("input[name='" + id + "']").val()) + 1;
        $("input[name='" + id + "']").val(value >= 1000 ? 1000 : value);
        const nArt = parseInt($("span.articoli").text())+1;
        $("span.articoli").text(nArt);
        $("input.nArt").val(nArt);
        updateDBorSession(id, value, "plus");
    });

    $("button[data-type='trash']").click(function () {
        const id = $(this).attr("data-id");
        const value = 0;
        updateDBorSession(id, value, "trash");
    });

});