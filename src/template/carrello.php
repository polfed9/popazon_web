<div class="row text-center">
    <div class="col-12 col-md-12">
        <h2>Carrello</h2>
    </div>
</div>
<div class="row rowCart mb-3">

    <?php if (!empty($templateParams["carrello"])) { ?>
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <?php if (isset($templateParams["msg"])) : ?>
                <p class="alert-danger"><?php echo str_replace("-", " ", $templateParams["msg"]); ?></p>
            <?php endif; ?>
            <?php
            $total = 0;
            foreach ($templateParams["carrello"] as $keys => $values) : ?>
                <div class="d-flex shadow " data-CardId="<?php echo $values["item_id"]; ?>">
                    <div class="card flex-fill">
                        <div class="row">
                            <div class="col-3 d-md-none"></div>
                            <div class="col-md-3 col-6 imgCartContaier mt-4 text-center pr-0">
                                <a href="product.php?<?php
                                                        $exp_id = explode("_", $values["item_id"]);
                                                        echo "catP=" . $exp_id[0] . "&numero=" . $exp_id[1];
                                                        ?>">
                                    <img class="img-fluid" src="<?php echo UPLOAD_DIR . "Prodotti/" . $values["item_img"] ?>" alt="" />
                                </a>
                            </div>
                            <div class="col-3 d-md-none"></div>
                            <div class="col-md-9 p-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $values["item_nome"]; ?></h5>
                                    <p class="card-text" data-id="<?php echo $values["item_id"]; ?>" data-prezzo="<?php echo $values["item_prezzo"]; ?>">Prezzo: <?php echo $values["item_prezzo"]; ?> €</p>
                                    <div class="input-group px-0">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number alert-danger" data-type="minus" data-id="<?php echo $values["item_id"]; ?>" aria-label="diminuisci_quantita" title="diminuisci_quantita">
                                                <span class="fas fa-minus fasCart"></span>
                                            </button>
                                        </span>
                                        <label for="<?php echo $values["item_id"]; ?>" class="d-none">quantità </label>
                                        <input type="text" id="<?php echo $values["item_id"]; ?>" name="<?php echo $values["item_id"]; ?>" class="form-control input-number text-center" value="<?php echo $values["item_quantita"]; ?>" min="1" max="1000" disabled />

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number alert-success" data-type="plus" data-id="<?php echo $values["item_id"]; ?>" aria-label="aumenta_quantita" title="aumenta_quantita">
                                                <span class="fas fa-plus fasCart"></span>
                                            </button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" data-type="trash" data-id="<?php echo $values["item_id"]; ?>" aria-label="elimina_prodotto" title="elimina_prodotto">
                                                <span class="fas fa-trash fasCart"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php $total = $total + ($values["item_quantita"] * $values["item_prezzo"]);
            endforeach; ?>

        </div>
        <div class="col-md-4">
            <!-- Card -->
            <div class="card mb-3">
                <div class="card-body shadow">

                    <h5 class="mb-3">Riepilogo</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Totale articoli
                            <span class="articoli"><?php echo $templateParams["numArticoli"] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Totale provvisorio
                            <span class="totale"><?php echo number_format($total, 2); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Spedizione
                            <span>Gratis</span>
                        </li>
                        <li class="list-group-item align-items-center border-0 px-0 mb-3">
                            <div class="card-footer">
                                <div class="text-left">Totale </div>
                                <div class="text-right totale"> <?php echo number_format($total, 2); ?> </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center">
                        <form action="pagamento.php" method="post">
                            <button class="btn btn-primary credit-button my-2">Vai al pagamento</button>
                            <input class="totale" type="hidden" name="totale" value="<?php echo number_format($total, 2); ?>" />
                            <input class="nArt" type="hidden" name="nArt" value="<?php echo $templateParams["numArticoli"] ?>" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center p-3" data-type="nSpecifica">
                    <span class="fa fa-cart-arrow-down"></span>
                    <h4 class="mb-3">Non sono presenti prodotti nel carrello</h4>
                    <a href="inStock.php">
                        <h4 class="mb-3">Acquista ora</h4>
                    </a>
                </div>
            </div>
        </div>
</div>
<div class="col-md-1"></div>
<?php } ?>