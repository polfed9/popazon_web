<?php $user = $templateParams["user"] ?>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">

            <div class="panel panel-register my-5 mx-2 bg-white shadow mb-4 z-depth-5">
                <div class="panel-heading pt-3 text-center">
                <h3> <?php echo (!isset($_SESSION['email']))? "Login" : "Conferma Utente" ?></h3> 
                </div>
                <hr class="mt-2 mb-3" />

                <div class="panel-body p-2 ">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-12 ">
                            <form id="login-form" class="form-horizontal " action="" method="POST" role="form">
                                <div class="p-3 py-3 justify-content-center ">
                                    <div class="row input-group justify-content-center py-2">
                                    <?php if(!isset($_SESSION['email'])):?>
                                           <div class=" col-md-10 col-12 "><label class=" d-none" for="email">Email:</label><input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required></div>
                                        <?php else: ?>
                                            <div class="col-md-10 col-12 "><label class=" d-none" for="email">Email:</label><input type="email" name="email" id="email" tabindex="1" class="form-control" disabled="false" placeholder="Email" value="<?php echo $user["email"]; ?>" required></div>
                                        <?php endif; ?>
                                    </div>  
                                    <div class="row input-group justify-content-center py-2">
                                        <div class="col-md-10 col-12"><label class=" d-none" for="password">Password:</label><input aria-label="password" type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="Password" value="" required></div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 col-6">
                                            <input type="submit" name="loginBtn" id="loginBtn" tabindex="4" class="form-control btn btn-primary btn-login" value="<?php echo (!isset($_SESSION['email']))? "Login" : "Conferma" ?>">
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        </div>
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