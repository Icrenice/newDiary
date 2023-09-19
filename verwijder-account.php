<?php
require_once("src/sessie.php");

require_once("src/class.php");
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

  <script src="js/niceEdit.js" type="text/javascript"></script>
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

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 col-sm-3-1">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link " href="maakverhaal.php">Schrijf je Verhaal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="bibliotheek.php">Bibliotheek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="maakdagboek.php">Maak dagboek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="mijngegevens.php">Bewerk account gegevens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active1" href="verwijder-account.php">Verwijder account</a>
          </li>
        </ul>
        <hr class="d-sm-none">
      </div>
      <div class="col-sm-9 text-left">
        <h1>Verwijder hier jouw account</h1>
        <hr>
        <form class="form-login" method="post" id="login-form" action="forms/verwijderaccount.php">

          <h2 class="form-login-hoofdtekst">Verwijder hier jouw account</h2>
          <hr />

          <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="E-mail"  />

          </div>

          <div class="form-group">
            <input type="password" class="form-control" name="wachtwoord" placeholder="wachtwoord" />

          </div>

          <hr />
          <?php

          if (isset($_SESSION['ERRORS'])) {
            echo $_SESSION['ERRORS'];
            unset($_SESSION{
            'ERRORS'});
          }
          ?>

          <div class="flex">
            <button type="submit" name="submit" class="btn btn-outline-danger" onclick="return confirm('Weet u het zeker?')">Verwijder account</button>

        </div>
        </form>
      </div>
    </div>
</body>

</html>