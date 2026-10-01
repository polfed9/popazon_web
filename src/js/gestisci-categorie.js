function addCat(cat){
    $("div.list-group[data-cat-type='S']>button").remove();
    res = ``;
    cat.forEach(el => {
        res+= `<button type="button" class="list-group-item list-group-item-action" data-cat-type="S">${el["titolo"]}</button>`;
    });
    $("div.list-group[data-cat-type='S']").append(res);

    const catSselezionata = $("input#categoriaSselezionata");
    const modificaS = $("img[data-catS-type='modifica']");
    const salvaS =  $("img[data-catS-type='salva']");
    $("button[data-cat-type='S']").click(function(){
        btSEvent($(this),catSselezionata,modificaS,salvaS);
    });
}

function swichUpdateAndSave(catSelezionata,show,hide){
    show.show();
    hide.hide();
    catSelezionata.attr("disabled","disabled");
    
}

function btPEvent(el,catPselezionata,modificaP,salvaP){
    $("p").remove();
    let catP = el.text()
    catPselezionata.val(catP);
    swichUpdateAndSave(catPselezionata,modificaP,salvaP);
    //rimuovo le categorie mostrate precedentemente e mostro le categorie specifiche di quella catP
    $.ajax({
        url: 'api-catS.php', //This is the current doc
        type: "POST",
        data: {"catP":catP},
        success: function(result){
            addCat(result);
        }
    }); 
    $("input#nuovaCatS").removeAttr("disabled");
    return catP;
}

function btSEvent(el,catSselezionata,modificaS,salvaS){
    $("p").remove();
    let catS = el.text()
    catSselezionata.val(catS);
    swichUpdateAndSave(catSselezionata,modificaS,salvaS);
}

