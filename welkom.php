<?php

require_once("src/sessie.php");

require_once("src/class.php");
$user = unserialize($_SESSION['gebruiker_data']);
?>
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
        <script src="js/opentab.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
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
                        <a class="nav-link" href="src/logout.php?logout=true"><img src="image/person.png">Loguit</a>
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
        <!-- roept de functie vng aan voor gebruikers naam -->
        <h2 class="welkom" style="margin-top: 20px; margin-bottom: 40px;">Welkom
            <?php echo $user->firstname . " " . $user->insertions . " " . $user->lastname; ?>
        </h2>

        <div class="row1">
            <div class="column">
                <a href="maakverhaal.php">
                    <div class="card">
                        <img src="image/maakdagboek.png" width="100px" class="minifoto">
                        <h4><strong>Verhaal van de dag</strong></h4>
                        <p></p>
                        <p>Schrijf je verhaal Hier</p>
                    </div>
                </a>
            </div>

            <div class="column">
                <a href="maakdagboek.php">
                    <div class="card">
                        <img src="image/bewerkdagboek.png" width="100px" class="minifoto">
                        <h4><strong>Maak hier je dagboeken</strong></h4>
                        <p></p>
                        <p>Maak hier jouw dagboeken</p>
                    </div>
                </a>
            </div>

            <div class="column">
                <a href="mijngegevens.php">
                    <div class="card">
                        <img src="image/accountsettings.png" width="100px" class="minifoto">
                        <h4><strong>Bewerk account gegevens</strong></h3>
                            <p></p>
                            <p>Bewerk hier jouw account gegevens</p>
                    </div>
                </a>
            </div>

            <div class="column">
                <a href="verwijder-account.php">
                    <div class="card">
                        <img src="image/account-verwijder.png" width="100px" class="minifoto">
                        <h4><strong>Verwijder Dagboek/Verhaal</strong></h4>
                        <p></p>
                        <p>Verwijder hier jouw dagboeken</p>
                    </div>
                </a>
            </div>

        </div>

        <div class="row2">

            <div class="column2 card midden" onclick="openTab('b2');" style="background:#113042; margin-top: 40px;">
                <img src="image/bibliotheek.png" width="100px" class="minifoto">
                <h4><strong>Bibliotheek</strong></h4>

            </div>

        </div>
        <!-- Full-width columns: (hidden by default) -->
        <div id="b2" class="containerTab" style="display:none;background:#113042;">
            <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
            <h2>Bibliotheek</h2>
            <p>Ga nu jouw bibliotheek in en ontdek door jouw verzonnen verhalen. In de bibliotheek heb alleen jij het recht om jouw verhalen te bekijken. <a class=".kleur" style="float: right;" href="bibliotheek.php">Ga nu naar jouw bibliotheek</a> </p>
        </div>
    </body>

    </html>