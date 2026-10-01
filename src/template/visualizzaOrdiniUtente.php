<div class="row">
    <div class="col-12 text-center py-3">
        <h3>Gestisci ordini</h3>
    </div>  
</div>
    <?php if(empty($templateParams["ordini"])): ?>
        <div class="row d-flex justify-content-center py-3">
            <div class="col-md-6 col-6">
                <div class="card card-body flex-fill text-center shadow">
                    <span class="fas fa-archive"></span>
                    <h4 class="mb-2 py-2">Non è stato effettuato alcun ordine</h4>
                </div>
            </div>
        </div>
    <?php else : ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10">
            <table class="table text-center table table-bordered shadow">
                <thead class="thead-dark">
                  <tr>
                    <th id="ordineNumero" class="w-45">Ordine N°</th>
                    <th id="data" class="w-45">Ordine effettuato il</th>
                    <th id="totale" class="w-5">Totale</th>
                    <th id="dettagli" class="w-5">Info</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                    <!-- Ordine -->
                    <?php foreach($templateParams["ordini"] as $ordine): ?>
                            <tr>
                                <!-- Colonna Numero Ordine -->
                                <th id= "ordine<?php echo $ordine["ordine"]?>" headers= "ordineNumero"> #<?php echo $ordine["ordine"]?> </th>

                                <!-- Data in cui è stato fatto l'ordine -->
                                <td class= "text-center" headers= "data ordine<?php echo $ordine["ordine"]?>">
                                    <label> <?php echo $ordine["data"]?> </label>
                                </td>

                                <!-- Totale dell'ordine -->
                                <td class= "text-center" headers= "totale ordine<?php echo $ordine["ordine"] ;?>">
                                    <label> <?php echo $ordine["totale"], " €"; ?> </label>
                                </td>

                                <!-- Bottone per sapere le info relative all'ordine -->
                                <td class= "text-center" headers= "dettagli ordine<?php echo $ordine["ordine"]?>">
                                    <a href="tracciaOrdine.php?ordine=<?php echo $ordine["ordine"];?>" class="btn btn-light">
                                        <img src="<?php echo UPLOAD_DIR;?>icone/info-icon.png" class="img-responsive" alt="modifica"/>
                                    </a>
                                </td>
                            </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
        </div>
        <div class="col-md-1"></div>
    </div>
    <?php endif; ?>