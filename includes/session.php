<?php
    session_start();

    if (!isset($_SESSION['gebruikersnaam'])) {
        header('Location: ../admin/index.php');
    }

?>