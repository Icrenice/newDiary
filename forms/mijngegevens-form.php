<?php

require_once('../src/class.php');
//Maak nieuwe sessie
session_start();
//Roep nieuwe gebruikers class op
$user = new Gebruikers();
//zet POST values in variablen
$firstname = $_POST['voornaam'];
$insertionss = $_POST['tussenvoegsels'];
$lastname = $_POST['achternaam'];
$email = $_POST['email'];
$oldpassword = $_POST['oudwachtwoord'];
$password = $_POST['nww1'];
$password2 = $_POST['nww2'];
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
    }

    //check achternaam
    if (!empty($lastname)) {
        $lastname_subject = $lastname;
        $lastname_pattern = '/^[a-zA-Z ]*$/';
        $lastname_match = preg_match($lastname_pattern, $lastname_subject);
        if ($lastname_match !== 1) {
            $error[] = "Achternaam mag alleen alfabetisch, steepjes en spaties bevatten";
        }
    }

    //check email
    if (!empty($email)) {
        $email_subject = $email;
        $email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
        $email_match = preg_match($email_pattern, $email_subject);
        if ($email_match !== 1) {
            $error[] = "Email moet een @ bevatten dus: example@ex.com";
        }
    }

    // wachtwoord validatie
    if (!empty($oldpassword)) {
        $uppercase = preg_match('@[A-Z]@', $oldpassword);
        $lowercase = preg_match('@[a-z]@', $oldpassword);
        $number    = preg_match('@[0-9]@', $oldpassword);
        $specialChars = preg_match('@[^\w]@', $oldpassword);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($oldpassword) < 8) {
            $error[] = 'Wachtwoord moet ten minste 8 tekens lang zijn en moet ten minste één hoofdletter, één cijfer en één speciaal teken bevatten.';
        }
    } else {
        // mag niet leeg zijn
        $error[] = "Wachtwoord mag niet leeg.";
    }
    if ($password !== $password2) {
        $error[] = "De nieuwe wachtwoorden komen niet overeen.";
    }
    //Zet variablen op NULL voor isset check
    if (empty($email)) {
        $email = NULL;
    }

    if (empty($password)) {
        $password = NULL;
    }
    // wachtwoord validatie
    if (!empty($password)) {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $error[] = 'Nieuwe wachtwoord moet ten minste 8 tekens lang zijn en moet ten minste één hoofdletter, één cijfer en één speciaal teken bevatten.';
        }
    }
    if (isset($error)) {
        $_SESSION['ERRORS'] = implode('<br> ', $error);
        echo $_SESSION['ERRORS'];
        header('Location:../mijngegevens.php');
    } else {
        $update = $user->update($firstname, $insertionss, $lastname, $email, $oldpassword, $password);
        if (is_bool($update)) {
            //Check of identiek is
            if (isset($email) && ($email == $email)) {
                //update voor nieuwe email
                $updateUser = $user->update($firstname, $insertionss, $lastname, $email, $oldpassword, $password);
                header('Location: ../login.php');
                session_destroy();
            }
            //Check of identiek is
            if (isset($password) && ($password == $password2)) {
                //Update voor nieuw wachtwoord
                $updateUser = $user->update($firstname, $insertionss, $lastname, $email, $oldpassword, $password);
                header('Location: ../login.php');
                session_destroy();
            }
            //Voer ook uit als geen nieuw wachtwoord of email zijn ingevoerd
            $updateUser = $user->update($firstname, $insertionss, $lastname, $email, $oldpassword, $password);
            //Volgende locatie
            header('Location: ../login.php');
            session_destroy();
        } elseif (is_string($update)) {
            $_SESSION['ERRORS'] = $update;
            header('Location: ../mijngegevens.php');
        }
    }
}
