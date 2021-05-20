<?php
    include '../../includes/config.php';
    include '../../includes/session.php';

    $iBlokId = $_GET['blok_id'];

    if (is_numeric($iBlokId)) {
        $result = mysqli_query($mysqli, "DELETE FROM blokken WHERE blok_id = $iBlokId");

        if ($result) {
            # Verwerkt -> ga terug naar overzicht
            header('Location:../overzicht.php?blok=verwijderd&blok_id=' . $iBlokId);
            exit;
        } else {
            # Fout in query
            echo '<div class="alert alert-danger text-center" role="alert">Er ging iets mis met het verwijderen!</div>';
            exit;
        }
    } else {
        # Geen geldig id
        echo '<div class="alert alert-danger text-center" role="alert">Er ging iets mis, geen geldig id!</div>';
        exit;
    }
?>