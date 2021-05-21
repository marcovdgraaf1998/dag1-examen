<?php
    $iInschrijvingId = $_GET['inschrijving_id'];

    echo $iInschrijvingId;

    $query = "SELECT * FROM inschrijvingen WHERE inschrijving_id = $iInschrijvingId";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'?>
    <title>Ingeschreven</title>
</head>
<body>
    <?php include '../includes/includes/header.php'; ?>
    <div class="container">
        <div class="card text-center p-3 mt-5">
            <h3>U bent al ingeschreven voor een blok!</h3>
            <p>U kunt uw blok verwijderen en inschrijven voor een nieuwe of annuleren.</p>
            <div class="d-flex p-4 align-items-center justify-content-center">
                <a href="../index.php">Terug</a>
                <a href="./verwijderen.php?inschrijving_id=<?= $iInschrijvingId ?>" class="btn btn-danger ml-5">Uitschrijven</a>
            </div>
        </div>
    </div>
</body>
</html>