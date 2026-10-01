<div class="row text-center">
    <div class="col-12 col-md-12">
        <h2>Pagamento</h2>
    </div>
</div>
<div class="row rowCart">
    <div class="col-md-2"></div>
    <div class="col-md-8 mb-3">
        <div class="d-flex shadow">
            <div class="card flex-fill p-4">

                <h5 class="mb-3 border-bottom border-secondary">Indirizzo di consegna</h5>

                <fieldset class="border border-primary rounded p-3 mb-3 shadow">
                    <legend class="text-primary text-right w-auto mb-0 far fa-check-circle"></legend>
                    <div><?php echo $templateParams["user"]["nome"]; ?> <?php echo $templateParams["user"]["cognome"]; ?></div>
                    <div><?php echo $templateParams["user"]["via"]; ?>, <?php echo $templateParams["user"]["numero"]; ?></div>
                    <div><?php echo $templateParams["user"]["citta"]; ?>, <?php echo $templateParams["user"]["cap"]; ?>, <?php echo $templateParams["user"]["provincia"]; ?></div>
                    <div><span class="fas fa-phone mr-2"></span><?php echo $templateParams["user"]["cel"]; ?></div>
                    <div><span class="far fa-envelope mr-2"></span><?php echo $templateParams["user"]["email"]; ?></div>
                </fieldset>


                <h5 class="my-3 border-bottom border-secondary">Riepilogo</h5>
                <ul class="list-group list-group-flush border-0">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 mx-3">
                        Totale articoli
                        <span class="articoli"><?php echo $templateParams["numArticoli"] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 mx-3">
                        Totale provvisorio
                        <span class="totale"><?php echo $templateParams["totale"] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0 mx-3">
                        Spedizione
                        <span>Gratis</span>
                    </li>
                    <li class="list-group-item align-items-center border-0 px-0 mb-3">
                        <div class="card-footer font-weight-bold">
                            <h4>Totale
                                <div class="totale text-right"><?php echo $templateParams["totale"] ?></div>
                            </h4>
                        </div>
                    </li>
                </ul>
                <form action="gestisciPagamento.php" method="post">
                    <div class="text-center">
                        <button class="btn btn-primary credit-button my-2" type="submit">Paga ora</button>
                        <input class="totale" type="hidden" name="totale" value="<?php echo $templateParams["totale"] ?>" />
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>