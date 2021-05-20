<?php
    include '../includes/config.php';
    include '../includes/session.php';

    $query = mysqli_query($mysqli, "SELECT * FROM blokken");
    $queryInschrijvingen = mysqli_query($mysqli, "SELECT * FROM inschrijvingen ORDER BY inschrijving_id ASC");
    
	$sGebruikersnaam = $_SESSION['gebruikersnaam'];

	if (isset($_GET['blok'])) {
		$blok = $_GET['blok'];
		$iBlokId = $_GET['blok_id'];

        if ($blok == 'success') {
            echo '<div class="alert alert-success text-center" role="alert">U heeft een nieuw blok toegevoegd!</div>';
        } else if ($blok == 'failed') {
            echo '<div class="alert alert-danger text-center" role="alert">Het toevoegen van een nieuw blok is mislukt!</div>';
        } else if ($blok == 'verwijderd') {
			echo '<div class="alert alert-warning text-center" role="alert">U heeft blok ' . $iBlokId . ' verwijderd</div>';
		} else if ($blok == 'aangepast') {
			echo '<div class="alert alert-warning text-center" role="alert">U heeft blok ' . $iBlokId . ' aangepast</div>';
		} else if ($blok == 'aangepastFout') {
			echo '<div class="alert alert-danger text-center" role="alert">Er ging wat fout met aanpassen!</div>';
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
		include '../includes/header.php';
	?>
	<title>Admin overzicht</title>
<body>
    <div class="container">
    <div class="text-center card mt-4 p-3">
        <h1>Welkom <?= $sGebruikersnaam ?></h1>
		<p>Hier kunt alle blokken beheren en inschrijven inzien.</p>
        <a class="p-3" href="../includes/logout.php">Uitloggen</a>
    </div>
		<div class="card mt-4 p-3">
			<div class="d-flex justify-content-between align-items-center">
				<h4 class="p-3">Blokken</h4>
				<a href="./toevoegen/index.php" class="btn btn-primary">Blok toevoegen</a>
			</div>
			<div class="table-responsive">
				<table class="table table-hover" cellspacing="0">
					<tr>
						<th>Blok</th>
						<th>Datum</th>
						<th>Van</th>
						<th>Tot</th>
						<th>Plekken over</th>
						<th>Zichtbaar</th>
						<th></th>
						<th></th>
					</tr>
						<?php while ($row = mysqli_fetch_array($query)) : ?>
						<tr>
							<td><?= $row['blok_id'] ?></td>
							<td><?= $row['datum'] ?></td>
							<td><?= $row['start_tijd'] ?></td>
							<td><?= $row['eind_tijd'] ?></td>
							<td><?php if($row['plekken'] < 1) { echo '<p class="text-danger">Vol</p>';} else {echo $row['plekken'];} ?></td>
							<td><?php if($row['zichtbaar'] == 1) {echo 'Ja';} else {echo 'Nee';} ?></td>
							<td><a <?php if($row['plekken'] < 1) echo 'disabled' ?> name="aanpassen" href="./aanpassen/index.php?blok_id=<?= $row['blok_id']; ?>"><i class="fas fa-edit text-warning"></i></a></td>
							<td><a <?php if($row['plekken'] < 1) echo 'disabled' ?> name="verwijderen" href="./verwijderen/index.php?blok_id=<?= $row['blok_id']; ?>"><i class="fas fa-trash text-danger"></i></a></td>
						</tr>
					<?php endwhile ?>
				</table>
			</div>
		</div>
		<div class="card mt-4 p-3">
			<h4 class="p-3">Inschrijvingen</h4>
			<div class="table-responsive table-hover">
				<table class="table" cellspacing="0">
					<tr>
						<th>Blok</th>
						<th>Naam</th>
						<th>Adres</th>
						<th>Plaats</th>
						<th>Telefoon</th>
						<th>Emailadres</th>
						<th>Lid</th>
					</tr>
						<?php while ($row = mysqli_fetch_array($queryInschrijvingen)) : ?>
						<tr>
							<td><?= $row['blok_id'] ?></td>
							<td><?= $row['naam'] ?></td>
							<td><?= $row['adres'] ?></td>
							<td><?= $row['plaats'] ?></td>
							<td><?= $row['telefoonnummer'] ?></td>
							<td><?= $row['email'] ?></td>
							<td><?php if ($row['lid'] == 0) {echo 'Nee';} else { echo 'Ja';} ?></td>
						</tr>
					<?php endwhile ?>
				</table>
			</div>
		</div>
    </div>
</body>
</html>