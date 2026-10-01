<?php $user = $templateParams["user"] ?>
<?php if(!isset($_SESSION['email'])):?>
    <?php else: ?>
        <?php endif; ?>
<div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">

                <div class="panel panel-register my-5 mx-2 bg-white shadow mb-4 z-depth-5">
                    <div class="panel-heading pt-3 text-center">
                        <h3><?php echo (!isset($_SESSION['email']))? "Registrazione" : "Modifica Utente" ?></h3>
                    </div>
                    <hr class="mt-2 mb-3" />
                    <div class="panel-body p-2 ">
                        <div class="row ">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 col-12 ">
                                <form id="register-form" class="form-horizontal " action="" method="POST" role="form">
                                    <div class="p-3 py-3">
                                        <div class="row form-group">
                                            <div class="col-md-6 col-6 "><label class="d-none" for="nome">Nome:</label><input type="text" name="nome" id="nome" tabindex="1" class="form-control" placeholder="Name" value="<?php echo $user["nome"]; ?>" required></div>
                                            <div class="col-md-6 col-6"><label class="d-none" for="cognome">Cognome:</label><input type="text" name="cognome" id="cognome" tabindex="1" class="form-control" placeholder="Surname" value="<?php echo $user["cognome"]; ?>" required></div>
                                        </div>
                                        <div class="form-group">
                                        <?php if(!isUserLoggedIn()):?>
                                            <label class="d-none" for="email">Email:</label><input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
                                        <?php else: ?>
                                            <label class="d-none" for="email">Email:</label><input type="email" name="email" id="email" tabindex="1" class="form-control" disabled placeholder="Email Address" value="<?php echo $user["email"]; ?>">
                                        <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-none" for="cel">Cellulare:</label><input type="tel" name="cel" id="cel" tabindex="1" class="form-control" placeholder="Phone Number" value="<?php echo $user["cel"]; ?>" required maxlength="10" minlength="10">
                                        </div>
                                        <div class="form-group">
                                            <label class="d-none" for="city">Città:</label><input type="text" name="citta" id="city" tabindex="1" class="form-control" placeholder="City" value="<?php echo $user["citta"]; ?>" required>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-8 col-8"><label class="d-none" for="prov">Provincia:</label><input type="text" name="prov" id="prov" tabindex="1" class="form-control" placeholder="Province" value="<?php echo $user["provincia"]; ?>" required maxlength="2" minlength="2"></div>
                                            <div class="col-md-4 col-4"><label class="d-none" for="cap">CAP:</label><input type="text" name="cap" id="cap" tabindex="1" class="form-control" placeholder="CAP" value="<?php echo $user["cap"]; ?>" required maxlength="5" minlength="5"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-9 col-9"><label class="d-none" for="via">Via:</label><input type="text" name="via" id="via" tabindex="1" class="form-control" placeholder="Via/Viale/Piazza" value="<?php echo $user["via"];?>" required></div>
                                            <div class="col-md-3 col-3"><label class="d-none" for="nCivic">Numero Civico:</label><input type="text" name="nCivic" id="nCivic" tabindex="1" class="form-control" placeholder="n." value="<?php echo $user["numero"]; ?>" required></div>
                                        </div>
                                        <?php if(!isset($_SESSION['email'])):?>
                                        <div class="form-group">
                                            <label class="d-none" for="password">Password:</label><input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="d-none" for="confirmPassword">Confirm Password:</label><input type="password" name="confirmPassword" id="confirmPassword" tabindex="2" class="form-control" placeholder="Confirm Password" required>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-group text-center">
                                        <?php if(isset($templateParams["venditore"])):?>
                                            <div class="form-group">
                                                <label class="d-none" for="pIva">Partita IVA:</label><input type="tel" name="pIva" id="pIva" tabindex="2" disabled class="form-control" placeholder="Partita IVA" value="<?php echo $user["pIva"]; ?>" required>
                                            </div>
                                        <?php else: ?>
                                            <label class="d-none" for="newsletter">Iscrizione alla Newsletter:</label><input type="checkbox" tabindex="3" class="" name="newsletter" id="newsletter" <?php echo ($user["newsletter"]===1) ? "checked" : "" ?>>
                                            <label> Newsletter</label>
                                        <?php endif; ?>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row justify-content-center">
                                                <div class="col-md-6 col-md-offset-3 col-6 col-offset-3">
                                                    <input type="submit" name="registerBtn" id="registerBtn" tabindex="4" class="form-control btn btn-primary btn-register" value="<?php echo (!isset($_SESSION['email']))? "Registrati" : "Modifica" ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
					<div class="error">
                        <?php if (isset($result)) echo $result; ?>
                        <?php if (!empty($form_errors)) echo show_errors($form_errors); ?>
                    </div>
				</div>
                </div>
            </div>
        </div>
    </div>
