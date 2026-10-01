<div class="row">
        <div class="col-12 text-center">
            <h2>Visualizza Prodotti</h2>
        </div>  
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10">
            <?php if(isset($templateParams["msg"])): ?>
                <p class ="p-3 mb-2 <?php if(strpos($templateParams["msg"], "Errore") !==false){echo '.alert-danger';} else { echo "alert-success";} ?>"><?php echo $templateParams["msg"]; ?></p>
            <?php endif; ?>
            <table class="table text-center table table-bordered shadow">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" id="preview">Preview</th>
                    <th scope="col" id="quantita">Qt</th>
                    <th scope="col" id="prezzo">€</th>
                    <th scope="col" id="azioni">Azioni</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach($templateParams["prodotti"] as $product) : ?>
                        <!-- product -->
                    <tr data-searchVenditore = "<?php echo strtolower(str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["numero"])?>">
                        <td headers="preview <?php echo str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["numero"]?>">
                            <img class="img-fluid" src="<?php echo UPLOAD_DIR."Prodotti/".$product["img"]?>" alt="">
                        </td>
                        <td rowspan="3" headers="quantita <?php str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["catP"]."_".$product["numero"]?>">
                            <?php echo $product["qt"] ?>
                        </td>
                        <td rowspan="3" headers="prezzo <?php echo str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["catP"]."_".$product["numero"]?>">
                            <?php echo $product["prezzo"] ?>
                        </td>
                        <td rowspan="3" headers= "azioni <?php echo str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["catP"]."_".$product["numero"]?>">
                            <a href="gestisciProdotti.php?action=2&numero=<?php echo $product["numero"];?>&catP=<?php echo $product["catP"];?>" class="btn btn-light">
                                <img src="<?php echo UPLOAD_DIR;?>icone/Edit-icon.png" alt="modifica"/>
                            </a>
                            <form action="processa-prodotto.php" method="POST">
                                <button type="submit" class="btn btn-light"><img src="<?php echo UPLOAD_DIR;?>icone/Editing-Delete-icon.png" alt="elimina"/></button>
                                <input type="hidden" name="action" value="3" />
                                <input type="hidden" name="numero" value="<?php echo $product["numero"]; ?>" />
                                <input type="hidden" name="catP" value="<?php echo $product["catP"]; ?>" />
                                <input type="hidden" name="img" value="<?php echo $product["img"]; ?>" />
                                <input type="hidden" name="nome" value="<?php echo $product["nome"]; ?>" />
                            </form>
                        </td>
                    </tr>
                    <tr data-searchVenditore = "<?php echo  strtolower(str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["numero"])?>">
                        <th id ="<?php echo str_replace(" ", "_", $product["nome"]."_".$product["numero"])?>" headers="preview"><?php echo $product["nome"]?></th>
                    </tr>
                    <tr data-searchVenditore = "<?php echo  strtolower(str_replace(" ", "_", $product["nome"]."_".$product["numero"]) ." " . $product["numero"])?>">
                        <th id ="<?php echo $product["catP"]."_".$product["numero"]?>" headers="preview">n°: <?php echo $product["numero"]?></th>
                    </tr>
                    <?php endforeach?>
                </tbody>
              </table>
        </div>
        <div class="col-md-1">
        <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
            <span class="fas fa-chevron-up"></span>
        </a>
        </div>
    </div>