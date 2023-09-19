<?php
session_start();

require_once '../src/class.php';
$user = new Gebruikers();
$post = $_POST;
$firstname = $post['voornaam'];
$insertionss = $post['tussenvoegsel'];
$lastname = $post['achternaam'];
$email = $post['email'];
$password = $post['wachtwoord'];
$password2 = $post['wachtwoord2'];
// validatie checker
if (isset($_POST['submit'])) {

    //check voornaam
    if (!empty($firstname)) {
        $firstname_subject = $firstname;
        $firstname_pattern = '/^[a-zA-Z ]*$/';
        $firstname_match = preg_match($firstname_pattern, $firstname_subject);
        if ($firstname_match !== 1) {
            $error[] = "Voornaam mag alleen alfabetisch, steepjes en spaties bevatten";
        }
    } else {
        // mag niet leeg zijn
        $error[] = "Voornaam mag niet leeg.";
    }

    //check achternaam
    if (!empty($lastname)) {
        $lastname_subject = $lastname;
        $lastname_pattern = '/^[a-zA-Z ]*$/';
        $lastname_match = preg_match($lastname_pattern, $lastname_subject);
        if ($lastname_match !== 1) {
            $error[] = "Achternaam mag alleen alfabetisch, steepjes en spaties bevatten";
        }
    } else {
        // mag niet leeg zijn
        $error[] = "Achternaam mag niet leeg.";
    }

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
    } else {
        // mag niet leeg zijn
        $error[] = "Wachtwoord mag niet leeg.";
    }
    
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $error[] = 'Wachtwoord moet ten minste 8 tekens lang zijn en moet ten minste één hoofdletter, één cijfer en één speciaal teken bevatten.';
    }
    if ($firstname_match !== true && $lastname_match !== true && $email_match !== true  && $password !== $password2) {
        $error[] = "De wachtwoorden komen niet overeen.";
    }

    if (isset($error)) {
        $_SESSION['ERRORS'] = implode('<br> ', $error);
        header('Location:../registreer.php');
    } else {
        $user->create($firstname, $insertionss, $lastname, $email, $password, $password2);
        header('Location:../login.php');
    }
}
