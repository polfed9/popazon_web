$(document).ready(function () {
    $("button[name='add_to_cart']").click(function () {

        $.ajax({
            url: 'aggiungiAlCarrello.php',
            type: "POST",
            data: {
                "add_to_cart": "add_to_cart",
                "numero": $("input[name='numero']").val(),
                "nome": $("input[name='nome']").val(),
                "catP": $("input[name='catP']").val(),
                "prezzo": $("input[name='prezzo']").val(),
                "img": $("input[name='img']").val()
            },
            success: function (result) {
                $("div.msg>p").remove();
                $("div.msg").html(`<p class="alert-success m-0 text-center">Prodotto aggiunto al carrello</p>`);
            }
        });
    });

});