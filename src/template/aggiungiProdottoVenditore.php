<?php 
    $prodotto = $templateParams["prodotto"]; 
    $azione = getAction($templateParams["azione"])
?>
<div class="row">
        <div class="col-12 text-center">
            <h2>Aggiungi nuovo prodotto</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10">
            <form class="bg-white border mt-4 mb-4 px-5 py-4 shadow" action="processa-prodotto.php" method="POST" enctype="multipart/form-data">
                <?php if(isset($templateParams["erroreProdotto"])): ?>
                    <p class = "alert-danger"><?php echo $templateParams["erroreProdotto"]; ?></p>
                <?php endif; ?>
                <div class="form-group row text-center">
                    <label for="nome" class="col-6 col-md-4">Nome</label>
                    <input type="text" class="form-control col-6 col-md-4" id="nome" name="nome" required value="<?php echo $prodotto["nome"]; ?>"/>
                </div>
                <div class="form-group row text-center">
                    <label for="numero" class="col-6 col-md-4">Numero</label>
                    <input class="form-control col-6 col-md-4" id="numero"  name="numero" required type="number" min="0" max="1000" value="<?php echo $prodotto["numero"]; ?>" <?php if(!empty($prodotto["numero"])){ echo "disabled";}?>/>
                </div>
                <div class="form-group row text-center">
                    <label for="descrizione" class="col-6 col-md-4">Descrizione:</label>
                    <textarea class="form-control col-6 col-md-4" id="descrizione"  name="descrizione" required type="text" value="<?php echo $prodotto["descr"]; ?>"><?php echo $prodotto["descr"]?></textarea>
                </div>
                <div class="form-group row text-center">
                    <label for="prezzo" class="col-6 col-md-4">Prezzo: €</label>
                    <input class="form-control col-6 col-md-4" aria-label="Amount (to the nearest dollar)" id="prezzo"  name="prezzo" placeholder="0.00" required type="number" step="0.01" min="0" max="1000" value="<?php echo $prodotto["prezzo"]; ?>"/>
                </div>
                <div class="form-group row text-center">
                    <label for="quantita" class="col-6 col-md-4">Quantit&agrave;:</label>
                    <input class="form-control col-6 col-md-4" id="quantita" name="quantita" placeholder="Enter a number" required type="number"  min="0" max="1000" value="<?php echo $prodotto["qt"]; ?>"/>
                </div>
                <div class="form-group row text-center">
                    <label for="catP" class="col-6 col-md-4">Categoria principale:</label>
                    <div class="select-wrapper col-6 col-md-4">
                        <select class="form-control w-100" name="catP" id="catP" value="<?php echo $prodotto["catP"]?>" <?php if(!empty($prodotto["catP"])){ echo "disabled";}?>>
                            <?php if(empty($prodotto["catP"])):?>
                                <option value="" disabled selected>Choose option</option>
                                <?php foreach($templateParams["catP"] as $catP) : ?>
                                    <option value="<?php echo $catP["titolo"]?>"><?php echo $catP["titolo"]?></option>
                                <?php endforeach;?>
                            <?php else: ?>
                                <option value="<?php echo $prodotto["catP"]?>" selected><?php echo $prodotto["catP"]?></option>
                            <?php endif;?>   
                        </select>
                      </div>
                        <?php if(isset($templateParams["erroreCatP"])): ?>
                            <p class = "alert-danger"><?php echo $templateParams["erroreCatP"]; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-group row text-center">
                    <label for="catS" class="col-6 col-md-4">Categoria specifica:</label>
                    <div class="dropdown col-6 col-md-4">
                        <select class="form-control w-100" name="catS" id="catS" <?php if(!empty($prodotto["catS"])){ echo "disabled";}?>>
                            <?php if(!empty($prodotto["catS"])): ?>
                                <option value="<?php echo $prodotto["catS"]?>" selected><?php echo $prodotto["catS"]?></option>
                            <?php endif;?>
                            <?php if(empty($prodotto["catP"])):?>
                                <option value="" disabled selected>Choose option</option>
                            <?php endif;?>
                            <!--ajax-->
                        </select>
                      </div>
                      <?php if(isset($templateParams["erroreCatS"])): ?>
                            <p class = "alert-danger"><?php echo $templateParams["erroreCatS"]; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-group row text-center">
                    <label for= "exclusive" class="col-6 col-md-4">Exclusive:</label>
                    <input type="checkbox" class="col-6 col-md-4" id="exclusive" name="exclusive" value="true"
                    <?php 
                        if($prodotto["exclusive"]){ 
                            echo ' checked="checked" '; 
                        } 
                    ?> />
                </div>
                <div class="form-group row text-center">
                    <label for="img" class="col-12 col-md-4">Immagine prodotto:</label>
                    <input type="file" name="img" id="img" class="col-12 col-md-4" <?php if(!empty($prodotto["img"])){ echo "disabled";}?>/>
                    <div class="col-md-4"></div>
                    <?php if($templateParams["azione"]!=1): ?>
                        <img src="<?php echo UPLOAD_DIR."Prodotti/".$prodotto["img"]; ?>" class="figure-img" alt="" />
                    <?php else: ?>
                        <img src="#" class="figure-img" alt="" />
                    <?php endif; ?>
                </div>

                <div class="form-group row text-center">
                    
                </div>
                <div class="form-group text-center">
                <a class="btn btn-light col-5" href="homeVenditore.php">Annulla</a>
                    <button type="submit" class="btn btn-light col-5 ">Conferma</button>    
                </div>
                <?php if($templateParams["azione"]!=1): ?>
                <input type="hidden" name="numero" value="<?php echo $prodotto["numero"]; ?>" />
                <input type="hidden" name="catP" value="<?php echo $prodotto["catP"]; ?>" />
                <input type="hidden" name="oldQt" value="<?php echo $prodotto["qt"]; ?>" />
                <?php endif;?>
                <input type="hidden" name="action" value="<?php echo $templateParams["azione"]; ?>" />
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>