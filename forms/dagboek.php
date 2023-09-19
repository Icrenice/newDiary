<?php
//start sessie
session_start();
//Roep class file op
require_once '../src/class.php';
//Zet titel in variable naam
$name = $_POST['titel'];
//Pak sessie data uit
$user = unserialize($_SESSION['gebruiker_data']);
//Zet id in user id
$user_id = $user->id;
//Voer uit als titel een waarde heeft
if (isset($_POST['titel'])) {
    //Roep class op
    $setDagboek = new Dagboeken();
    //Voer functie uit
    $setDagboek->setDiary($name, $user_id);
    //Volgende locatie
    header('Location: ../bibliotheek.php');
}
