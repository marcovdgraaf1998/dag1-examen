<?php
    include '../includes/config.php';
    include '../includes/session.php';

    $sGebruikersnaam = $_POST['gebruikersnaam'];
    $sWachtwoord = $_POST['wachtwoord'];

    if (strlen($sGebruikersnaam) > 0 && strlen($sWachtwoord) > 0) {
        $sWachtwoord = sha1($sWachtwoord);

        $query = "SELECT * FROM `gebruikers` WHERE gebruikersnaam = '$sGebruikersnaam' AND wachtwoord = '$sWachtwoord'";
        $result = mysqli_query($mysqli, $query);


        if (mysqli_num_rows($result) == 1) {
            $_SESSION['gebruikersnaam'] = $sGebruikersnaam;

            header('Location:./overzicht.php');
            exit;
        } else {
            header('Location:./index.php?login=failed');
            exit;
        }
    } else {
        header('Location:./index.php?login=empty');
        exit;
    }
?>