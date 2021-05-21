<?php
    include '../includes/config.php';
    include '../includes/session.php';

    $iInschrijvingId = $_GET['inschrijving_id'];

    if (is_numeric($iInschrijvingId)) {
        $fetchResult = mysqli_query($mysqli, "SELECT * FROM inschrijvingen WHERE inschrijving_id = $iInschrijvingId");
        $result = mysqli_query($mysqli, "DELETE FROM inschrijvingen WHERE inschrijving_id = $iInschrijvingId");
        $row = mysqli_fetch_array($fetchResult);

        $plusPlek = + 1;
        $addResult = mysqli_query($mysqli, "UPDATE blokken SET plekken = plekken + $plusPlek WHERE blok_id = " . $row['blok_id']);
        echo $addResult;
        if ($result) {
            # Verwerkt -> ga terug naar overzicht
            header('Location:../index.php?signup=verwijderd');
            exit;
        } else {
            # Fout in query
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0" role="alert">Er ging iets mis met het verwijderen!</div>';
            exit;
        }
    } else {
        # Geen geldig id
        echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0" role="alert">Er ging iets mis, geen geldig id!</div>';
        exit;
    }

?>