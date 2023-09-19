<?php require_once "src/class.php"
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

        <li class="nav-item"><?php
                              session_start();
                              if (isset($_SESSION['gebruiker_data'])) {
                                echo ' <a class="nav-link" href="src/logout.php?logout=true"><img src="image/person.png">Loguit</a>';
                              } else {
                                echo '<a class="nav-link" href="login.php"><img src="image/person.png">Login</a>';
                              } ?>

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


  <div class="container-fluid text-center">
    <div class="row content">
      <div class="col-sm-3">
        <h3>Over MijnPersoonlijkeDagboek</h3>
        <h5>Foto van mijn dagboek :) :</h5>
        <p><img class="webpfoto" width="95%" src="image/dagboek.png"></p>
        <div class="dagboek">
        <p class="text-left">Ik vond het altijd leuk om elke dag in mijn dagboek te schrijven en ik hou ook veel van reizen. Alleen was het erg onhandig om elke keer mijn dagboek overal mee naar toe te nemen. Daarom bedacht ik dat ik mijn dagboek online kan zetten. Nu hoef ik mijn dachtboek niet meer overal mee naar toe te nemen. Natuurlijk wou ik wel dat het veilig is en dat alleen ik erin kan lezen.</p>
        <hr class="d-sm-none"></div>
      </div>
      <div class="col-sm-9 col-sm-9-kleur text-left">
        <h1>Welkom</h1>
        <p>Wij verwelkomen je graag op onze website. Op deze website kan jij je persoonlijke dagboek bijhouden die je op elk moment kan bewerken en verwijderen. Verder kan je hier ook een gloed nieuwe dagboek aanmaken. Al jouw dagboeken woorden persoonlijk beveiligd en alleen jij heb daar authoriteit op. Dus waar wacht je nog op <strong>Maak nu een account en begin met schrijven</strong>.</p>
        <hr>
        <h3></h3>
        <p><img class="webpfoto" width="95%" src="image/dagboek3.webp"></p>
      </div>
    </div>
  </div>

</body>

</html>