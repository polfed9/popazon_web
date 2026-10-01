function showNotifica(notifica){
    //aggiungere lo switch di pg se sono in modalità mobile e un bottone per tornare indietro alla lista delle notifiche
    const panel = $('.panel-body[data-type="nSpecifica"]');
    panel.empty();
    panel.removeClass("text-center");
    panel.removeClass("text-muted");
    panel.addClass("bg-white");
    let result = `
    <h5 class="border-bottom m-4">Mittente: ${notifica["mittente"]}</h5>
    <h5 class="border-bottom m-4">Destinatario: ${notifica["destinatario"]}</h5>
    <h6 class="border-bottom m-4">Oggetto: ${notifica["oggetto"]}</h6>
    <h6 class="text-right m-4">${notifica["data"]}</h6>
    <p class="m-4">${notifica["testo"]}</p>
    `;
    panel.append(result);
}

function updateListNotification(notifiche){
    const panel = $('.panel-body[data-type="nGenerale"]>div.list-group');

        notifiche.forEach(n=> {
            if (document.querySelectorAll('.list-group>button[data-id="'+n["id"]+'"]').length == 0){
                let result = `
                <button type="button" class="list-group-item text-left ${n["stato"]==1 ? 'text-secondary' : ""}" data-id="${n["id"]}" aria-label="notifica">
                <h6>Mittente: ${n["mittente"]}</h6>
                Oggetto: ${n["oggetto"]}</br>
                ${n["preview"]}
                `;
                panel.prepend(result);
                $('.list-group>button[data-id="'+n["id"]+'"]').click(function(){
                    onClickNotification($(this));
                });
            }
    });
    
    
}

function onClickNotification(el){
    
    $("div.row>div:first-child()").addClass("d-none d-md-block");
    $("div.row>div:nth-child(2)").removeClass("d-none d-md-block");
    
    el.addClass("text-secondary");
        $.ajax({
            url: 'api-notifica.php',
            type: "POST",
            data: {"action" : "open",
                "id":el.attr("data-id")},
            success: function(result){
                if (result["err"]== 1){
                    $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                } else {
                    showNotifica(result["notifica"]);
                }
            }
        });
}

$(document).ready(function(){

    $("button.list-group-item").click(function(){
        onClickNotification($(this));
    });

    $('.badge').on('DOMSubtreeModified',function(){
        let countButton = document.querySelectorAll(".list-group>button").length -  document.querySelectorAll(".list-group>button.text-secondary").length ;
        if (countButton < $(this).text()){
            //console.log("aggiorna lista notifiche");
            //aggiungo i nuovi elementi in alto nella lista 
            //prendo tutte le notifiche - gli id di quelle presenti
            $.ajax({
                url: 'api-notifica.php',
                type: "POST",
                data: {"action" : "aggiorna"},
                success: function(result){
                    if (result["err"]== 1){
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        updateListNotification(result["notifiche"]);
                    }
                }
            });
        }
      });

    $("div>span").click(function() {
        $("div.row>div:first-child()").removeClass("d-none d-md-block");
        $("div.row>div:nth-child(2)").addClass("d-none d-md-block");
    })
 });