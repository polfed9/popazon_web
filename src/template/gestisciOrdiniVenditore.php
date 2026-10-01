<div class="row">
        <div class="col-12 text-center">
            <h2>Gestisci ordini</h2>
        </div>  
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-12 col-md-8">
            <table class="table text-center table table-bordered shadow">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" id="ordineNumero" class="w-25">Ordine N°</th>
                    <th scope="col" id="statoAttuale"  class="w-75">Stato Attuale</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                    <!-- Ordine -->
                    <?php foreach($templateParams["ordini"] as $ordine): ?>
                        <?php if($ordine["id"] != $templateParams["consegnato"]["consegnato"]): ?>
                            <tr>
                                <th class= "text-center" id= "ordine<?php echo $ordine["ordine"]?>" headers= "ordineNumero">#<?php echo $ordine["ordine"]?></th>
                                <td class= "text-center" headers= "statoAttuale ordine<?php echo $ordine["ordine"]?>">
                                    <?php foreach($templateParams["stati"] as $stato) : ?>
                                        <?php if($stato["id"]==$ordine["id"]): ?>
                                            <label for="<?php echo $ordine["ordine"].$stato["id"]?>" class="d-none">stato ordine</label>
                                            <input type="text" name="stato" id="<?php echo $ordine["ordine"].$stato["id"]?>" value="<?php echo $stato["nome"]?>" disabled/>
                                        <?php endif?>
                                    <?php endforeach; ?>
                                    <input type="button" class= "btn btn-outline-dark" name="submit" value ="Avanza"/>
                                    <input type="button" class= "btn btn-outline-dark" name="submit" value ="Annulla"/>
                                </td>
                            </tr>
                        <?php endif?>
                  <?php endforeach; ?>
                </tbody>
              </table>
        </div>
        <div class="col-md-2">
            <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
                <span class="fas fa-chevron-up"></span>
            </a>
        </div>
    </div>