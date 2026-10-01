<div class="row">
    <div class="col-lg-3">
        <hr>
        <h5 class="text-black my-2 mx-2">Pop! Category</h5>
        <ul class="list-group shadow">
            <?php foreach ($templateParams["categoria_principale"] as $categoriaPrincipale) : ?>
                <li class="list-group-item" <?php echo $categoriaPrincipale["titolo"] == $templateParams["categoria_scelta"][0]["catP"] ? "" : "hidden" ?>>
                    <div class="form-check-category-container">
                        <div>
                            <input type="checkbox" title="categories-checkbox" class="form-check-category" value="<?php echo $categoriaPrincipale["titolo"]; ?>" id="category" <?php
                                if ($categoriaPrincipale["titolo"] == $templateParams["categoria_scelta"][0]["catP"]) {
                                    echo "checked disabled";
                                } ?> 
                            />
                            <span class="form-check-label">Pop! <?php echo $categoriaPrincipale["titolo"]; ?>
                                <?php foreach ($templateParams["quantita"] as $quantita) : ?>
                                    <?php
                                    if ($quantita["catP"] == $categoriaPrincipale["titolo"]) : ?>
                                        <span class="float-right badge badge-light round">
                                            <?php echo $quantita["qt"] ?>
                                        </span>
                                    <?php endif ?>
                            </span>
                        <?php endforeach; ?>
                        </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <h5 class="text-black my-2 mx-2 pt-3">Franchise</h5>
        <ul class="list-group shadow">
            <?php foreach ($templateParams["quantita&catSpecifica"] as $categoriaSpecifica) : ?>
                <li class="list-group-item" <?php echo in_array($categoriaSpecifica["catS"], array_column($templateParams["franchise"], "catS")) ? "" : "hidden" ?>>
                    <div class="form-check-franchise-container">
                        <div>
                            <input type="checkbox" title="franchise-checkbox" class="form-check-franchise" value="<?php echo $categoriaSpecifica["catS"]; ?>" id="franchise" 
                            <?php if (in_array($categoriaSpecifica["catS"], array_column($templateParams["franchise"], "catS"))) {
                                    echo "checked";
                                } else {
                                    echo "disabled";
                                }
                                ?>
                            />
                            <span class="form-check-label">Pop! <?php echo $categoriaSpecifica["catS"]; ?>
                                <?php if (in_array($categoriaSpecifica["catS"], array_column($templateParams["franchise"], "catS"))) : ?>
                                    <span class="float-right badge badge-light round"><?php echo $categoriaSpecifica["qt"]; ?></span>                                        
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <h5 class="text-black my-2 mx-2 pt-3">Prezzo</h5>
        <ul class="list-group shadow">
            <li class="list-group-item">
                <input id="ex6" title="price-checkbox" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="50" />
                <p id="ex6CurrentSliderValLabel">
                    Prezzo 0€ - <span id="price-slider">100</span>€
                </p>
            </li>
            <li class="list-group-item">
                <button class="show-result">Show Result</button>
            </li>
        </ul>
    </div>
    <div class="col-lg-9">
        <hr>
        <h5 class="text-center">All Products</h5>
        <div class="row result">
            <?php foreach ($templateParams["categoria_scelta"] as $catScelta) : ?>
                <div class="col-md-4 d-flex">
                    <div class="card card-body flex-fill product mb-4 shadow" data-franchise="<?php echo $catScelta["catS"]; ?>" data-price="<?php echo $catScelta["prezzo"]; ?>">
                        <div class="product-image-containter">
                            <img src="<?php echo UPLOAD_DIR."Prodotti/".$catScelta["img"];?>" class="card-img-top p-2" alt="...">
                        </div>
                        <?php if($catScelta["qt"] == 0) : ?>
                            <span class="float-right badge badge-light text-danger">Esaurito</span>
                        <?php endif; ?>
                        <input type="submit" class="text-light bg-info text-center rounded m-3 p-1 text-wrap" form="see-product-<?php echo $catScelta["catP"]; ?>-<?php echo $catScelta["numero"]; ?>"
                            value="<?php echo $catScelta["nome"]; ?>"/>
                        <h4 class="card-title mt-auto text-center font-weight-bold"><?php echo $catScelta["prezzo"]; ?>€</h4>
                        <p><?php echo substr($catScelta["descr"], 0, strpos($catScelta["descr"], 'Funko')); ?></p>
                    </div>
                    <form id="see-product-<?php echo $catScelta["catP"]; ?>-<?php echo $catScelta["numero"]; ?>" action="product.php" method="get">
                        <input type="hidden" name="catP" value="<?php echo $catScelta["catP"]; ?>" />
                        <input type="hidden" name="numero" value="<?php echo $catScelta["numero"]; ?>" />
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="col-md-1">
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
        <span class="fas fa-chevron-up"></span>
    </a>
</div>
