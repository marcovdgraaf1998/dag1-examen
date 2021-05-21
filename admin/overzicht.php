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
            echo '<div class="alert alert-success text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft een nieuw blok toegevoegd! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'failed') {
            echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">Het toevoegen van een nieuw blok is mislukt! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else if ($blok == 'verwijderd') {
			echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft blok ' . $iBlokId . ' verwijderd <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		} else if ($blok == 'aangepast') {
			echo '<div class="alert alert-warning text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">U heeft blok ' . $iBlokId . ' aangepast <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		} else if ($blok == 'aangepastFout') {
			echo '<div class="alert alert-danger text-center mb-0 border-0 rounded-0 alert-dismissible fade show" role="alert">Er ging wat fout met aanpassen! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
		include '../includes/head.php';
	?>
	<title>Overzicht van <?= $sGebruikersnaam; ?> </title>
<body>
	<?php include '../includes/header.php'; ?>
    <div class="container">
    <div class="card mt-4 p-3">
		<div class="d-flex align-items-center justify-content-between px-3">
			<div>
				<h2 class="pt-3">Welkom <?= $sGebruikersnaam ?>,</h2>
				<p>Hier kunt alle blokken beheren en inschrijven inzien.</p>
			</div>
			<img class="rounded-circle" width="75" height="75" src="https://randomuser.me/api/portraits/men/52.jpg" alt="">
		</div>
    </div>
		<div class="card mt-4 p-4">
			<div class="d-flex justify-content-between align-items-center pl-2 pb-3">
				<h4 class="mb-0">Blokken</h4>
				<a href="./toevoegen/index.php" class="btn btn-primary">Blok toevoegen</a>
			</div>
			<div class="table-responsive">
				<table class="table table-hover" cellspacing="0">
					<tr>
						<th>Blok</th>
						<th>Zichtbaar</th>
						<th>Datum</th>
						<th>Van</th>
						<th>Tot</th>
						<th>Plekken over</th>
						<th></th>
						<th></th>
					</tr>
						<?php while ($row = mysqli_fetch_array($query)) : ?>
						<tr>
							<td><?= $row['blok_id'] ?></td>
							<td><?php if($row['zichtbaar'] == 1) {echo '<i class="fas fa-check text-primary"></i>';} else {echo '';} ?></td>
							<td><?= $row['datum'] ?></td>
							<td><?= $row['start_tijd'] ?></td>
							<td><?= $row['eind_tijd'] ?></td>
							<td><?php if($row['plekken'] < 1) { echo '<p class="text-danger">Vol</p>';} else {echo $row['plekken'];} ?></td>
							<td><a <?php if($row['plekken'] < 1) echo 'disabled' ?> name="aanpassen" href="./aanpassen/index.php?blok_id=<?= $row['blok_id']; ?>"><i class="fas fa-edit text-warning"></i></a></td>
							<td><a <?php if($row['plekken'] < 1) echo 'disabled' ?> name="verwijderen" href="./verwijderen/index.php?blok_id=<?= $row['blok_id']; ?>"><i class="fas fa-trash text-danger"></i></a></td>
						</tr>
					<?php endwhile ?>
				</table>
			</div>
		</div>
		<div class="card my-4 p-4">
			<h4 class="pl-2 pb-3 mb-0">Inschrijvingen</h4>
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
							<td><?php if ($row['lid'] == 0) {echo '';} else { echo '<i class="fas fa-check text-primary"></i>';} ?></td>
						</tr>
					<?php endwhile ?>
				</table>
			</div>
		</div>
    </div>
</body>
</html>