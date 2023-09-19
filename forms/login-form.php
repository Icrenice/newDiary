<?php
require_once('../src/class.php');
//start sessie
session_start();
//Maak nieuw Dagboek
$user = new Dagboeken();
//passed post variables
$email = $_POST['email'];
$password = $_POST['wachtwoord'];
//filter emails naar lowerstring
$email = strtolower($email);
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
        header('Location:../login.php');
    } else {
        $loggedin = $user->login($email, $password);
        if (is_bool($loggedin)) {
            //Zet user values in sessie
            $_SESSION['gebruiker_data'] = serialize($user);
            header('Location: ../welkom.php');
        } elseif (is_string($loggedin)) {
            $_SESSION['ERRORS'] = $loggedin;
            header('Location: ../login.php');
        }
    }
}
