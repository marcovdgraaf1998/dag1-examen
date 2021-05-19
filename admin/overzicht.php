<?php
    include '../includes/config.php';
    include '../includes/session.php';

    $query = mysqli_query($mysqli, "SELECT * FROM blokken");
    $queryInschrijvingen = mysqli_query($mysqli, "SELECT * FROM inschrijvingen ORDER BY inschrijving_id ASC");
    
    $sGebruikersnaam = $_SESSION['gebruikersnaam'];

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
		include '../includes/header.php';
	?>
	<title>Admin overzicht</title>
<body>
    <div class="container">
    <div class="text-center">
        <h1>Welkom <?= $sGebruikersnaam ?></h1>
        <a href="../includes/logout.php">Uitloggen</a>
    </div>
        <h4 class="mt-5">Blokken</h4>
        <div class="table-responsive">
			<table class="table" cellspacing="0">
				<tr>
					<th>Blok</th>
					<th>Datum</th>
					<th>Van</th>
					<th>Tot</th>
					<th>Plekken over</th>
					<th>Actie</th>
				</tr>
					<?php while ($row = mysqli_fetch_array($query)) : ?>
					<tr>
						<td><?= $row['blok_id'] ?></td>
						<td><?= $row['datum'] ?></td>
						<td><?= $row['start_tijd'] ?></td>
						<td><?= $row['eind_tijd'] ?></td>
						<td><?php if($row['plekken'] < 1) { echo 'vol';} else {echo $row['plekken'];} ?></td>
						<td>
								<a href="#" class="btn btn-primary" <?php if($row['plekken'] < 1) echo 'disabled' ?> id="submit" name="submit">Aanpassen</a>
								<a href="#" class="btn btn-danger" <?php if($row['plekken'] < 1) echo 'disabled' ?> id="submit" name="submit">Verwijderen</a>
						</td>
					</tr>
				<?php endwhile ?>
			</table>
		</div>
        <h4 class="mt-5">Inschrijvingen</h4>
        <div class="table-responsive">
			<table class="table" cellspacing="0">
				<tr>
					<th>Naam</th>
					<th>Adres</th>
					<th>Plaats</th>
					<th>Telefoonnummer</th>
					<th>Emailadres</th>
					<th>Lid</th>
				</tr>
					<?php while ($row = mysqli_fetch_array($queryInschrijvingen)) : ?>
					<tr>
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
</body>
</html>