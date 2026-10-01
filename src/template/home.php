<div class="row my-3">
    <div class="slideshow-container">
        <div class="mySlides1">
            <img src="upload/banner.png">
        </div>

        <div class="mySlides1">
            <img src="upload/banner1.jpg">
        </div>

        <a class="prev">&#10094;</a>
        <a class="next">&#10095;</a>
    </div>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">   
        <div class="row"> 
            <?php foreach ($templateParams["categoria_principale"] as $categoriaPrincipale) : ?>
                <?php $templateParams["result"] = $dbh->getProductsByCatP($categoriaPrincipale["titolo"]); ?>
                <?php if (!empty($templateParams["result"])) : ?>
                    <div class="col-md-4 col-12 d-flex">
                        <div class="card card-body flex-fill  my-3 shadow">
                            <?php $templateParams["random_product"] = $dbh-> getRandomProduct($categoriaPrincipale["titolo"], 1); ?>
                            <div>
                                <img src="<?php echo UPLOAD_DIR."Prodotti/".$templateParams["random_product"][0]["img"]?>" class="card-img-top p-2" alt="..." />
                            </div>
                            <p class="card-text">Scopri tutti i prodotti della categoria Funko Pop! <?php echo $categoriaPrincipale["titolo"]; ?></p>
                            <div class="card-footer my-3 mt-auto">
                                <input type="submit" class="text-light bg-info text-center rounded m-3 p-1" form="see-product-<?php echo $categoriaPrincipale["titolo"]; ?>" value="<?php echo $categoriaPrincipale["titolo"]; ?>"/>
                            </div>
                            <form id="see-product-<?php echo $categoriaPrincipale["titolo"]; ?>" action="category.php" method="get">
                                <input type="hidden" name="catP" value="<?php echo $categoriaPrincipale["titolo"]; ?>" />
                            </form>
                        </div>    
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
