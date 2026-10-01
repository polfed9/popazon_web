<div class="container rounded bg-white mt-5 mb-5">
    <?php $user = $templateParams["user"] ?>
    <div class="row">
        
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-3">
                <div class="col-md-12 col-4">
                    <img class="img-fluid rounded-circle py-3" alt="Responsive image" src="<?php echo UPLOAD_DIR; ?>icone/User.png">
                </div>
                <span class="font-weight-bold"><?php echo $user["nome"]; ?></span>
                <span class="text-black-50"> <?php echo $user["email"]; ?></span>
                <a class="btn btn-primary ordini-buttong my-2" href="logout.php">Logout</a>
            </div>
        </div>

        <div class="col-md-5 border-right">
            <form class="bg-white border mt-3 mb-3 px-3 py-3" action="" method="" enctype="multipart/form-data">
                <div class="p-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profilo</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 col-6"><label class="labels">Nome<input type="text" name="nome" id="nome" class="form-control" disabled="false" placeholder="Nome" value="<?php echo $user["nome"]; ?>"></label></div>
                        <div class="col-md-6 col-6"><label class="labels">Cognome<input type="text" name="cognome" id="cognome" class="form-control" disabled="false" value="<?php echo $user["cognome"]; ?>" placeholder="Cognome"></label></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Numero di telefono<input type="tel" name="cel" id="cel" class="form-control" disabled="false" placeholder="Numero Cellulare" value="<?php echo $user["cel"]; ?>"></label></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Email ID<input type="email" name="email" id="email" disabled="false" class="form-control" placeholder="Email id" value="<?php echo $user["email"]; ?>"></label></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 col-6"><label class="labels">Via<input type="text" name="via" id="via" class="form-control" disabled="false" placeholder="enter address" value="<?php echo $user["via"]; ?>"></label></div>
                        <div class="col-md-3 col-3"><label class="labels">N.<input type="text" name="nCivic" id="nCivic" class="form-control" disabled="false" placeholder="enter civic number" value="<?php echo $user["numero"]; ?>"></label></div>
                        <div class="col-md-3 col-3"><label class="labels">Prov<input type="text" name="prov" id="prov" disabled="false" class="form-control" value="<?php echo $user["provincia"]; ?>" placeholder="es: BO"></label></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-8 col-8"><label class="labels">Comune<input type="text" name="citta" id="city" class="form-control" disabled="false" placeholder="country" value="<?php echo $user["citta"]; ?>"></label></div>
                        <div class="col-md-4 col-4"><label class="labels">CAP<input type="text" name="cap" id="cap" class="form-control" disabled="false" value="<?php echo $user["cap"]; ?>" placeholder="cap"></label></div>
                    </div>
                    <div class="row mt-3 align-items-center">
                        <?php if ($user["email"] === "admin@email.com") : ?>
                            <div class="col-md-6"><label class="labels">Partita IVA<input type="text" name="iva" id="iva" class="form-control" disabled="false" placeholder="IVA" value="<?php echo $user["pIva"]; ?>"></label></div>
                    </div>
                        <?php else : ?>
                        <label class="labels col-md-12 text-center">
                            <?php echo ($user["newsletter"] === 1) ? "Iscritto alla Newsletter" : "NON iscritto alla Newsletter" ?>
                        </label>
                    </div>
                        <?php endif; ?>
                </div>
            </form>
        </div>
        
        <div class="col-md-4">
            <div class="p-3 py-3">
                <div class="row p-2 text-center">
                    <label class="labels col-md-12 text-center font-weight-bold">Operazioni</label>
                </div>
                <div id="loreg">
                    <ul class="list-inline text-center">
                        <li>
                            <a class="btn btn-primary credit-button my-2" href="login.php?action=2">Modifica Anagrafica</a>
                        </li>
                        <?php if ($user["email"] !== "admin@email.com") : ?>
                        <li>
                            <a class="btn btn-primary ordini-buttong my-2"  href="visualizzaOrdiniUtente.php">I miei ordini</a>
                        </li>
                        <li>
                            <a class="btn btn-primary credit-button my-2" href="portafoglio.php">Il mio portafoglio</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>