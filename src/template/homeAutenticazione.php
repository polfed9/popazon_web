<div class="row justify-content-center py-5">
    <div class="col-md-10 col-12">
        <div class="card card-body text-center shadow">
            <?php 
                if(!isset($_SESSION['email'])):
            ?>
            <h2>Benvenuto!</h2>
            <div class="row justify-content-center py-3 ">
                <div class="col-5 col-md-3 mr-2">
                    <div class="card  shadow" >
                    <a href="login.php?action=1" class="btn btn-light">
                            <img class="card-img-top img-fluid" src="<?php echo UPLOAD_DIR;?>icone/accedi.png" alt="card image accedi"/>
                        </a>
                        <h5 class="card-title">Login</h5>

                    </div>
                </div>
                <div class="col-5 col-md-3">
                    <div class="card shadow no-border ">
                        <a href="register.php?action=1"  class="btn btn-light">
                            <img class="card-img-top img-fluid" src="<?php echo UPLOAD_DIR;?>icone/registrati.png" alt="card image registrati"/>
                        </a>
                        <h5 class="card-title">SignUp</h5>

                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php if(!isset($templateParams["venditore"])):?>
                <h2>Buoni Acquisti!</h2>
            <?php endif; ?>
            <div id="usr">
                <p>Sei loggato come <?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?> </p>
                <p><a href="logout.php">Logout</a></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
       