<?php session_start(); ?>
<html>

<head>
    <meta content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mijn Persoonlijke Dagboek</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" />

    <script src="js/nicEdit.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg nav-kleur">
        <a class="navbar-brand" href="MijnPersoonlijkeDagboek.php">
            <img src="image/mpderic1.png" width="100" height="100" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="welkom.php">Thuis <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="login.php"><img src="image/person.png">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="image/mininav.png">Mininav
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="maakverhaal.php">Schrijf je verhaal</a>
                        <a class="dropdown-item" href="bibliotheek.php">Bibliotheek</a>
                        <a class="dropdown-item" href="maakdagboek.php">Maak dagboek</a>
                        <a class="dropdown-item" href="mijngegevens.php">Bewerk account gegevens</a>
                        <a class="dropdown-item" href="verwijder-account.php">Verwijder account</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <div class="login-form">

        <div class="container">

            <h2 class="form-hoofdtekst">Mijn Persoonlijke Dagboek</h2>
            <br>

            <form class="form-login" method="post" id="regristreer-form" action="forms/regristreer-form.php">

                <h2 class="form-login-hoofdtekst">Registreer</h2>
                <hr />

                <div class="form-group">
                    <input type="text" class="form-control" name="voornaam" placeholder="Voornaam" />

                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="tussenvoegsel" placeholder="Tussenvoegsel" />

                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="achternaam" placeholder="Achternaam" />

                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="E-Mail" />

                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" />

                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="wachtwoord2" placeholder="Wachtwoord Bevestigen" />

                </div>
                <hr />
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-outline-secondary">Registreer</button>
                </div>
                <?php

                if (isset($_SESSION['ERRORS'])) {
                    echo $_SESSION['ERRORS'];
                    unset($_SESSION{'ERRORS'});
                }
                ?>
                <br>


                <a href="login.php">Al een account?</a>
            </form>

        </div>


    </div>

</body>

</html>