$(document).ready(function(){
    const catPselezionata = $("input#categoriaPselezionata");
    const modificaP = $("img[data-catP-type='modifica']");
    const salvaP =  $("img[data-catP-type='salva']");
    let catPoldText = "";

    const catSselezionata = $("input#categoriaSselezionata");
    const modificaS = $("img[data-catS-type='modifica']");
    const salvaS =  $("img[data-catS-type='salva']");
    let catSoldText = "";

    swichUpdateAndSave(catPselezionata,modificaP,salvaP,"P");
    $("img[data-catP-type='elimina']").toggle();
    $("input#categoriaSselezionata").attr("disabled","disabled");
    $("input#nuovaCatS").attr("disabled","disabled");
    
    $("img[data-catS-type='elimina']").toggle();
    $("img[data-catS-type='salva']").hide();

    $("img[data-catP-type='mostraS']").click(function(){
        $("div.row>div:first-child()").addClass("d-none d-md-block");
        $("div.row>div:nth-child(2)").removeClass("d-none d-md-block");
    })

    $("img[data-catP-type='mostraP']").click(function(){
        $("div.row>div:first-child()").removeClass("d-none d-md-block");
        $("div.row>div:nth-child(2)").addClass("d-none d-md-block");
    })

    $("button[data-cat-type='P']").click(function(){
        catPoldText = btPEvent($(this),catPselezionata,modificaP,salvaP);
    });


    $("img[data-catP-type='modifica']").click(function(){
        if (catPselezionata.attr("disabled")=="disabled" && catPselezionata.val()){
            $("p").remove();
            catPoldText = catPselezionata.val();
            //cambio l'immagine nel check per permettere il salvataggio
            swichUpdateAndSave(catPselezionata,salvaP,modificaP);
            $("img[data-catP-type='elimina']").toggle();
            //se è disabilitato e contiene una categoria allora lo abilito per consentire la modifica
            catPselezionata.removeAttr("disabled");
            //mostro il messaggio che le modifiche verranno apportate a tutti i prodotti che avevano quella categoria principale
            msg = "<p class='alert-warning'>Le modifiche si riperquoteranno sui prodotti aventi la categoria modificata o eliminata</p>";
            $("div.panel-body[data-cat-type='P']").prepend(msg);
        }
    });

    $("img[data-catS-type='modifica']").click(function(){
        if (catSselezionata.attr("disabled")=="disabled" && catSselezionata.val()){
            $("p").remove();

            catSoldText = catSselezionata.val();
            //cambio l'immagine nel check per permettere il salvataggio
            swichUpdateAndSave(catSselezionata,salvaS,modificaS);
            $("img[data-catS-type='elimina']").toggle();
            //se è disabilitato e contiene una categoria allora lo abilito per consentire la modifica
            catSselezionata.removeAttr("disabled");
            //mostro il messaggio che le modifiche verranno apportate a tutti i prodotti che avevano quella categoria principale
            msg = "<p class='alert-warning'>Le modifiche si riperquoteranno sui prodotti aventi la categoria modificata o eliminata</p>";
            $("div.panel-body[data-cat-type='S']").prepend(msg);
        }
    });

    $("img[data-catP-type='salva']").click(function(){
            //eseguo il salvataggio
            swichUpdateAndSave(catPselezionata,modificaP,salvaP);
            $("img[data-catP-type='elimina']").toggle();
            $.ajax({
                url: 'api-categorie.php', //This is the current doc
                type: "POST",
                data: {"catP":catPselezionata.val(),
                        "catPold" : catPoldText,
                        "action":"modifica"},
                success: function(result){
                    if (result["err"]=="0") {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        //ritorna stato: 1/0 in base a com'è andata la query, un meggaggio e la lista di categorie
                        if(result["cod"]){
                            //se è andato bene aggiorno la lista delle categorie cambiando il nome al bt che aveva text = oldVal
                            $("button:contains('"+catPoldText+"')").text(catPselezionata.val());
                        }
                        $("p").text(result["msg"]);
                        $("p").removeClass("alert-warning");
                        result["msg"].includes("ERRORE") || result["msg"].includes("ERRORE") ? $("p").addClass(" alert-danger") : $("p").addClass("  alert-success") ;
                    }
                }
                    
            }); 
    });

    $("img[data-catS-type='salva']").click(function(){
        //eseguo il salvataggio
        swichUpdateAndSave(catSselezionata,modificaS,salvaS);
        $("img[data-catS-type='elimina']").toggle();
        $.ajax({
            url: 'api-categorie.php', //This is the current doc
            type: "POST",
            data: {"catS":catSselezionata.val(),
                        "catSold" : catSoldText,
                        "action":"modifica"},
                success: function(result){
                    if (result["err"]=="0") {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        if(result["cod"]){
                            $("button:contains('"+catSoldText+"')").text(catSselezionata.val());
                        }
                        $("p").text(result["msg"]);
                        $("p").removeClass("alert-warning");
                        result["msg"].includes("ERRORE") || result["msg"].includes("ERRORE") ? $("p").addClass(" alert-danger") : $("p").addClass("  alert-success") ;
                    }
                }
            }); 
    });

    $("img[data-catP-type='elimina']").click(function(){
        if (catPselezionata.val()){
            $.ajax({
                url: 'api-categorie.php', //This is the current doc
                type: "POST",
                data: {"catP":catPoldText,
                        "action":"elimina"},
                success: function(result){
                    if (result["err"]=="0") {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        if(result["cod"]){
                            $("button:contains('"+catPoldText+"')").remove();
                            catPselezionata.val("");
                            addCat([]);
                            $("input#nuovaCatS").attr("disabled","disabled");
                        }
                        $("p").text(result["msg"]);
                        $("p").removeClass("alert-warning");
                        result["msg"].includes("ERRORE") || result["msg"].includes("ERRORE") ? $("p").addClass(" alert-danger") : $("p").addClass("  alert-success") ;
                    }
                }
            }); 
            swichUpdateAndSave(catPselezionata,modificaP,salvaP);
            $("img[data-catP-type='elimina']").toggle();
        }
    });

    $("img[data-catS-type='elimina']").click(function(){
        if (catPselezionata.val()){
            $.ajax({
                url: 'api-categorie.php', //This is the current doc
                type: "POST",
                data: {"catS":catSoldText,
                        "action":"elimina"},
                success: function(result){
                    if (result["err"]=="0") {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        if(result["cod"]){
                            $("button:contains('"+catSoldText+"')").remove();
                            catSselezionata.val("");
                        }
                        $("p").text(result["msg"]);
                        $("p").removeClass("alert-warning");
                        result["msg"].includes("ERRORE") || result["msg"].includes("ERRORE") ? $("p").addClass(" alert-danger") : $("p").addClass("  alert-success") ;
                    }
                }
            }); 
            swichUpdateAndSave(catSselezionata,modificaS,salvaS);
            $("img[data-catS-type='elimina']").toggle();
        }
    });

    $("img[data-catP-type='aggiungi']").click(function(){
        $("p").remove();
        let newP = $("input#nuovaCatP").val();
        if (newP){
            $.ajax({
                url: 'api-categorie.php', //This is the current doc
                type: "POST",
                data: {"catP":newP,
                        "action":"aggiungi"},
                success: function(result){
                    if (result["err"]=="0") {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        if(result["cod"]){
                            let newItem = `<button type="button" class="list-group-item list-group-item-action" data-cat-type="P">${newP}</button>`;
                            $("div.list-group[data-cat-type='P']").append(newItem)
                            $("button:contains('"+newP+"')").click(function(){
                                btPEvent($("button:contains('"+newP+"')"),catPselezionata,modificaP,salvaP);
                            });
                        }
                        msg = `<p class="">${result["msg"]}</p>`;
                        $("div.panel-body[data-cat-type='P']").prepend(msg);
                        result["msg"].includes("ERRORE") || result["msg"].includes("Errore") ? $("p").addClass("alert-danger") : $("p").addClass("alert-success") ;
                        $("input#nuovaCatP").val("");
                    }
                }
            }); 
        }
    });

    $("img[data-catS-type='aggiungi']").click(function(){
        $("p").remove();
        let newS = $("input#nuovaCatS").val();
        if (newS){
            $.ajax({
                url: 'api-categorie.php', //This is the current doc
                type: "POST",
                data: {"catP":catPoldText,
                        "catS":newS,
                        "action":"aggiungi"},
                success: function(result){
                    if (result["err"]=="0") {
                        $(location).attr('href',result["location"]+"?msg=Utente+non+loggato");
                    } else {
                        if(result["cod"]){
                            let newItem = `<button type="button" class="list-group-item list-group-item-action" data-cat-type="S">${newS}</button>`;
                            $("div.list-group[data-cat-type='S']").append(newItem)
                            $("button:contains('"+newS+"')").click(function(){
                                btSEvent($("button:contains('"+newS+"')"),catSselezionata,modificaS,salvaS);
                            });
                        }
                        msg = `<p class="">${result["msg"]}</p>`;
                        $("div.panel-body[data-cat-type='S']").prepend(msg);
                        result["msg"].includes("Errore") || result["msg"].includes("ERRORE") ? $("p").addClass("alert-danger") : $("p").addClass("alert-success") ;
                        $("input#nuovaCatS").val("");
                    }
                }
            }); 
        }
    });
});