function updateRow(msg, statoAttuale, row){
    
    //aggiorno la dropdown selezionata
    row.children("input:disabled").val(statoAttuale);
    let typeMessage = msg.includes("Errore") ? "danger" :  msg.includes("correttamente") ? "success" : "warning";
    row.append(`<p class="alert-${typeMessage}">${msg}</p>`);

}

$(document).ready(function(){
   $(":button").click(function() {
        $("p").remove();
        let rowStatoAttuale = $(this).closest("tr").find('td:eq(0)');
        let ordine = $(this).closest("tr").find('th:eq(0)').text().replace("#","");
        let oldStato = $(this).closest("tr").find('td:eq(0)').children("input:disabled").val();
        //$(this).closest("tr").find('td:eq(0)').children("select").children("option:selected").val();
        if($(this).attr("value") == "Avanza"){
            //bt Avanza
            $.ajax({
                url: 'api-stato.php', //This is the current doc
                type: "POST",
                data: {"bt":"avanza",
                        "ordine": ordine,
                        "oldStato" : oldStato},
                success: function(result){
                    if (result["msg"]!= 0){
                        updateRow(result["msg"],result["stato"],rowStatoAttuale);
                    } else {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    }
                } 
            });
       } else {
            //bt Annulla
            $.ajax({
                url: 'api-stato.php', //This is the current doc
                type: "POST",
                data: {"bt":"annulla",
                        "ordine": ordine},
                success: function(result){
                    if (result["msg"]!= 0){
                        updateRow(result["msg"],result["stato"],rowStatoAttuale);
                    } else {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    }
                }
            });
            
       }
   });
});