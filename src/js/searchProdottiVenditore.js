// quando premo invio faccio la ricerca del contenuto presente nella search tra i nomi/numeri presenti, se lo contengono li lascio visibili, altrimenti nascondo la riga della colonna. se il contenuto della search è vuoto allora li rimostri tutti
$(document).ready(function () {
    $("#searchAdmin").keyup(function (e) {
        if (e.keyCode == 13) {
            const val = $(this).val().toLowerCase();
            if (!val){
                $("tr").show();
            }
            else{
                $("tbody>tr").hide();
                $("tr[data-searchVenditore*='"+val+"']").show();
            }
        }
    });
});