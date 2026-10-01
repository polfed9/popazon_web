<div class="row">
    <div class="col-sm-3 d-flex"></div>
    <div class="col-md-6 d-flex my-4">
        <div class="card card-body flex-fill p-0 shadow">
            <div class="text-center">
                <img src="<?php echo UPLOAD_DIR."Prodotti/".$templateParams["product"][0]["img"]; ?>" class="card-img-top p-2 prod-page-img" alt="...">
            </div>
            <?php if($templateParams["product"][0]["qt"] == 0) : ?>
                <span class="float-right badge badge-light text-danger">Esaurito</span>
            <?php endif; ?>
            <h6 class="text-light bg-info text-center rounded m-3 p-1 text-wrap"><?php echo $templateParams["product"][0]["nome"]; ?></h6>
            <h4 class="card-title mt-auto text-center font-weight-bold"><?php echo $templateParams["product"][0]["prezzo"]; ?>€</h4>
            <p class="px-4"><?php echo $templateParams["product"][0]["descr"]; ?></p>
            <div>
                <p class="px-4"><span class="font-weight-bold">Categoria: </span><?php echo $templateParams["product"][0]["catP"]; ?></p>
                <p class="px-4"><span class="font-weight-bold">Franchise: </span><?php echo $templateParams["product"][0]["catS"]; ?></p>
            </div>
            <input type="hidden" name="catP" value="<?php echo $templateParams["product"][0]["catP"]; ?>" />
            <input type="hidden" name="img" value="<?php echo $templateParams["product"][0]["img"]; ?>" />
            <input type="hidden" name="numero" value="<?php echo $templateParams["product"][0]["numero"]; ?>" />
            <input type="hidden" name="nome" value="<?php echo $templateParams["product"][0]["nome"]; ?>" />
            <input type="hidden" name="prezzo" value="<?php echo $templateParams["product"][0]["prezzo"]; ?>" />
            <button class="add_to_cart text-info bg-light" type="submit" name="add_to_cart"
                <?php if($templateParams["product"][0]["qt"] == 0) : ?>
                    echo disabled
                <?php endif; ?>
            >Aggiungi al carrello</button>
            <div class="msg">    
            </div>
        </div>
    </div>
    <div class="col-sm-3 d-flex"></div>
</div>
