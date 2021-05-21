<?php
    include '../../includes/config.php';
    include '../../includes/session.php';

    # Pak goede blok_id
    $iBlokId = $_GET['blok_id'];

    if (is_numeric($iBlokId)) {
        # Fetch velden met juiste id
        $query = mysqli_query($mysqli, "SELECT * FROM blokken WHERE blok_id = $iBlokId");

        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
        } else {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">Er is wat misgegaan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            exit;
        }
    }
    else {
        echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">Er is wat misgegaan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        exit;
    }

    $result = mysqli_query($mysqli, "SELECT * FROM blokken WHERE blok_id = $iBlokId");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../includes/head.php'?>
    <title>Aanpassen blok <?= $iBlokId?></title>
</head>
<body>
    <?php include '../../includes/header.php';
    
    # Meldingen bij errors etc.
    if (isset($_GET['blok'])) {
		$blok = $_GET['blok'];

        if ($blok == 'empty') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft niet alle velden ingevuld! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'number') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft geen geldige cijfers ingevoerd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'char') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft geen tekstwaardes ingevoerd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'long') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">De tijdstippen die u heeft ingevuld zijn te lang! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }
    ?>
    
    <div class="container">
        <div class="card mt-4 p-3">
            <div class="text-center mt-4">
                <h1>Blok <?= $iBlokId ?> aanpassen</h1>
            </div>
            <?php while($row = mysqli_fetch_array($result)) : ?>
                <form method="POST" action="./aanpassen.php">
                    <input type="hidden" name="blok_id" id="blok_id" value="<?= $row['blok_id'] ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lid">Aantal plekken</label>
                            <input class="form-control" type="number" id="plekken" name="plekken" value="<?= $row['plekken']?>">
                        </div>
                            <div class="form-group col-md-6">
                                <label for="naam">Datum</label>
                                <input type="date" class="form-control" name="datum" id="datum" value="<?= $row['datum']?>">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class="form-group col-md-6">
                            <label for="start_tijd">Start tijd</label>
                            <input type="text" class="form-control" name="start_tijd" id="start_tijd" value="<?= $row['start_tijd']?>" maxlength="5">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="eind_tijd">Eind tijd</label>
                            <input type="text" class="form-control" name="eind_tijd" id="eind_tijd" value="<?= $row['eind_tijd']?>" maxlength="5">
                        </div>
                    </div>
                    <div class="form-check col-md-6">
                        <input class="form-check-input" type="checkbox" id="zichtbaar" name="zichtbaar" <?php if($row['zichtbaar'] == 1) {echo 'checked';} ?> value="0">
                        <label class="form-check-label"for="zichtbaar">Zichtbaar</label>
                    </div>
                    <div class="d-flex justify-content-between mt-5">
                        <a href="../overzicht.php">Terug naar overzicht</a>
                        <input type="submit" class="btn btn-warning form-control w-25" value="Aanpassen" name="submit" id="submit">
                    </div>
                </form>
            <?php endwhile ?>
        </div>
    </div>
</body>
</html>