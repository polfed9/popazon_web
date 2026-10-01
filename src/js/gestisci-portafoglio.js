$(document).ready(function () {
    $("input[name='ricarica']").click(function () {
        $("div.pagamento").removeClass("d-none");
        $(this).attr('checked', 'checked');
        $("p.alert-danger").remove();
    });

    $(".card-footer>button").click(function () {
        let vuoto = false;

        $("input.campoPagamento").each(function() {
            console.log($(this).val());
            if($(this).val() == ''){
                vuoto = true;
            }
        });

        if (vuoto || $(".nCarta").val().length != 16 || $(".cvv").val().length != 3){
            $("p").append(`<p class='alert-danger'>Ricarica annullata, campi vuoti o errati</p>`);  
        } else {
            $.ajax({
                url: 'api-portafoglio.php', //This is the current doc
                type: "POST",
                data: {"importo": $("input[name='ricarica']:checked").val()},
                success: function (result) {
                    if (result["err"]== 2){
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        $(location).attr('href',"portafoglio.php");
                    }
                }
            });
            $("input[name='ricarica']").removeAttr('checked');
        }
        $("div.pagamento").addClass("d-none"); 
        
    });
});