<!doctype html>
<html lang="it">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css" integrity="sha512-3q8fi8M0VS+X/3n64Ndpp6Bit7oXSiyCnzmlx6IDBLGlY5euFySyJ46RUlqIVs0DPCGOypqP8IRk/EyPvU28mQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/order.css?ts=<?=time()?>&quot">
    <title>PoPazon</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="col-12 py-3 text-white bg-dark">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top p-0">
            <div class="container-fluid">
                <div class="col-4 p-0" align-left>
                    <a class="navbar-brand" href="<?php echo isset($templateParams["venditore"]) ? "homeVenditore.php" : "index.php"; ?>">
                        <h1>PoPazon</h1>
                    </a>
                </div>
                <div class="col-4">
                    <?php if (!isset($templateParams["venditore"])) : ?>
                        <form action="../php/search-bar-result.php" method="get">
                            <label for="search" class="d-none">ricerca</label>
                            <input class="form-control" type="text" placeholder="Cerca" id = "search" aria-label="Search" name="search-text" />
                        </form>
                    <?php endif ?>
                    <?php if ($templateParams["nome"] == "template/visualizzaProdottiVenditore.php") : ?>
                        <label for="searchAdmin" class="d-none">ricerca</label>
                        <input id="searchAdmin" name="searchAdmin" class="form-control mr-sm-2 text-center w-100" type="search" placeholder="Search" aria-label="Search"/>
                    <?php endif; ?>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <?php if (isset($_SESSION['email'])) : ?>
                            <li class="nav-item"> <a class="nav-link" href="profile.php">Profilo</a></li>
                            <li class="nav-item"> <a class="nav-link" href="notifiche.php">Notifiche<span class="badge badge-primary badge-pill"></span></a></li>
                        <?php else : ?>
                            <li class="nav-item"> <a class="nav-link" href="login.php?action=1">Login</a></li>
                            <li class="nav-item"> <a class="nav-link" href="register.php?action=1">Sign-up</a></li>
                        <?php endif; ?>
                        <?php if (!isset($templateParams["venditore"])) : ?>
                            <li class="nav-item"> <a class="nav-link" href="carrello.php">Carrello</a> </li>
                        <?php endif?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php if (!isset($templateParams["venditore"])) : ?>
            <div class="col-12">
                <ul class="nav">
                    <li class="nav-item col-6 text-right">
                        <a class="nav-link text-black" href="inStock.php">In Stock</a>
                    </li>
                    <li class="nav-item col-6 text-left">
                        <a class="nav-link text-black" href="exclusive.php">Exclusive</a>
                    </li>
                </ul>
            </div>
        <?php endif ?>
    </header>
    <main>
        <div class="container-fluid m-0">
            <?php require($templateParams["nome"]); ?>
        </div>
    </main>
    <footer class="col-12 text-white bg-dark page-footer font-small blue pt-4 mt-auto">
        <div class="container-fluid">
            <div class="row">
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-4"></div>
                <div class="col-md-2 mb-md-0 mb-3">
                    <h5>Informazioni</h5>
                    <ul class="list-unstyled ">
                        <li>
                            <a href="informazioni.php#chiSiamo">Chi siamo</a>
                        </li>
                        <li>
                            <a href="informazioni.php#contatti">Contatti</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-2 mb-md-0 mb-3">
                    <h5>Informazioni Legali</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="informazioni.php#cookie">Cookie</a>
                        </li>
                        <li>
                            <a href="informazioni.php#privacy">Informativa sulla Privacy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div class="footer-copyright text-center py-3">© 2020 Copyright</div>
    </footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous"></script>

    <script src="js/notifiche.js"></script>

    <?php
    if (isset($templateParams["js"])) :
        foreach ($templateParams["js"] as $script) :
    ?>
            <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
    <?php
    if (isset($templateParams["icon"])) :
        foreach ($templateParams["icon"] as $script) :
    ?>
            <script <?php echo $script; ?>></script>
    <?php
        endforeach;
    endif;
    ?>
</body>

</html>