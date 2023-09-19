<?php
//Laad class bestand
require_once('../src/class.php');
//Start sessie
session_start();
//Pak sessie data uit
$user = unserialize($_SESSION['gebruiker_data']);
//Zet sessie id in user id
$user_id = $user->id;
//Roep delete functie op
$email = $_POST['email'];
$password = $_POST['wachtwoord'];
// validatie checker
if (isset($_POST['submit'])) {

    //check email
    if (!empty($email)) {
        $email_subject = $email;
        $email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
        $email_match = preg_match($email_pattern, $email_subject);
        if ($email_match !== 1) {
            $error[] = "Email moet een @ bevatten dus: example@ex.com";
        }
    } else {
        // mag niet leeg zijn
        $error[] = "Email mag niet leeg.";
    }
    // wachtwoord validatie
    if (!empty($password)) {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $error[] = 'Wachtwoord moet ten minste 8 tekens lang zijn en moet ten minste één hoofdletter, één cijfer en één speciaal teken bevatten.';
        }
    } else {
        // mag niet leeg zijn
        $error[] = "Wachtwoord mag niet leeg.";
    }

    if (isset($error)) {
        $_SESSION['ERRORS'] = implode('<br> ', $error);
        var_dump($_SESSION['ERRORS']);
        header('Location:../verwijder-account.php');
    } else {
        $delete = $user->delete($user_id, $email, $password);
        if (is_bool($delete)) {
                // terug naar begin pagina
                header('Location: ../MijnPersoonlijkeDagboek.php');
        } 
        elseif (is_string($delete)) {
            $_SESSION['ERRORS'] = $delete;
            header('Location: ../verwijder-account.php');
        }
    }
}