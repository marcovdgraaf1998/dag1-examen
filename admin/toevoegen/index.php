<?php
    include '../../includes/session.php';

    if (isset($_GET['blok'])) {
        $blok = $_GET['blok'];

        if ($blok == 'empty') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft niet alle velden ingevuld! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'number') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft geen geldige cijfers ingevoerd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'char') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft geen tekstwaardes ingevoerd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        else if ($blok == 'char') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">De tijdstippen die u heeft ingevuld zijn te lang! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../includes/head.php'; ?>
    <title>Toevoegen Blok</title>
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    <div class="container">
        <div class="card mt-4 p-3">
            <div class="text-center mt-4">
                <h1>Een blok toevoegen</h1>
            </div>
            <form method="POST" action="./toevoegen.php">
                <div class="form-row mt-5">
                    <div class="form-group col-md-6">
                        <label for="plekken">Aantal plekken</label>
                        <input class="form-control" type="number" id="plekken" name="plekken" placeholder="100">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="naam">Datum</label>
                        <input type="date" class="form-control datepicker" name="datum" id="datum">
                    </div>
                </div>
                
                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <label for="start_tijd">Start tijd</label>
                        <input type="text" class="form-control" name="start_tijd" id="start_tijd" placeholder="12:00" maxlength="5">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="eind_tijd">Eind tijd</label>
                        <input type="text" class="form-control" name="eind_tijd" id="eind_tijd" placeholder="13:30" maxlength="5">
                    </div>
                </div>
                
                <div class="form-check col-md-6">
                    <input class="form-check-input" type="checkbox" id="zichtbaar" name="zichtbaar" value="0">
                    <label class="form-check-label"for="zichtbaar">Zichtbaar</label>
                </div>
                <div class="d-flex justify-content-between mt-5">
                    <a href="../overzicht.php">Terug naar overzicht</a>
                    <input type="submit" class="btn btn-primary form-control w-25" value="Inschrijven" name="submit" id="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>