<?php
    $iBlokId = $_POST['blok_id'];
    $sDatum = $_POST['datum'];
    $sStartTijd = $_POST['start_tijd'];
    $sEindTijd = $_POST['eind_tijd'];
    $iPlekken = $_POST['plekken'];

    if (isset($_GET['signup'])) {
        $signupCheck = $_GET['signup'];

        if ($signupCheck == 'empty') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0" role="alert">Niet alle velden zijn ingevuld! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($signupCheck == 'char') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0" role="alert">U heeft geen geldige tekens ingevoerd bij de tekstvelden! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($signupCheck == 'number') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0" role="alert">U heeft geen nummers ingevoerd bij de nummervelden! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($signupCheck == 'email') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0" role="alert">U heeft geen geldige email ingevoerd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($signupCheck == 'success') {
            echo '<div class="alert alert-success text-center mb-0 border-0 rounded-0" role="alert">U bent ingeschreven! U heeft een bevestiging via de mail gekregen. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Inschrijven blok <?= $iBlokId ?></title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <div class="card mt-4 p-3">
            <div class="mt-4">
                <h1>Inschrijven voor blok <?= $iBlokId ?></h1>
                <h5>Datum: <?= $sDatum ?> <span>om <?= $sStartTijd ?> - <?= $sEindTijd ?></span></h5>
                <p>Er <?php if($iPlekken > 1) {echo 'zijn';} else {echo 'is';} ?> nog <strong><?= $iPlekken ?> </strong> <?php if($iPlekken > 1) {echo 'plekken';} else {echo 'plek';} ?> beschikbaar</p>
            </div>
            <form class="my-3"method="POST" action="./inschrijven.php">
                <input type="hidden" name="blok_id" id="blok_id" value="<?= $iBlokId ?>">
                <input type="hidden" name="datum" id="datum" value="<?= $sDatum ?>">
                <input type="hidden" name="start_tijd" id="start_tijd" value="<?= $sStartTijd ?>">
                <input type="hidden" name="eind_tijd" id="eind_tijd" value="<?= $sEindTijd ?>">
                <input type="hidden" name="plekken" id="plekken" value="<?= $iPlekken ?>">
                <div class="form-group">
                    <label for="naam">Naam</label>
                    <input type="text" class="form-control" name="naam" id="naam">
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-6">
                        <label for="adres">Adres</label>
                        <input type="text" class="form-control" name="adres" id="adres">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="plaats">Plaats</label>
                        <input type="text" class="form-control" name="plaats" id="plaats">
                    </div>
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-6">
                        <label for="telefoonnummer">Telefoonnummer</label>
                        <input type="number" class="form-control" name="telefoonnummer" id="telefoonnummer">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Emailadres</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="lid" name="lid" value="0">
                    <label class="form-check-label" for="lid">
                        Ik ben een lid (geen leden dienen bij toegang te betalen).
                    </label>
                </div>
                <div class="d-flex justify-content-between mt-5">
                    <a href="../index.php">Terug naar overzicht</a>
                    <input type="submit" class="btn btn-primary form-control w-25" value="Inschrijven" name="submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>