<?php

require_once("src/sessie.php");
$did = $_GET['id_dagboek'];
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
            <a class="nav-link" href="maakverhaal.php">Schrijf je Verhaal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active1" href="bibliotheek.php">Bibliotheek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="maakdagboek.php">Maak dagboek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mijngegevens.php">Bewerk account gegevens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="verwijder-account.php">Verwijder account</a>
          </li>
        </ul>
        <hr class="d-sm-none">
      </div>
      <div class="col-sm-9 text-left">
        <h1>Dagboek: <?php

                      $user = unserialize($_SESSION['gebruiker_data']);
                      //Pass POST variable

                      $diaries_data = $user->getDiaries();
                      foreach ($diaries_data as $diary_data) {
                        echo $diary_data['naam'];
                      } ?></h1>
        <hr>

        <div class="container">

          <a href="bibliotheek.php"><button type="button" class="btn btn-kleur">
              <---ga terug</button> </a> <a href="maakverhaal.php"><button type="button" class="btn btn-kleur">Nieuw verhaal</button></a>

          <br><br>

          <div class="row">

            <div class="col">

              <table class="table">

                <thead>

                  <tr>

                    <th scope="col">#</th>

                    <th scope="col">Datum</th>

                    <th scope="col">Bekijken</th>


                  </tr>

                </thead>

                <tbody>

                  <?php

                  //zet variable $a op 1 (zodat hij later kan optellen)

                  $a = 1;

                  //Foreach om door alle rows een loop te doen
                  $user = unserialize($_SESSION['gebruiker_data']);
                  //Pass POST variable

                  $stories_data = $user->getStories($did);
                  foreach ($stories_data as $story_data) {

                  ?>

                    <tr>

                      <td class="bold"><?php echo $a ?></td>

                      <td><?php echo $story_data['datum'] ?></td>

                      <td>

                        <form method="get" action="verhaal.php">

                          <input type="hidden" name="id_gebruiker" value="<?php echo $story_data['id_posts'] ?>">

                          <input type="hidden" name="id_dagboek" value="<?php echo $story_data['id_dagboek'] ?>">

                          <button class="btn btn-primary nav-kleur">Bekijk</button>

                        </form>

                      </td>



                    </tr>

                  <?php

                    $a++;
                  }

                  ?>

                </tbody>

              </table>

            </div>

          </div>

        </div>
      </div>
    </div>





</body>

</html>