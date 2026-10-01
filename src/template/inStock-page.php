<div class="row">
    <div class="col-lg-3">
            <hr>
            <h5 class="text-black my-2 mx-2">Pop! Category</h5>
            <ul class="list-group shadow" id="category-list">
                <?php foreach ($templateParams["categoria_principale"] as $categoriaPrincipale) : ?>
                    <?php foreach ($templateParams["quantita"] as $quantita) : ?>
                        <?php if ($quantita["catP"] == $categoriaPrincipale["titolo"]) : ?>
                            <li class="list-group-item">
                                <div>
                                    <div>
                                        <input type="checkbox" title="categories-checkbox" class="form-check-category" value="<?php echo $categoriaPrincipale["titolo"]; ?>" id="<?php echo $categoriaPrincipale["titolo"]; ?>" checked/>
                                        <span class="form-check-label">Pop! <?php echo $categoriaPrincipale["titolo"]; ?>
                                            <span class="float-right badge badge-light round">
                                                <?php echo $quantita["qt"] ?>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        <?php endif ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
            <h5 class="text-black my-2 mx-2 pt-3">Franchise</h5>
            <ul class="list-group shadow" id="franchise-list">
                <?php foreach ($templateParams["quantita&catSpecifica"] as $categoriaSpecifica) : ?>
                    <li class="list-group-item">
                        <div>
                            <div>
                                <input type="checkbox" title="franchise-checkbox" class="form-check-franchise" value="<?php echo $categoriaSpecifica["catS"]; ?>" id="franchise-<?php echo $categoriaSpecifica["catS"]; ?>" checked/>                   
                                <span class="form-check-label">Pop! <?php echo $categoriaSpecifica["catS"]; ?>            
                                    <span class="float-right badge badge-light round"><?php echo $categoriaSpecifica["qt"]; ?></span>
                                </span>  
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h5 class="text-black my-2 mx-2 pt-3">Prezzo</h5>
            <ul class="list-group shadow">
                <li class="list-group-item">
                    <input id="ex6" title="price-checkbox" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50"/>
                    <p id="ex6CurrentSliderValLabel">   
                        Prezzo 0€ - <span id="price-slider">100</span>€
                    </p>
                </li>
                <li class="list-group-item">
                    <button class="show-result my-1">Mostra risultati</button>
                    <button class="clear-filter my-1">Azzera filtri</button>
                </li>
            </ul>
        </div>
        <div class="col-lg-9">
            <hr>
            <h5 class="text-center">Tutti i prodotti</h5>
            <div class="row" id="result">
                <?php foreach ($templateParams["in_stock"] as $prod) : ?>
                    <div class="col-md-4 d-flex">
                        <div class="card card-body flex-fill product mb-4 shadow" data-id="<?php echo $prod["nome"]; ?><?php echo $prod["numero"]; ?>" data-categoryP="<?php echo $prod["catP"]; ?>" data-franchise="<?php echo $prod["catS"]; ?>" data-price="<?php echo $prod["prezzo"]; ?>">
                            <div>
                                <img src="<?php echo UPLOAD_DIR."Prodotti/".$prod["img"];?>" class="card-img-top p-2" alt="...">
                            </div>    
                            <input type="submit" class="text-light bg-info text-center rounded m-3 p-1 text-wrap" form="see-product-<?php echo $prod["catP"]; ?>-<?php echo $prod["numero"]; ?>"
                                    value="<?php echo $prod["nome"]; ?>"/>
                                <h4 class="card-title mt-auto text-center font-weight-bold"><?php echo $prod["prezzo"]; ?>€</h4>
                                <p><?php echo substr($prod["descr"], 0, strpos($prod["descr"], 'Funko')); ?></p>
                        </div>
                        <form id="see-product-<?php echo $prod["catP"]; ?>-<?php echo $prod["numero"]; ?>" action="product.php" method="get">
                            <input type="hidden" name="catP" value="<?php echo $prod["catP"]; ?>" />
                            <input type="hidden" name="numero" value="<?php echo $prod["numero"]; ?>" />
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1">
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
        <span class="fas fa-chevron-up"></span>
    </a>
</div>
