<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">        
        <hr>
        <h5 class="text-center">Risultato dell ricerca</h5>
        <div class="row" id="result">
            <?php foreach ($templateParams["result"] as $prod) : ?>
                <div class="col-md-4 d-flex" data-product="<?php echo $prod["catS"]; ?>">
                    <div class="card card-body flex-fill all-product-deck product mb-4 shadow">
                        <div>
                            <img src="<?php echo UPLOAD_DIR."Prodotti/".$prod["img"];?>" class="card-img-top p-2" alt="">
                        </div>   
                        <?php if($prod["qt"] == 0) : ?>
                            <span class="float-right badge badge-light text-danger">Esaurito</span>
                        <?php endif; ?> 
                        <input type="submit" class="text-light bg-info text-center rounded m-3 p-1 text-wrap" form="see-product-<?php echo $prod["nome"]; ?>-<?php echo $prod["numero"]; ?>"value="<?php echo $prod["nome"]; ?>" />
                        <h4 class="card-title mt-auto font-weight-bold"><?php echo $prod["prezzo"];?>€</h4>
                        <p><?php echo substr($prod["descr"], 0, strpos($prod["descr"], 'Funko')); ?></p>
                    </div>
                    <form id="see-product-<?php echo $prod["nome"]; ?>-<?php echo $prod["numero"]; ?>" action="product.php?name=<?php echo $prod["nome"]; ?>" method="get">
                        <input type="hidden" name="catP" value="<?php echo $prod["catP"]; ?>" />
                        <input type="hidden" name="numero" value="<?php echo $prod["numero"]; ?>" />
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<div class="col-md-1">
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
        <span class="fas fa-chevron-up"></span>
    </a>
</div>

