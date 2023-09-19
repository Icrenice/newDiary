<?php
//Sessie starten
session_start();
//Roep class bestand op
require_once '../src/class.php';
//Pak sessie data uit
$user = unserialize($_SESSION['gebruiker_data']);
//Pass POST variable
$posts = $_POST['posts'];
$diaryid = $_POST['dagboekid'];

// checkt of dagboeken leegzijn
$diaries_data = $user->getDiaries();
if (empty($diaries_data)) {
  header('Location: ../maakverhaal.php');
}

//Zet sessie id in user id
$user_id = $user->id;

if (isset($posts, $diaryid)) {
  //Roep nieuwe gebruikers class op
  $story = new Dagboeken();
  //Zet datum
  $date = date('Y-m-d');
  //Voer verhaal functie uit
  $story->setStory($diaryid, $posts, $date);
  // stuurt je naar bibliotheek
  header('Location: ../bibliotheek.php');
}
