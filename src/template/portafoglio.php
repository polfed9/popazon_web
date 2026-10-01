<div class="row">
    <div class="col-12 text-center">
        <h2>Portafoglio</h2>
    </div>
    <div class="col-md-1"></div>
    <div class="col-12 col-md-10">
        <div class="tab-content mb-3 bg-white p-4 shadow">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row col-12 m-0 p-0">
                        <h3 class="border-bottom border-dark mb-3 col-6">Saldo</h3>
                        <h3 class="border-bottom border-dark mb-3 col-6 text-right"><?php echo str_replace('.', ',', $templateParams["saldo"]); ?> €</h3>
                    </div>

                    <p class="text-info">Seleziona un importo per ricaricare il portafoglio.</p>
                    
                    <div class="btn-group text-center" role="group" aria-label="ricarica group">

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <label for="ric5" class="btn btn-outline-dark rounded">5 euro</label>
                                <input type="radio" class="btn-check" name="ricarica" id="ric5" autocomplete="off" value="5" />
                                
                                <label for="ric10" class="btn btn-outline-dark rounded">10 euro</label>
                                <input type="radio" class="btn-check" name="ricarica" id="ric10" autocomplete="off" value="10"/>

                                <label for="ric15" class="btn btn-outline-dark rounded">15 euro</label>
                                <input type="radio" class="btn-check" name="ricarica" id="ric15" autocomplete="off" value="15"/>

                                <label for="ric20" class="btn btn-outline-dark rounded">20 euro</label>
                                <input type="radio" class="btn-check" name="ricarica" id="ric20" autocomplete="off" value="20"/>

                                <label for="ric30" class="btn btn-outline-dark rounded">30 euro</label>
                                <input type="radio" class="btn-check" name="ricarica" id="ric30" autocomplete="off" value="30" />

                                <label for="ric50" class="btn btn-outline-dark rounded">50 euro</label>
                                <input type="radio" class="btn-check" name="ricarica" id="ric50" autocomplete="off" value="50"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container py-5 d-none pagamento">
                        <!-- For demo purpose -->
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Carta di credito</h5>
                                        <!-- Credit card form content -->
                                        <div class="tab-content">
                                            <!-- credit card info-->
                                            <div id="credit-card" class="tab-pane fade show active pt-3">
                                                <div class="form-group"> 
                                                    <label for="username">
                                                        <h6>Proprietario</h6>
                                                    </label> 
                                                    <input type="text" name="username" placeholder="Proprietario" required class="form-control campoPagamento" /> 
                                                </div>
                                                <div class="form-group"> 
                                                    <label for="cardNumber">
                                                        <h6>Numero carta</h6>
                                                    </label>
                                                    <div class="input-group"> 
                                                        <input type="number" name="cardNumber" placeholder="Numero carta valido" class="form-control campoPagamento nCarta" required />
                                                        <div class="input-group-append col-sm-12"> 
                                                            <span class="input-group-text text-muted"> 
                                                                <i class="fab fa-cc-visa mx-1"></i> 
                                                                <i class="fab fa-cc-mastercard mx-1"></i> 
                                                                <i class="fab fa-cc-amex mx-1"></i> 
                                                            </span> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group"> 
                                                            <label>
                                                                <span class="hidden-xs">
                                                                    <h6>Data di scadenza</h6>
                                                                </span>
                                                            </label>
                                                            <div class="input-group"> 
                                                            <?php $d=strtotime("today");?>
                                                            <input type="month" id="start" name="start"
                                                                min="<?php echo date("Y-m", $d)?>" value="<?php echo date("Y-m", $d)?>"> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group mb-4"> 
                                                            <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                                <h6>CVV</h6>
                                                            </label> 
                                                            <input type="number" class="form-control campoPagamento cvv" required /> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer"> 
                                                    <button type="button" class="subscribe btn btn-dark btn-block shadow-sm"> Conferma ricarica
                                                    </button>
                                                </div>
                                            </div> <!-- End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <h5 class="col-6">Movimenti</h5>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" id="data">Data</th>
                                <th scope="col" id="oggetto">Oggetto</th>
                                <th scope="col" id="importo">Importo</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($templateParams["movimenti"] as $movimento => $value) : ?>
                                <tr>
                                    <th id="<?php echo $movimento; ?>" class="d-none" ><?php echo $movimento; ?></th>
                                    <td headers="<?php echo $movimento; ?> data"><?php echo $value["dataP"]; ?></td>
                                    <td headers="<?php echo $movimento; ?> oggetto"><?php echo $value["oggetto"]; ?></td>
                                    <td headers="<?php echo $movimento; ?> importo" class="text-right text-<?php echo $value["importo"] >= 0 ?  "success" : "danger"; ?>"><?php echo str_replace('.', ',', $value["importo"]); ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-1">
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
        <span class="fas fa-chevron-up"></span>
    </a>
</div>
</div>