<?php
    $iBlokId = $_POST['blok_id'];
    $sDatum = $_POST['datum'];
    $sStartTijd = $_POST['start_tijd'];
    $sEindTijd = $_POST['eind_tijd'];
    $iPlekken = $_POST['plekken'];

    if (isset($_GET['signup'])) {
        $signupCheck = $_GET['signup'];

        if ($signupCheck == 'empty') {
            echo '<div class="alert alert-danger text-center" role="alert">Niet alle velden zijn ingevuld!</div>';
        } else if ($signupCheck == 'char') {
            echo '<div class="alert alert-danger text-center" role="alert">U heeft geen geldige tekens ingevoerd bij de tekstvelden!</div>';
        } else if ($signupCheck == 'number') {
            echo '<div class="alert alert-danger text-center" role="alert">U heeft geen nummers ingevoerd bij de nummervelden!</div>';
        } else if ($signupCheck == 'email') {
            echo '<div class="alert alert-danger text-center" role="alert">U heeft geen geldige email ingevoerd</div>';
        } else if ($signupCheck == 'success') {
            echo '<div class="alert alert-success text-center" role="alert">Uw bent ingeschreven! U heeft een bevestiging via de mail gekregen.</div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
		include '../includes/header.php';
	?>
    <title>Inschrijven blok <?= $iBlokId ?></title>
</head>
<body>
<div class="container">
    <div class="text-center mt-4">
        <h1>Inschrijven voor blok <?= $iBlokId ?></h1>
    </div>
    <form method="POST" action="./inschrijven.php">
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
        <div class="buttons mt-3">
            <a href="../index.php">Terug naar overzicht</a>
            <input type="submit" class="btn btn-primary form-control col-3 float-right" value="Inschrijven" name="submit" id="submit">
        </div>
    </form>
</div>
</body>
</html>