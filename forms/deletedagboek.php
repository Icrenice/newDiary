<?php
//Start sessie
session_start();
//Roep class bestand op
require_once '../src/class.php';
//Zet POST value in variable
$diaryid = $_POST['id_dagboek'];
//Pak sessie data uit
$user = unserialize($_SESSION['gebruiker_data']);
//Zet sessie id in variable
$user_id = $user->id;
//Roep dagboeken class op
$diary = new Dagboeken();
//Voer deletedagboek functie uit
$diary->deleteDiary($diaryid, $user_id);
//volgende pagina
header("Location: ../bibliotheek.php");
